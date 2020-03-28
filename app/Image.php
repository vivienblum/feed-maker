<?php

namespace App;

use App\Services\ColorsGetter;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'url',
        'feed_id',
        'dominant_red',
        'dominant_green',
        'dominant_blue',
        'average_red',
        'average_green',
        'average_blue',
        'colors',
    ];

    protected $casts = [
        'colors' => 'json',
    ];

    public function getHsv(string $type): array
    {
        $colorsGetter = resolve(ColorsGetter::class);
        $redGetter = "{$type}_red";
        $greenGetter = "{$type}_green";
        $blueGetter = "{$type}_blue";

        return $colorsGetter->rgbToHsv([
            $this->{$redGetter},
            $this->{$greenGetter},
            $this->{$blueGetter},
        ]);
    }

    public function getHsvAll(string $type = 'average'): float
    {
        return array_sum($this->getHsv($type));
    }

    public function getHue(string $type = 'average')
    {
        $colorsGetter = resolve(ColorsGetter::class);
        $redGetter = "{$type}_red";
        $greenGetter = "{$type}_green";
        $blueGetter = "{$type}_blue";

        return $colorsGetter->getHue([
            $this->{$redGetter},
            $this->{$greenGetter},
            $this->{$blueGetter},
        ]);
    }
}
