<?php

use App\Photo;
use App\Post;
use App\Tag;
use App\User;
use App\Country;

/*Route::get('/example', function () {
    return view('welcome');
});

Route::get('/post/{id}/{name}', function ($id, $name) {
    //return view('welcome');
    return "This is post number " . $id . " " . $name;
});

Route::get('admin/posts/longpath', array('as' => 'admin.home', function() {
    $url = route('admin.home');

    return "This url is ".$url;
}));*/

// Route::get('/posts/{id}', 'PostsController@index');

// Route::get('contact', 'PostsController@contact');

// Route::resource('posts/{id}', 'PostsController');

// Route::get("post/{id}/{name}/{occupation}", 'PostsController@showPost');

//one-to-one relationship
Route::get('/user/{id}/post', function($id) {
    // return User::find($id)->post;
    return User::find($id)->post->title;
});

//Inversing a relationship
Route::get('/post/{id}/user', function($id) {
    return Post::find($id)->user->name;
});

//One to many relationship
Route::get('/posts', function() {
    $user = User::find(1);
    foreach ($user->posts as $post) {
        echo $post->title. "<br/>";
    }
});

//Many to many relationship
Route::get('/user/{id}/role', function($id) {
    $user = User::find($id)->roles;

    foreach ($user as $role) {
        return $role->name;
    }
});

// Accessing the intermediate table / pivot
Route::get('/user/pivot', function() {
   $user = User::find(1);
   foreach($user->roles as $role) {
       echo $role->pivot->created_at;
   }
});

Route::get('/user/country', function () {
    $country = Country::find(8);
    foreach($country->posts as $post) {
        return $post->title;
    }
    //return $country;
});

// Polymorphic Relations
Route::get('user/photos', function() {
   $user = User::find(1);

   foreach ($user->photos as $photo) {
       return $photo;
   }
});

Route::get('post/photos', function() {
    $post = Post::find(1);

    foreach ($post->photos as $photo) {
        return $photo->path;
    }
});

// Not working properly.
Route::get('photo/{id}/post', function($id) {
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

Route::get('/post/tag', function() {
    $post = Post::find(1);

    foreach ($post->tags as $tag) {
        echo $tag->name;
    }
});

Route::get('/tag/post', function() {
   $tag = Tag::find(2);

   foreach ($tag->posts as $post) {
       echo $post->title;
   }
});
