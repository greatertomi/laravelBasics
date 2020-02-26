<?php

Route::get('/insert', function() {
    DB::insert('insert into posts(title, content) values (?, ?)', ['New PHP with Laravel', 'YII is cool too']);

});

Route::get('/read', function() {
    //$results is an object
    $results = DB::select('select * from posts where id=?', [1]);
    foreach($results as $post) {
        return $post->title;
    }
    // return $results
});

Route::get('/update', function() {
    $updated = DB::update('update posts set title="Updated title" where id=?',[1]);
    return $updated;
});

Route::get('/delete', function() {
    DB::delete('delete from posts where id=?', [2]);
});