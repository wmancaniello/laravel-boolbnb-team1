<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['flat_id', 'email', 'name', 'text'];

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
