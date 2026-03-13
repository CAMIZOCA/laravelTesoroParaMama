<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a single setting by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("seo:{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Get all settings as a key-value array.
     */
    public static function all_settings(): array
    {
        return Cache::rememberForever('seo:all', function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Set/update a setting and clear cache.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("seo:{$key}");
        Cache::forget('seo:all');
    }

    /**
     * Save multiple settings at once.
     */
    public static function saveMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Cache::flush(); // clear all seo cache
    }

    /**
     * Return default SEO values for the site.
     */
    public static function defaults(): array
    {
        return [
            'site_name'            => 'Un Tesoro Para Mamá',
            'meta_title'           => 'Un Tesoro Para Mamá | Joyería de Leche Materna DIY',
            'meta_description'     => 'Transforma lo sagrado y pasajero de la lactancia en un recuerdo duradero. Kit DIY de joyería de leche materna. Todo incluido, simple y seguro.',
            'meta_keywords'        => 'joyería leche materna, kit DIY, collar leche materna, dije lactancia, recuerdo maternidad, breastmilk jewelry',
            'og_title'             => 'Un Tesoro Para Mamá | Joyería de Leche Materna DIY',
            'og_description'       => 'Transforma tu lactancia en un recuerdo eterno. Kit DIY de joyería de leche materna — todo incluido.',
            'og_image'             => '',
            'og_type'              => 'website',
            'twitter_card'         => 'summary_large_image',
            'twitter_site'         => '',
            'twitter_creator'      => '',
            'google_analytics_id'  => '',
            'google_tag_manager_id'=> '',
            'facebook_pixel_id'    => '',
            'canonical_url'        => '',
            'robots_txt'           => "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\nDisallow: /register\n\nSitemap: /sitemap.xml",
            'schema_type'          => 'LocalBusiness',
            'schema_phone'         => '+593 999 829 469',
            'schema_email'         => '',
            'schema_address'       => '',
        ];
    }
}
