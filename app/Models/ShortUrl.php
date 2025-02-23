<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model

{
protected $table = 'short_urls';

    use HasFactory;

    protected $fillable = ['original_url', 'slug', 'visits', 'expires_at'];

    public function analytics()
    {
        return $this->hasMany(UrlAnalytics::class, 'short_url_id');
    }
}
