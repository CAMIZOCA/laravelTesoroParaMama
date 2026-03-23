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

            // Instrucciones
            'instr_page_label'       => 'Joyería de Leche Materna DIY',
            'instr_page_title'       => 'Instrucciones',
            'instr_page_subtitle'    => 'Todo lo que necesitas para crear tu joya, paso a paso.',
            'instr_welcome_title'    => 'Bienvenida a este momento especial',
            'instr_welcome_text'     => "Tu leche materna es única, como tú y tu bebé. Antes de comenzar, enciende la vela blanca que viene en tu kit. Tu joya es por su propia naturaleza una pieza única, no existen dos iguales en el mundo. Gracias por elegir atesorar todo lo que significa tu leche materna en una joya.",
            'instr_kit_title'        => 'Contenido de tu kit',
            'instr_kit_sobre1_title' => 'Sobre 1 — Preservante',
            'instr_kit_sobre1_items' => "Jeringa para medir 1 ml de leche\nBolsita con preservante en polvo\nPapel encerado\nPalito",
            'instr_kit_sobre2_title' => 'Sobre 2 — Resina',
            'instr_kit_sobre2_items' => "Jeringa componente A\nJeringa componente B\nPaleta de madera\nAdhesivo verde",
            'instr_kit_sobre3_title' => 'Sobre 3 — Protectores',
            'instr_kit_sobre3_items' => "Mascarilla desechable\nGuantes de nitrilo\nToalla de papel",
            'instr_kit_extras_title' => 'Extras incluidos',
            'instr_kit_extras_items' => "Instrucciones\nIndividual de papel\nVasito\nVasito con tapa\nVela blanca\nDije",
            'instr_step1_label'      => 'Paso 1',
            'instr_step1_title'      => 'Preservación de la leche',
            'instr_step1_sobre'      => 'Sobre 1 — Preservante',
            'instr_step1_duration'   => '24 horas de secado',
            'instr_step1_steps'      => "Mide 1 ml de leche materna con la jeringa\nVierte la leche en el vasito con tapa\nAgrega todo el polvo preservante\nMezcla con el palito hasta obtener una pasta homogénea\nEspárcela sobre el papel encerado en capa fina\nDeja secar 24 horas en un lugar ventilado\nSepara la pasta seca del papel y muélela hasta obtener polvo fino\nGuarda el polvo en el vasito con tapa",
            'instr_step1_image'      => '',
            'instr_step2_label'      => 'Paso 2',
            'instr_step2_title'      => 'Crear tu joya',
            'instr_step2_sobre'      => 'Sobre 2 — Resina',
            'instr_step2_duration'   => '24 horas de curado',
            'instr_step2_steps'      => "Extiende el individual de papel para proteger tu zona de trabajo\nPega el dije sobre el adhesivo azul\nPonte la mascarilla y los guantes de nitrilo\nVierte el componente A de la jeringa despacio, sin crear burbujas\nAgrega el componente B y mezcla constantemente durante 5 minutos\nLa mezcla se tornará turbia y luego transparente de nuevo al mezclar bien\nAgrega la leche preservada (el polvo) y mezcla hasta color homogéneo\nVierte la mezcla en el dije con la cucharita hasta llenar el borde\nRevisa los bordes y elimina burbujas con el palito\nDeja secar 24 horas sin mover el dije\nSepara el dije del papel adhesivo y colócalo en la cadena",
            'instr_step2_image'      => '',
            'instr_closing_title'    => '¡Tu joya está lista!',
            'instr_closing_text'     => 'Comparte una foto de tu creación con nosotros por WhatsApp o Instagram. Nos encantaría celebrar este momento contigo. Si tienes alguna duda puedes escribirnos, con mucho gusto te ayudaremos.',
            'instr_closing_btn_text' => 'Compartir mi joya por WhatsApp',

            // ── Trust Bar ───────────────────────────────────────────────────
            'trust_stat_1_number' => '500+',
            'trust_stat_1_label'  => 'Mamás felices',
            'trust_stat_2_number' => '100%',
            'trust_stat_2_label'  => 'Artesanal',
            'trust_stat_3_number' => 'DIY guiado',
            'trust_stat_3_label'  => 'Con instrucciones incluidas',
            'trust_stat_4_number' => 'Única',
            'trust_stat_4_label'  => 'Personalizada para ti',

            // ── Proceso de compra ───────────────────────────────────────────
            'proceso_label'        => 'Cómo funciona',
            'proceso_title'        => 'Tan simple como amar',
            'proceso_description'  => 'En 5 pasos sencillos transformarás tu leche materna en una joya que acompañará tu historia para siempre.',
            'proceso_step_1_title' => 'Elige tu kit',
            'proceso_step_1_desc'  => 'Explora nuestra colección y elige la joya que mejor refleje tu historia.',
            'proceso_step_2_title' => 'Recibe tu kit',
            'proceso_step_2_desc'  => 'Te llega todo lo que necesitas: molde, resina, preservante y guía paso a paso.',
            'proceso_step_3_title' => 'Preserva tu leche',
            'proceso_step_3_desc'  => 'Sigue las instrucciones para convertir tu leche materna en polvo preservado.',
            'proceso_step_4_title' => 'Crea tu joya',
            'proceso_step_4_desc'  => 'Mezcla, vierte y espera. El proceso es sorprendentemente sencillo y gratificante.',
            'proceso_step_5_title' => 'Atesórala',
            'proceso_step_5_desc'  => 'Tu pieza única, lista para acompañarte cada día y pasar de generación en generación.',

            // ── Personalización ─────────────────────────────────────────────
            'personaliz_label'  => 'Personalización',
            'personaliz_title'  => 'Tu joya, a tu manera',
            'personaliz_desc'   => 'Cada kit incluye elementos que puedes adaptar. Tu pieza será tan única como el vínculo que representa.',
            'personaliz_item_1' => 'Color del dije (plateado / dorado)',
            'personaliz_item_2' => 'Forma: redondo, corazón, gota',
            'personaliz_item_3' => 'Tipo de cadena incluida',
            'personaliz_item_4' => 'Tono de la leche (natural)',
            'personaliz_item_5' => 'Añadir piedras decorativas',
            'personaliz_item_6' => 'Grabado en la cadena',

            // ── Testimonios ─────────────────────────────────────────────────
            'testimonios_label'  => 'Lo que dicen las mamás',
            'testimonios_title'  => 'Historias que nos inspiran',
            'testimonio_1_name'  => 'María González',
            'testimonio_1_loc'   => 'Quito, Ecuador',
            'testimonio_1_text'  => 'Nunca pensé que hacer mi propia joya sería tan especial. Las instrucciones son clarísimas y el resultado es simplemente hermoso.',
            'testimonio_2_name'  => 'Sofía Ramírez',
            'testimonio_2_loc'   => 'Guayaquil, Ecuador',
            'testimonio_2_text'  => 'El kit llegó perfecto, todo muy bien explicado. Mi collar es ahora mi pieza favorita. Vale cada centavo.',
            'testimonio_3_name'  => 'Valentina Torres',
            'testimonio_3_loc'   => 'Cuenca, Ecuador',
            'testimonio_3_text'  => 'La calidad es increíble y el proceso fue mucho más fácil de lo que esperaba. Lo recomiendo a todas las mamás.',

            // ── FAQ ─────────────────────────────────────────────────────────
            'faq_label'  => 'Preguntas frecuentes',
            'faq_title'  => 'Todo lo que necesitas saber',
            'faq_1_q'    => '¿Cuánta leche necesito para hacer la joya?',
            'faq_1_a'    => 'Solo necesitas 1 ml de leche materna. Es muy poca cantidad y el proceso de preservación está incluido en el kit.',
            'faq_2_q'    => '¿Puedo usar leche congelada o solo fresca?',
            'faq_2_a'    => 'Puedes usar leche fresca, refrigerada o descongelada. Lo importante es que esté en buen estado al momento de usarla.',
            'faq_3_q'    => '¿Cuánto tiempo tarda en estar lista mi joya?',
            'faq_3_a'    => 'El proceso completo toma entre 48 y 72 horas: 24h de preservación + 24h de curado de la resina.',
            'faq_4_q'    => '¿Qué pasa si tengo dudas durante el proceso?',
            'faq_4_a'    => 'Incluimos una guía completa con fotos y puedes escribirnos por WhatsApp en cualquier momento para acompañamiento personalizado.',
            'faq_5_q'    => '¿Los materiales son seguros?',
            'faq_5_a'    => 'Sí. Todos los materiales son de grado joyería, hipoalergénicos y seguros. El kit incluye guantes y mascarilla de protección.',
            'faq_6_q'    => '¿La joya es resistente y duradera?',
            'faq_6_a'    => 'Una vez curada, la resina es muy resistente. Recomendamos evitar el contacto prolongado con agua, perfumes y químicos para preservar el brillo.',
        ];
    }
}
