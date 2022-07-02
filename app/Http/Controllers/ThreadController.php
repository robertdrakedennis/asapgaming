<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\Quill\Plaintext;
use App\Thread;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ThreadController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Category $category){
        $this->authorize('create', Thread::class);
        $this->authorize('isPrivate', $category);
        $this->authorize('isLocked', $category);
        return view('main.forums.thread.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Category $category){
        $this->authorize('create', Thread::class);
        $request->validate([
            'title' => 'bail|required|unique:threads|min:5|max:255',
            'body' => 'required|json|max:20000'
        ]);

        $body = json_decode($request->body, true);

        $plaintext = (new Plaintext)->strip($body);

        $countPlaintextLetters = strlen($plaintext);

        $slug = (new Slugify)->slugify($request->title);

        if (Thread::where('slug', $slug)->exists()){
            alert()->warning('Woah there!', 'Your title already exists, try to make a new one!');
            return back()->withInput();
        }

        $slugLength = strlen($slug);

        if ($slugLength < 0){
            alert()->warning('Woah there!', 'Your title has illegal characters or whatever you\'re typing is breaking. So fix it!');
            return back()->withInput();
        }

        if ($countPlaintextLetters < 20) {
            alert()->warning('Whoops!', 'Your post length needs to be atleast more than 20 characters.');
            return back()->withInput();
        }

        $thread = Thread::create([
            'title'=> $request->title,
            'body' => json_encode($request->body),
            'plaintext' => $plaintext,
            'category_id' => $category->id,
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]);




        $category->increment('thread_count');

        Auth::user()->increment('post_count');


        toast('Thread Created Successfully!','success','top-right');

        $thread->subscribe();

        return redirect(route('threads.show', [
            'category' => $category->slug,
            'thread' => $thread->slug,
        ]));


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Category $category, Thread $thread){
        $this->authorize('view', Thread::class);
        $this->authorize('isPrivate', $category);
        $this->authorize('isTrashed', $thread);

        $allCategories = Category::whereNotNull('parent_id')->get();


        if (Auth::check() && Auth::user()->hasAnyRole(['Owner', 'Administrator', 'Moderator'])){
            $replies = $thread->replies()->with(['user','thread'])->withTrashed()->paginate(15);
        } else {
            $replies = $thread->replies()->with(['user', 'thread'])->paginate(15);
        }

        return view('main.forums.thread.show', compact('category', 'thread', 'replies', 'allCategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category, Thread $thread){
        $this->authorize('update', $thread);
        return view('main.forums.thread.edit', compact('category', 'thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Category $category, Thread $thread){
        $this->authorize('update', $thread);

        Validator::make($request->only(['title', 'body']), [
            'body' => [
                'required|json|max:20000'
            ]
        ]);

        $body = json_decode($request->body, true);

        $plaintext = (new Plaintext)->strip($body);

        $countPlaintextLetters = strlen($plaintext);

        if ($countPlaintextLetters < 20) {
            alert()->warning('Whoops!', 'Your post length needs to be atleast more than 20 characters.');
            return back()->withInput();
        }

        $thread->body = json_encode($request->body);

        $thread->plaintext = $plaintext;

        $thread->save();

        toast('Thread Updated Successfully!','success','top-right');

        return redirect(route('threads.show', [$category, $thread]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category, Thread $thread){
        $user = Auth::user();
        $this->authorize('update', $user);

        $category->reply_count = $category->reply_count - $thread->replies()->count();
        $category->save();

        $thread->replies()->delete();
        $thread->delete();

        $category->decrement('thread_count');

        toast('Thread Destroyed Successfully!','success','top-right');

        return redirect(route('categories.show', [$category]));
    }

    /**
     * Restores the specified resource.
     *
     * @param Category $category
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore(Category $category,  Thread $thread){
        $this->authorize('restore', Thread::class);

        if ($thread->replies() !== null){
            $thread->replies()->restore();
        }

        $thread->restore();

        $category->increment('thread_count');

        $category->reply_count = $category->reply_count + $thread->replies()->count();
        $category->save();

        toast('Thread Restored Successfully!','success','top-right');

        return redirect(route('threads.show', [$category, $thread]));
    }

    /**
     * Lock the specified resource from storage.
     *
     * @param Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function lockThread(Category $category, Thread $thread){
        $user = Auth::user();
        $this->authorize('update', [$user, $thread]);

        if ($thread->isLocked){
            $thread->isLocked = false;
        } else {
            $thread->isLocked = true;
        }

        $thread->save();

        toast('Thread Locked Successfully!','success','top-right');

        return redirect(route('threads.show', [$category, $thread]));
    }
    /**
     * Pin the specified resource from storage.
     *
     * @param Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function pinThread(Category $category, Thread $thread){
        $this->authorize('update', $thread);

        if($thread->isPinned){
            $thread->isPinned = false;
        } else {
            $thread->isPinned = true;
        }

        $thread->save();

        toast('Thread Created Successfully!','success','top-right');

        return redirect(route('threads.show', [$category, $thread]));
    }

    /**
     * Pin the specified resource from storage.
     *
     * @param Request $request
     * @param Category $category
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function movethread(Request $request, Category $category, Thread $thread){
        $this->authorize('update', $thread);

        $newCategory = Category::where('id', $request->category_id)->firstOrFail();

        $thread->category_id = $request->category_id;

        $thread->save();

        $category->decrement('thread_count');

        $newCategory->increment('thread_count');

        toast('Thread Moved Successfully!','success','top-right');

        return redirect(route('threads.show', [$newCategory->slug, $thread]));
    }
}
