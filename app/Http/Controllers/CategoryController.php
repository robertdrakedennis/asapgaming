<?php

namespace App\Http\Controllers;

use App\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(){
        $this->authorize('create', Category::class);
        $categories = Cache::remember('categories',  now()->addMinutes(10), function (){
            return Category::all();
        });
        return view('main.forums.category.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request){

        $this->authorize('create', Category::class);

        $request->validate([
            'title' => 'bail|required|unique:categories|max:255',
            'description' => 'required',
        ]);

        if ($request->background != null){
            $background = $request->file('background')->store('public/categories/images');
        } else {
            $background = null;
        }

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'background' => $background,
            'fontawesome' => $request->fontawesome,
            'color' => $request->color,
            'weight' => $request->weight,
            'parent_id' => $request->parent_id,
            'isLocked' => $request->locked,
            'isPrivate' => $request->private,
            'slug' => (new Slugify)->slugify($request->title)
        ]);

        toast('Category Created Successfully!','success','top-right');

        return redirect(route('forums.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Category $category){
        $this->authorize('view', $category);
        $this->authorize('isPrivate', $category);


        if (Auth::check() && Auth::user()->hasAnyRole(['Owner', 'Administrator', 'Moderator'])){
            $threads = $category->threads()->with(['user','latestReply'])->withTrashed()->orderByRaw('CASE WHEN isPinned = 1 then 1 else 2 END, updated_at DESC')->paginate(15);
        } else {
            $threads = $category->threads()->with(['user','latestReply'])->orderByRaw('CASE WHEN isPinned = 1 then 1 else 2 END, updated_at DESC')->paginate(15);
        }
        return view('main.forums.category.show', compact('category', 'threads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category){
        $this->authorize('update', Category::class);

        $filteredCategories = Category::all();

        return view('main.forums.category.edit', compact('category', 'filteredCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Category $category){
        $this->authorize('update', Category::class);

        $request->validate([
            'title' => 'bail|required|max:255',
            'description' => 'required',
        ]);



        $category->title = $request->title;
        $category->description = $request->description;

        if ($request->background != null){
            $background = $request->file('background')->store('public/categories/images');
            $category->background = $background;
        }

        $category->color = $request->color;
        $category->fontawesome = $request->fontawesome;
        $category->weight = $request->weight;
        $category->parent_id = $request->parent_id;
        $category->isLocked = $request->locked;
        $category->isPrivate = $request->private;
        $category->slug = (new Slugify)->slugify($request->title);
        $category->save();


        toast('Category Updated Successfully!','success','top-right');
        return redirect(route('forums.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category){
        $this->authorize('delete', Category::class);

        $category->delete();

        toast('Category Destroyed Successfully!','success','top-right');

        return redirect(route('forums.index'));
    }

    /**
     * Lock the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function lockCategory(Category $category){

        $this->authorize('update', Category::class);

        if($category->isLocked){
            $category->isLocked = false;
        } else {
            $category->isLocked = true;
        }

        $category->save();

        toast('Category Locked Successfully!','success','top-right');

        return redirect(route('categories.show', $category));
    }

    /**
     * Hide the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function privateCategory(Category $category){

        $this->authorize('update', Category::class);

        if($category->isPrivate){
            $category->isPrivate = false;
        } else {
            $category->isPrivate = true;
        }

        $category->save();

        toast('Category Private Mode Set Successfully!','success','top-right');

        return redirect(route('categories.show', $category));
    }
}
