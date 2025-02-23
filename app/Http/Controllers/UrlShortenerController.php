<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\UrlAnalytics;


class UrlShortenerController extends Controller
{



    public function shorten(Request $request)
{
    Log::info('Incoming Request Data:', $request->all());

    try {
        $validatedData = $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => 'nullable|string|unique:short_urls,slug',
            'expires_at' => 'nullable|date|after:today'
        ]);

        Log::info('Validation Passed:', $validatedData);
    } catch (ValidationException $e) {
        Log::error('Validation Failed:', $e->errors());

        return redirect()->back()
            ->withInput()
            ->withErrors($e->errors())
            ->with('error', 'Validation failed! Please check the input fields.');
    }


    $slug = $request->custom_slug ?? Str::random(6);
    Log::info('Generated Slug: ' . $slug);

    try {
        $shortUrl = ShortUrl::create([
            'original_url' => $request->original_url,
            'slug' => $slug,
            'expires_at' => $request->expires_at
        ]);

        Log::info('Shortened URL Created:', $shortUrl->toArray());


        $shortenedUrls = session('shortened_urls', []);
        $shortenedUrls[] = [
            'slug' => $shortUrl->slug,
            'original_url' => $shortUrl->original_url,
            'expires_at' => $shortUrl->expires_at
        ];
        session(['shortened_urls' => $shortenedUrls]);

        return redirect()->route('shortened.show', ['slug' => $slug])
            ->with('success', 'Shortened URL created successfully!');
    } catch (\Exception $e) {
        Log::error('Error Saving Short URL:', ['message' => $e->getMessage()]);

        return redirect()->back()
            ->with('error', 'Failed to save the URL. Please try again.');
    }
}







public function redirect($slug)
{
    $shortUrl = ShortUrl::where('slug', $slug)->first();

    if (!$shortUrl) {
        return redirect('/')->with('error', 'Shortened URL not found.');
    }


    if ($shortUrl->expires_at && now()->greaterThan($shortUrl->expires_at)) {
        return redirect('/')->with('error', 'This shortened URL has expired.');
    }


    $shortUrl->analytics()->create([
        'referrer' => $shortUrl->original_url,
        'user_agent' => request()->header('User-Agent'),
        'created_at' => now(),
    ]);

    return redirect()->to($shortUrl->original_url);
}


public function showShortenedUrl($slug)
{
    $shortUrl = ShortUrl::where('slug', $slug)->firstOrFail();
    $analytics = $shortUrl->analytics()->latest()->get();


    $shortenedUrls = session('shortened_urls', []);

    return view('urls.shortened', compact('shortUrl', 'analytics', 'shortenedUrls'));
}




public function previousUrls()
{
    $shortenedUrls = ShortUrl::with('analytics')->get()->map(function ($url) {
        return [
            'slug' => $url->slug,
            'original_url' => $url->original_url,
            'expires_at' => $url->expires_at,
            'visit_count' => $url->analytics->count(),
            'last_visited' => optional($url->analytics->last())->created_at,
        ];
    });

    return view('shortened.previous_urls', compact('shortenedUrls'));
}



}
