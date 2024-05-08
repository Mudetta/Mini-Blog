<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable =["comment", "post_id"];

    public function post()
    {
        return $this->belongsTo(Post::class)->onDelete("cascade");
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
