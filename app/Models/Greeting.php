<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    public mixed $body;

    public static function first()
    {
    }
}
