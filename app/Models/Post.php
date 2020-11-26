<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        // 'slug',
        'content',
        // 'seo_meta_title',
        // 'seo_meta_description',
        // 'seo_meta_keyword',
        // 'author_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        // 'slug' => 'string',
        'content' => 'string',
        // 'seo_meta_title' => 'string',
        // 'seo_meta_description' => 'string',
        // 'seo_meta_keyword' => 'string',
        // 'author_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $rules = [
        'title' => 'required|string',
        // 'slug' => 'required|string',
        'content' => 'required|string',
        // 'seo_meta_title' => 'required|string',
        // 'seo_meta_description' => 'required|string',
        // 'seo_meta_keyword' => 'required|string',
        // 'author_id' => 'required|integer',
    ];

}
