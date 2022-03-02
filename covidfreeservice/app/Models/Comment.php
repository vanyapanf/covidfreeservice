<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['post_id', 'user_id', 'comment_text'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at);
    }
}
