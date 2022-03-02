<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['user_id', 'tag', 'post_text', ];

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at);
    }
}
