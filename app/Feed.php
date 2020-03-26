<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function sortedImages()
    {
        return $this->images()->orderBy('color', 'DESC');
    }
}
