<?php

use App\Category;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//forum
Breadcrumbs::for('forum', function($trail){
    $trail->push('Forum', route('forum'));
});

// forum categorie
Breadcrumbs::for('category', function($trail, $category){
    $trail->parent('forum');
    $trail->push($category->name, route('forum_cat', $category->id));
});

// forum post
Breadcrumbs::for('message', function($trail, $topic){
    $cat = Category::where('id', '=', $topic->category_id)->first();
    $trail->parent('category', $cat);
    $trail->push($topic->title, route('forum_messages', $topic->id));
});
