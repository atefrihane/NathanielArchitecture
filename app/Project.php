<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasSlug;

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    protected $fillable = [
        'name',
        'architect',
        'location',
        'date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->identifier = uniqid(true);
        });
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('sort-order-project');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getCoverAttribute()
    {
        return $this->photos()->first();
    }
}
