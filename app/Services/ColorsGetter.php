<?php

namespace App\Services;

use BrianMcdo\ImagePalette\ImagePalette;

class ColorsGetter
{
    public function getDominant(string $url)
    {
        $palette = new ImagePalette($url);

        $colors = $palette->getColors();

        return optional($colors[0])->toHexString();
    }
}
