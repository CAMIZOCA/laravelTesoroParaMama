<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageContent extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = ''): string
    {
        return Cache::rememberForever("page_content:{$key}", function () use ($key, $default) {
            return static::where('key', $key)->value('value') ?? $default;
        });
    }

    public static function all_settings(): array
    {
        return Cache::rememberForever('page_content:all', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    public static function set(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("page_content:{$key}");
        Cache::forget('page_content:all');
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
            // Hero
            'hero_label'       => 'Joyería de Leche Materna DIY',
            'hero_title'       => "Un Tesoro\nPara Mamá",
            'hero_subtitle'    => 'Transforma lo sagrado y pasajero de la lactancia en un recuerdo duradero, creado con tus propias manos.',
            'hero_btn_text'    => 'Pedir mi Kit',
            'hero_link_text'   => 'Ver los kits disponibles',

            // Historia
            'historia_label'   => 'Nuestra Historia',
            'historia_title_1' => 'Más que un alimento,',
            'historia_title_2' => 'un vínculo irrompible.',
            'historia_p1'      => 'La lactancia es una etapa en tu vida, pasajera pero profundamente significativa. La leche materna es mucho más que un alimento, es un tejido vivo y una conexión que compartes con tu bebé.',
            'historia_p2'      => 'Cada gota está compuesta de amor, perseverancia, dedicación, ternura y sacrificios que generan un vínculo irrompible.',
            'historia_p3'      => 'Para muchas madres la lactancia es un viaje lleno de desafíos, esfuerzo y dedicación. Elegirla te hace más humana, más fuerte y resiliente. Superar las dificultades iniciales, las noches sin dormir y mantener la lactancia son actos de amor y perseverancia.',
            'historia_quote'   => 'Una medalla de honor, un símbolo de resiliencia, amor y abundancia.',
            'historia_image'   => '',

            // Kit beneficios
            'kit_label'        => 'El Kit DIY',
            'kit_title'        => 'Crea tu propia joya',
            'kit_description'  => 'Sabemos que eres una persona con muchas obligaciones, por lo que hemos pensado en todo lo que necesitas. Solo debes encontrar el momento adecuado para ti.',
            'feature_1_title'  => 'Todo Incluido',
            'feature_1_text'   => 'En la caja encontrarás hasta el detalle más pequeño. No necesitas ser una experta ni tener herramientas complicadas.',
            'feature_2_title'  => 'Hecho con Amor',
            'feature_2_text'   => 'El hacer tu propia joya es un acto de empoderamiento y orgullo. Una forma tangible de celebrar tu viaje.',
            'feature_3_title'  => 'Simple y Seguro',
            'feature_3_text'   => 'Hacer tu joya es un proceso sorprendentemente simple. Tendrás todas las indicaciones y materiales.',
            'feature_4_title'  => 'Resultado Profesional',
            'feature_4_text'   => 'Al finalizar sabrás que puedes crear lo que tú te propongas y llenarte de orgullo al ver el resultado final.',

            // Tangible / Kit image section
            'tangible_label'   => 'Tu Joya',
            'tangible_title'   => 'Un recuerdo tangible',
            'tangible_p1'      => 'Las joyas de leche materna tienen un valor incalculable, no sólo son adornos, son historias personales, emociones, satisfacción y amor.',
            'tangible_p2'      => 'Esta joya es un recuerdo tangible que abraza ese momento especial, es una manera de congelar un momento y tenerlo siempre cerca.',
            'tangible_image'   => '',

            // Galería
            'galeria_label'       => 'Galería',
            'galeria_title'       => 'Historias hechas joya',
            'galeria_description' => 'Cada joya lleva una historia, un relato de un vínculo que trasciende el tiempo.',

            // CTA final
            'cta_label'       => 'Empieza hoy',
            'cta_title'       => 'Tu tesoro te espera',
            'cta_description' => 'Únete a las mamás que han transformado su lactancia en un recuerdo eterno. Escríbenos por WhatsApp y recibe tu kit en pocos días.',
            'cta_btn_text'    => 'Pedir mi Kit Ahora',
        ];
    }
}
