<?php

namespace App;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable, HasTags;
	
	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected $fillable = [
        'title', 'slug', 'featured', 'category_id', 'user_id', 'thumbnail', 'content', 'status', 'views',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //count the total comments per post
    public function countComment()
    {
        return $this->hasMany(Comment::class, 'commentable_id');
    }
    //get comments to display in the post
    public function comment()
    {
        return $this->hasMany(Comment::class, 'commentable_id')->whereNull('parent_id');
    }
    
}
