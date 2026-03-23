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
            'theme_color_primary'    => '#C9A96E',
            'theme_color_secondary'  => '#3D4A35',
            'theme_color_accent'     => '#E8C4B0',
            'theme_color_bg_main'    => '#FAF7F2',
            'theme_color_bg_section' => '#F2EDE6',
            'theme_color_btn'        => '#C9A96E',
            'theme_color_btn_hover'  => '#B8935A',
            'theme_color_btn_text'   => '#FFFFFF',
            'theme_color_title'      => '#2C3628',
            'theme_color_text'       => '#4A5240',
            'theme_color_link'       => '#A67C45',
            'theme_color_card'       => '#FFFFFF',
            'theme_color_border'     => '#E5DDD0',
            'theme_color_badge'      => '#F5E6C8',
            'theme_color_footer'     => '#2C3628',
            'theme_color_header'     => '#FFFFFF',
        ];
    }

    public static function palettes(): array
    {
        return [
            'romantica_suave' => [
                'name'   => 'Romántica Suave',
                'values' => [
                    'theme_color_primary'    => '#C9A96E',
                    'theme_color_secondary'  => '#3D4A35',
                    'theme_color_accent'     => '#E8C4B0',
                    'theme_color_bg_main'    => '#FAF7F2',
                    'theme_color_bg_section' => '#F2EDE6',
                    'theme_color_btn'        => '#C9A96E',
                    'theme_color_btn_hover'  => '#B8935A',
                    'theme_color_btn_text'   => '#FFFFFF',
                    'theme_color_title'      => '#2C3628',
                    'theme_color_text'       => '#4A5240',
                    'theme_color_link'       => '#A67C45',
                    'theme_color_card'       => '#FFFFFF',
                    'theme_color_border'     => '#E5DDD0',
                    'theme_color_badge'      => '#F5E6C8',
                    'theme_color_footer'     => '#2C3628',
                    'theme_color_header'     => '#FFFFFF',
                ],
            ],
            'elegante_calida' => [
                'name'   => 'Elegante Cálida',
                'values' => [
                    'theme_color_primary'    => '#8B6914',
                    'theme_color_secondary'  => '#2D2417',
                    'theme_color_accent'     => '#D4AF6B',
                    'theme_color_bg_main'    => '#FDFAF5',
                    'theme_color_bg_section' => '#F7F1E6',
                    'theme_color_btn'        => '#8B6914',
                    'theme_color_btn_hover'  => '#6E5210',
                    'theme_color_btn_text'   => '#FFFFFF',
                    'theme_color_title'      => '#1A1208',
                    'theme_color_text'       => '#3D2E0F',
                    'theme_color_link'       => '#8B6914',
                    'theme_color_card'       => '#FFFFFF',
                    'theme_color_border'     => '#E8D9B5',
                    'theme_color_badge'      => '#FFF0C0',
                    'theme_color_footer'     => '#1A1208',
                    'theme_color_header'     => '#FDFAF5',
                ],
            ],
            'femenina_moderna' => [
                'name'   => 'Femenina Moderna',
                'values' => [
                    'theme_color_primary'    => '#C9748A',
                    'theme_color_secondary'  => '#3D3344',
                    'theme_color_accent'     => '#F2B8C6',
                    'theme_color_bg_main'    => '#FDF8FA',
                    'theme_color_bg_section' => '#F8EFF2',
                    'theme_color_btn'        => '#C9748A',
                    'theme_color_btn_hover'  => '#B05E75',
                    'theme_color_btn_text'   => '#FFFFFF',
                    'theme_color_title'      => '#2A1F2D',
                    'theme_color_text'       => '#4A3F4D',
                    'theme_color_link'       => '#C9748A',
                    'theme_color_card'       => '#FFFFFF',
                    'theme_color_border'     => '#EADCE1',
                    'theme_color_badge'      => '#FDE8ED',
                    'theme_color_footer'     => '#2A1F2D',
                    'theme_color_header'     => '#FFFFFF',
                ],
            ],
            'artesanal_premium' => [
                'name'   => 'Artesanal Premium',
                'values' => [
                    'theme_color_primary'    => '#B07040',
                    'theme_color_secondary'  => '#3E3025',
                    'theme_color_accent'     => '#D4A574',
                    'theme_color_bg_main'    => '#FBF8F4',
                    'theme_color_bg_section' => '#F5EEE5',
                    'theme_color_btn'        => '#B07040',
                    'theme_color_btn_hover'  => '#8F5A30',
                    'theme_color_btn_text'   => '#FFFFFF',
                    'theme_color_title'      => '#271C0F',
                    'theme_color_text'       => '#4A3825',
                    'theme_color_link'       => '#B07040',
                    'theme_color_card'       => '#FDFAF7',
                    'theme_color_border'     => '#E8D9C4',
                    'theme_color_badge'      => '#FAEBD7',
                    'theme_color_footer'     => '#271C0F',
                    'theme_color_header'     => '#FDFAF7',
                ],
            ],
            'delicada_pastel' => [
                'name'   => 'Delicada Pastel',
                'values' => [
                    'theme_color_primary'    => '#A8C5C0',
                    'theme_color_secondary'  => '#6B8F8A',
                    'theme_color_accent'     => '#F2C4B8',
                    'theme_color_bg_main'    => '#F8FAFA',
                    'theme_color_bg_section' => '#EEF5F4',
                    'theme_color_btn'        => '#8FBAB5',
                    'theme_color_btn_hover'  => '#6B9E99',
                    'theme_color_btn_text'   => '#FFFFFF',
                    'theme_color_title'      => '#2C4A47',
                    'theme_color_text'       => '#3D5E5B',
                    'theme_color_link'       => '#6B8F8A',
                    'theme_color_card'       => '#FFFFFF',
                    'theme_color_border'     => '#D4E8E6',
                    'theme_color_badge'      => '#FDE8E1',
                    'theme_color_footer'     => '#2C4A47',
                    'theme_color_header'     => '#FFFFFF',
                ],
            ],
            'lujo_sutil' => [
                'name'   => 'Lujo Sutil',
                'values' => [
                    'theme_color_primary'    => '#D4AF7A',
                    'theme_color_secondary'  => '#1A1A2E',
                    'theme_color_accent'     => '#E8D5A8',
                    'theme_color_bg_main'    => '#F9F7F4',
                    'theme_color_bg_section' => '#F0EDE8',
                    'theme_color_btn'        => '#D4AF7A',
                    'theme_color_btn_hover'  => '#C09A5E',
                    'theme_color_btn_text'   => '#1A1A2E',
                    'theme_color_title'      => '#0D0D1A',
                    'theme_color_text'       => '#2A2A3E',
                    'theme_color_link'       => '#D4AF7A',
                    'theme_color_card'       => '#FFFFFF',
                    'theme_color_border'     => '#DDD5C4',
                    'theme_color_badge'      => '#F7EDD5',
                    'theme_color_footer'     => '#0D0D1A',
                    'theme_color_header'     => '#FFFFFF',
                ],
            ],
        ];
    }
}
