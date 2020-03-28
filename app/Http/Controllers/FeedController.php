<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Image;
use App\Services\Uploader;
use App\Services\ColorsGetter;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __construct(Uploader $uploader, ColorsGetter $colorsGetter)
    {
        $this->uploader = $uploader;
        $this->colorsGetter = $colorsGetter;
    }

    public function index(Guard $auth)
    {
        $feeds = $auth->user()->feeds;

        return view('feeds.index', compact('feeds'));
    }

    public function create()
    {
        return view('feeds.create');
    }

    public function store(Guard $auth, Request $request)
    {
        $feed = Feed::create([
            'name' => $request->get('name'),
            'user_id' => $auth->id(),
        ]);

        return view('feeds.edit', compact('feed'));
    }

    public function show(Feed $feed)
    {
        $images = $feed->getSortedImages();

        return view('feeds.show', compact('feed'), compact('images'));
    }

    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    public function update(Guard $auth, Request $request, Feed $feed)
    {
        $feed->update($request->only('name'));

        foreach ($request->file('images', []) as $file) {
            $url = $this->uploader->upload($file, $auth->user());
            $colors = $this->colorsGetter->getDominants($url);
            $averageColor = $this->colorsGetter->getAverage($colors);
            $dominantColor = $colors[0];
            $rgb = $this->colorsGetter->getDominant($url);
            $feed->images()->create([
                'url' => $url,
                'dominant_red' => $dominantColor->r,
                'dominant_green' => $dominantColor->g,
                'dominant_blue' => $dominantColor->b,
                'average_red' => $averageColor['red'],
                'average_green' => $averageColor['green'],
                'average_blue' => $averageColor['blue'],
                'colors' => $colors,
            ]);
        }

        $images = $feed->getSortedImages();

        return view('feeds.show', compact('feed'), compact('images'));
    }

    public function destroy(Feed $feed)
    {
        //
    }
}
