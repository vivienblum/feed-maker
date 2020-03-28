<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function getSortedImages(): Collection
    {
        return $this->getSortedByHue();
        // return $this->getSortedByHsv();
    }

    public function getSortedByHsv(): Collection
    {
        return $this->images->sort(function (Image $image1, Image $image2) {
            return $image1->getHsvAll() <=> $image2->getHsvAll();
        });
    }

    public function getSortedByHue(): Collection
    {
        return $this->images->sort(function (Image $image1, Image $image2) {
            return $image1->hue <=> $image2->hue;
        });
    }
}
