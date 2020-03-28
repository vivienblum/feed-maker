<?php

namespace App\Services;

use BrianMcdo\ImagePalette\ImagePalette;

class ColorsGetter
{
    public function getDominants(string $url): ?array
    {
        $palette = new ImagePalette($url);

        $colors = $palette->getColors();

        return $palette->getColors();
    }

    public function getDominant(string $url): ?array
    {
        $palette = new ImagePalette($url);

        $colors = $palette->getColors();

        return optional($colors[0])->rgb;
    }

    public function getAverage(array $colors): array
    {
        $red = 0;
        $green = 0;
        $blue = 0;
        foreach ($colors as $color) {
            $red += $color->r;
            $green += $color->g;
            $blue += $color->b;
        }

        return [
            'red' => (int) ($red / count($colors)),
            'green' => (int) ($green / count($colors)),
            'blue' => (int) ($blue / count($colors)),
        ];
    }

    public function rgbToHsv(array $rgb): array
    {
        $red = $rgb[0] / 255;
        $green = $rgb[1] / 255;
        $blue = $rgb[2] / 255;

        $min = min($red, $green, $blue);
        $max = max($red, $green, $blue);

        switch ($max) {
            case 0:
                // If the max value is 0.
                $hue = 0;
                $saturation = 0;
                $value = 0;
                break;
            case $min:
                // If the maximum and minimum values are the same.
                $hue = 0;
                $saturation = 0;
                $value = round($max, 4);
                break;
            default:
                $delta = $max - $min;
                if ($red == $max) {
                    $hue = 0 + ($green - $blue) / $delta;
                } elseif ($green == $max) {
                    $hue = 2 + ($blue - $red) / $delta;
                } else {
                    $hue = 4 + ($red - $green) / $delta;
                }
                $hue *= 60;
                if ($hue < 0) {
                    $hue += 360;
                }

                $saturation = $delta / $max;
                $value = round($max, 4);
        }

        return ['hue' => $hue, 'saturation' => $saturation, 'value' => $value];
    }

    public function getHue(array $rgb)
    {
        $red = $rgb[0] / 255;
        $green = $rgb[1] / 255;
        $blue = $rgb[2] / 255;

        $min = min($red, $green, $blue);
        $max = max($red, $green, $blue);

        switch ($max) {
            case 0:
                // If the max value is 0.
                $hue = 0;
                break;
            case $min:
                // If the maximum and minimum values are the same.
                $hue = 0;
                break;
            default:
                $delta = $max - $min;
                if ($red == $max) {
                    $hue = 0 + ($green - $blue) / $delta;
                } elseif ($green == $max) {
                    $hue = 2 + ($blue - $red) / $delta;
                } else {
                    $hue = 4 + ($red - $green) / $delta;
                }

                $hue *= 60;
                if ($hue < 0) {
                    $hue += 360;
                }
        }

        return $hue;
    }
}
