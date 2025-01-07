<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Book extends Model
{


    protected $fillable = [
        'title',
        'author_id',
        'language',
        'type',
        'notes',
        'user_id'
    ];

    public function author() {
        return $this->belongsTo(Author::class);
    }
    public function genres() {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id');
    }
    public function files() {
        return $this->hasMany(File::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('notes', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('author', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('genres', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhere('notes', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('files', function ($q) use ($keyword) {
                $q->where('file_name', 'LIKE', '%' . $keyword . '%');
            });
    }


}
