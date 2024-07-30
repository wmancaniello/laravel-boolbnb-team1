<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Flat extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->belongsToMany(Sponsor::class)->withPivot('start_date', 'end_date');
    }

    // Mutators

    public function setTitleAttribute($title) {
        // $this->attributes['slug'] = Str::slug($title);
        $this->attributes['title'] = $title;
    }

    // scope query
    public function scopeWithAllServices($query, $serviceIds)
    {
        return $query->whereHas('services', function ($query) use ($serviceIds) {
            $query->whereIn('services.id', $serviceIds);
        }, '=', count($serviceIds));
    }

    public function scopeVisibleFlats($query) {
        return $query->where("visible", "1");
    }

    public function scopeMinBeds($query, $minBeds) {
        return $query->where('beds', '>=', $minBeds);
    }

    public function scopeMinRooms($query, $minRooms) {
        return $query->where('rooms', '>=', $minRooms);
    }
}
