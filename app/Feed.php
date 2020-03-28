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

    public function getSortedImages(string $sort = 'hue', string $type = 'average'): Collection
    {
        switch ($sort) {
            case 'hue':
                return $this->getSortedByHue($type);
            case 'hsv':
            default:
                return $this->getSortedByHsv($type);
        }
    }

    public function getSortedByHsv(string $type): Collection
    {
        return $this->images->sort(function (Image $image1, Image $image2) use ($type) {
            return $image1->getHsvAll($type) <=> $image2->getHsvAll($type);
        });
    }

    public function getSortedByHue(string $type): Collection
    {
        return $this->images->sort(function (Image $image1, Image $image2) use ($type) {
            return $image1->getHue($type) <=> $image2->getHue($type);
        });
    }
}
