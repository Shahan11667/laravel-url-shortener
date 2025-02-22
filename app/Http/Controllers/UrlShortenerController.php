<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

        // Generate slug
        $slug = $request->custom_slug ?? Str::random(6);
        Log::info('Generated Slug: ' . $slug);

        try {
            $shortUrl = ShortUrl::create([
                'original_url' => $request->original_url,
                'slug' => $slug,
                'expires_at' => $request->expires_at
            ]);

            Log::info('Shortened URL Created:', $shortUrl->toArray());

            return redirect()->route('shortened.show', ['slug' => $slug]);

        } catch (\Exception $e) {
            Log::error('Error Saving Short URL:', ['message' => $e->getMessage()]);

            return redirect()->back()
                ->with('error', 'Failed to save the URL. Please try again.');
        }
    }


    // Redirect to original URL
    public function redirect($slug)
{
    $shortUrl = ShortUrl::where('slug', $slug)->first();

    if (!$shortUrl) {
        return redirect('/')->with('error', 'Shortened URL not found.');
    }

    return redirect()->to($shortUrl->original_url);
}


public function showShortenedUrl($slug)
{
    $shortUrl = ShortUrl::where('slug', $slug)->first();

    if (!$shortUrl) {
        return redirect('/')->with('error', 'Shortened URL not found.');
    }

    return view('urls.shortened', compact('shortUrl'));
}



}
