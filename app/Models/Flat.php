<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'max_guests',
        'rooms',
        'beds',
        'bathrooms',
        'meters_square',
        'address',
        'latitude',
        'longitude',
        'visible',
        'description',
        'slug',
    ];
    
    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    // Mutators

    public function setTitleAttribute($title) {
        $this->attributes['slug'] = Str::slug($title);
        $this->attributes['title'] = $title;
    }
}
