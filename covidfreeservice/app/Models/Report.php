<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $fillable = ['user_id', 'path_to_doc', 'type', 'admin_id', 'status'];

    public function messages()
    {
        return $this->hasMany('Message');
    }
}
