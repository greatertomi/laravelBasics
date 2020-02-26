<?php

//Retrieves all data in the DB
Route::get('/all', function () {
    $posts = Post::all();
    //return $posts;
    foreach ($posts as $post) {
        return $post->title;
    }
});

//Retrieve the data of a particular ID
Route::get('/find', function () {
    $post = Post::find(2);
    return $post->title;
});

Route::get('/findwhere', function () {
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

Route::get('/findmore', function() {
    /*$posts = Post::findOrFail(6);
    return $posts;*/

    $posts = Post::where('users_count', '<', 50)->firstOrFail();
});

Route::get('/basicinsert', function() {
    $post = new Post;
    $post->title = 'New Eloquent title insert';
    $post->content='Eloquent is really cool';

    $post->save();
});

Route::get('/basicupdate', function() {
    $post = Post::find(2);
    $post->title = 'Fast dancing baby';
    $post->content='Eloquent simple update';

    $post->save();
});

//mass assignment of data
Route::get('/create', function() {
    Post::create(['title'=>'the create method', 'content'=>'WoW, I\'m learning alot in PHP']);
});

Route::get('/update', function() {
    Post::where('id',4)->where('is_admin',0)->update(['title'=>'New PHP title', 'content'=>'I  love my instructor']);
});

Route::get('/delete', function() {
    $post = Post::find(4);
    $post->delete();

    /*You can also use destroy to also delete record*/
    /*The code below deletes two record*/
    //Post::destroy(4,5);
});

//SoftDelete
Route::get('/softdelete', function () {
    Post::find(6)->delete();
});

//To read soft deleted item
Route::get('/readsoftdelete', function () {
    /*$post = Post::withTrashed()->where('id', 5)->get();
    return $post;*/

    $post = Post::onlyTrashed()->get();
    return $post;
});

//To restore soft deleted item
Route::get('/restore', function() {
    Post::withTrashed()->where('id',5)->restore();
});

Route::get('/forcedelete', function() {
    Post::withTrashed()->where('id',6)->forceDelete();
});
