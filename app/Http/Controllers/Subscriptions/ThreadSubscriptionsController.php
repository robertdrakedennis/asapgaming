<?php

namespace App\Http\Controllers\Subscriptions;

use App\Category;
use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThreadSubscriptionsController extends Controller
{
    public function store(Category $category, Thread $thread)
    {
        $thread->subscribe();

        return back();
    }
    public function destroy(Category $category, Thread $thread)
    {
        $thread->unsubscribe();
        return back();
    }
}
