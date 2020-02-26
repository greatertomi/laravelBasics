<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // To tell Eloquent your table name different from the default
    // protected $table = 'Poster';
    use SoftDeletes;

    protected $fillable = ['title', 'content'];
    protected $date = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function photos() {
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
