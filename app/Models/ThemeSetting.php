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

    public static function palettes(): array
    {
        return [
            'editorial_rosa' => [
                'name' => 'Editorial Rosa',
                'values' => [
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
                ],
            ],
            'minimal_limpio' => [
                'name' => 'Minimal Limpio',
                'values' => [
                    'theme_color_primary' => '#2D3547',
                    'theme_color_secondary' => '#171D2D',
                    'theme_color_accent' => '#D9DFEB',
                    'theme_color_bg_main' => '#FFFFFF',
                    'theme_color_bg_section' => '#F6F7FA',
                    'theme_color_btn' => '#2D3547',
                    'theme_color_btn_hover' => '#1C2334',
                    'theme_color_btn_text' => '#FFFFFF',
                    'theme_color_title' => '#171D2D',
                    'theme_color_text' => '#596275',
                    'theme_color_link' => '#2D3547',
                    'theme_color_card' => '#FFFFFF',
                    'theme_color_border' => '#E7EBF1',
                    'theme_color_badge' => '#F4F6F9',
                    'theme_color_footer' => '#171D2D',
                    'theme_color_header' => '#FFFFFF',
                ],
            ],
            'azul_sereno' => [
                'name' => 'Azul Sereno',
                'values' => [
                    'theme_color_primary' => '#4F6FAF',
                    'theme_color_secondary' => '#25324D',
                    'theme_color_accent' => '#DCE6F9',
                    'theme_color_bg_main' => '#FAFCFF',
                    'theme_color_bg_section' => '#F1F5FC',
                    'theme_color_btn' => '#4F6FAF',
                    'theme_color_btn_hover' => '#3F5D98',
                    'theme_color_btn_text' => '#FFFFFF',
                    'theme_color_title' => '#1E2A42',
                    'theme_color_text' => '#425573',
                    'theme_color_link' => '#4F6FAF',
                    'theme_color_card' => '#FFFFFF',
                    'theme_color_border' => '#DEE7F5',
                    'theme_color_badge' => '#EAF0FB',
                    'theme_color_footer' => '#1E2A42',
                    'theme_color_header' => '#FFFFFF',
                ],
            ],
            'coral_suave' => [
                'name' => 'Coral Suave',
                'values' => [
                    'theme_color_primary' => '#DD7D7D',
                    'theme_color_secondary' => '#3C3A48',
                    'theme_color_accent' => '#FADDDD',
                    'theme_color_bg_main' => '#FFFDFD',
                    'theme_color_bg_section' => '#FFF6F6',
                    'theme_color_btn' => '#DD7D7D',
                    'theme_color_btn_hover' => '#C46868',
                    'theme_color_btn_text' => '#FFFFFF',
                    'theme_color_title' => '#2A2735',
                    'theme_color_text' => '#545163',
                    'theme_color_link' => '#DD7D7D',
                    'theme_color_card' => '#FFFFFF',
                    'theme_color_border' => '#F0DEDE',
                    'theme_color_badge' => '#FDECEC',
                    'theme_color_footer' => '#2A2735',
                    'theme_color_header' => '#FFFFFF',
                ],
            ],
            'lavanda_clara' => [
                'name' => 'Lavanda Clara',
                'values' => [
                    'theme_color_primary' => '#9A82C7',
                    'theme_color_secondary' => '#38314A',
                    'theme_color_accent' => '#E8DFF8',
                    'theme_color_bg_main' => '#FCFBFF',
                    'theme_color_bg_section' => '#F5F2FC',
                    'theme_color_btn' => '#9A82C7',
                    'theme_color_btn_hover' => '#846AB4',
                    'theme_color_btn_text' => '#FFFFFF',
                    'theme_color_title' => '#2C2640',
                    'theme_color_text' => '#57506B',
                    'theme_color_link' => '#9A82C7',
                    'theme_color_card' => '#FFFFFF',
                    'theme_color_border' => '#E7E0F5',
                    'theme_color_badge' => '#F2ECFB',
                    'theme_color_footer' => '#2C2640',
                    'theme_color_header' => '#FFFFFF',
                ],
            ],
            'salvia_moderna' => [
                'name' => 'Salvia Moderna',
                'values' => [
                    'theme_color_primary' => '#6E9E92',
                    'theme_color_secondary' => '#2E3D3A',
                    'theme_color_accent' => '#DCEEE9',
                    'theme_color_bg_main' => '#FAFDFC',
                    'theme_color_bg_section' => '#F1F8F6',
                    'theme_color_btn' => '#6E9E92',
                    'theme_color_btn_hover' => '#5A877D',
                    'theme_color_btn_text' => '#FFFFFF',
                    'theme_color_title' => '#23312F',
                    'theme_color_text' => '#46625D',
                    'theme_color_link' => '#6E9E92',
                    'theme_color_card' => '#FFFFFF',
                    'theme_color_border' => '#DDEBE8',
                    'theme_color_badge' => '#EAF5F2',
                    'theme_color_footer' => '#23312F',
                    'theme_color_header' => '#FFFFFF',
                ],
            ],
        ];
    }
}
