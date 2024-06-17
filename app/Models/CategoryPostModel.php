<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPostModel extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'cate_post_name',
        'cate_post_desc',
        'cate_post_status',
        'cate_post_slug',
    ];
    protected $primaryKey = 'category_post_id';
    protected $table = 'tbl_category_post';
}
