<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['user_id', 'title', 'post_text', 'path_to_img',];

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at);
    }
}
