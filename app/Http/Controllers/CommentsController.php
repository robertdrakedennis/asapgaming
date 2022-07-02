<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Helpers\Quill\Plaintext;
use App\Notifications\PostedComment;
use App\User;
use Exception;
use Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function store(Request $request, User $user){

        $request->validate([
            'body' => 'required|json|max:4000',
        ]);

        $body = json_decode($request->body, true);

        $plaintext = (new Plaintext)->strip($body);

        $countPlaintextLetters = strlen($plaintext);

        if ($countPlaintextLetters < 5) {
            alert()->warning('Whoops!', 'Your post length needs to be atleast more than 20 characters.');
            return back()->withInput();
        }

        $comment = Comment::create([
            'body' => json_encode($request->body),
            'user_id' => $user->id,
            'author_id' => Auth::user()->id,
        ]);

        $commentee = $comment->user;


        if (Auth::user()->id !== $commentee->id){
            $commentee->notify(new PostedComment($comment));
        }



        toast('Comment Created Successfully!','success','top-right');


        return redirect()->route('users.show', $user);
    }

    public function edit(User $user, Comment $comment)
    {
        if (Auth::user()->id !== $comment->author->id || ! Auth::user()->hasAnyRole(['Staff', 'Owner', 'Administrator'])){
            return back();
        }

        return view('main.users.comments.edit', compact('user', 'comment'));
    }

    public function update(Request $request, User $user, Comment $comment){

        if (Auth::user()->id !== $comment->author->id || ! Auth::user()->hasAnyRole(['Staff', 'Owner', 'Administrator'])){
            return back();
        }

        Validator::make($request->only(['body']), [
            'body' => [
                'required|json|min:20|max:4000'
            ],
        ]);

        $body = json_decode($request->body, true);

        $comment->body = json_encode($request->body);

        $comment->save();

        return redirect()->route('users.show', $user);
    }

    /**
     * @param User $user
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(User $user, Comment $comment){
        $comment->delete();

        return back();
    }
}
