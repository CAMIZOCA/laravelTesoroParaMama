<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ThemeSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = ''): string
    {
        return Cache::rememberForever("theme_setting:{$key}", function () use ($key, $default) {
            return static::where('key', $key)->value('value') ?? $default;
        });
    }

    public static function all_settings(): array
    {
        return Cache::rememberForever('theme_settings:all', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("theme_setting:{$key}");
        Cache::forget('theme_settings:all');
    }

    public static function saveMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Cache::flush();
    }

    public static function defaults(): array
    {
        return [
            'theme_color_primary' => '#CF7897',
            'theme_color_secondary' => '#272D3E',
            'theme_color_accent' => '#F8D3DF',
            'theme_color_bg_main' => '#FCFCFD',
            'theme_color_bg_section' => '#F4F6F9',
            'theme_color_btn' => '#CF7897',
            'theme_color_btn_hover' => '#B45F7F',
            'theme_color_btn_text' => '#FFFFFF',
            'theme_color_title' => '#171D2D',
            'theme_color_text' => '#424B5E',
            'theme_color_link' => '#CF7897',
            'theme_color_card' => '#FFFFFF',
            'theme_color_border' => '#E7EBF1',
            'theme_color_badge' => '#FDEAF0',
            'theme_color_footer' => '#171D2D',
            'theme_color_header' => '#FFFFFF',
        ];
    }

}
