<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_url',
        'short_url',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Link $link) {
            if (empty($link->short_url)) {
                $link->short_url = self::generateUniqueShortCode();
            }
        });
    }

    public static function generateUniqueShortCode(int $length = 6): string
    {
        do {
            $code = Str::random($length);
        } while (self::where('short_url', $code)->exists());

        return $code;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }
}
