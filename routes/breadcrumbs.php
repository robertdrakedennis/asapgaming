<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Coinflips
Breadcrumbs::for('coinflips', function ($trail) {
    $trail->parent('home');
    $trail->push('Coin Flips', route('coinflips.index'));
});

// Home > News
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');
    $trail->push('News', route('articles.index'));
});

// News > [Article]
Breadcrumbs::for('article', function ($trail, \App\Article $article) {
    $trail->parent('articles');
    $trail->push($article->title, route('articles.show', $article));
});

// Forums
Breadcrumbs::for('forums', function ($trail) {
    $trail->parent('home');
    $trail->push('Forums', route('forums.index'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

// Users > Staff
Breadcrumbs::for('staff', function ($trail) {
    $trail->parent('users');
    $trail->push('Staff', route('users.staff'));
});
// Users > Leaderboards
Breadcrumbs::for('leaderboards', function ($trail) {
    $trail->parent('users');
    $trail->push('Leaderboards', route('users.leaderboards'));
});
// Users > Bans
Breadcrumbs::for('bans', function ($trail) {
    $trail->parent('users');
    $trail->push('Banned', route('users.bans'));
});


// Users > [User]
Breadcrumbs::for('user', function ($trail, \App\User $user) {
    $trail->parent('users');
    $trail->push($user->slug, route('users.show', $user));
});


// Home > Forums > [Category]
Breadcrumbs::for('category', function ($trail, \App\Category $category) {
    $trail->parent('forums');
    $trail->push($category->title, route('categories.show', $category->slug));
});

// Home > Blog > [Category] > [Thread]
Breadcrumbs::for('thread', function ($trail,\App\Category $category, \App\Thread $thread) {
    $trail->parent('category', $thread->category);
    $trail->push($thread->title, route('threads.show',[
        'category' => $category->slug,
        'thread' => $thread->slug
    ]));
});