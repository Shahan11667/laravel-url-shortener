<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlAnalytics extends Model
{
    use HasFactory;

    protected $fillable = ['short_url_id',  'user_agent', 'referrer'];

    public function shortUrl()
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
