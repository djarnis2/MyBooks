<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['book_id','file_name','file_path'];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}