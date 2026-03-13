<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@untesoroparamama.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123456'),
                'email_verified_at' => now(),
            ]
        );

        // Categories
        $collares = Category::create([
            'name' => 'Collares',
            'slug' => 'collares',
            'description' => 'Kits para crear collares con leche materna',
            'is_active' => true,
            'order' => 1,
        ]);

        $dijes = Category::create([
            'name' => 'Dijes',
            'slug' => 'dijes',
            'description' => 'Kits para crear dijes y colgantes',
            'is_active' => true,
            'order' => 2,
        ]);

        $pulseras = Category::create([
            'name' => 'Pulseras',
            'slug' => 'pulseras',
            'description' => 'Kits para crear pulseras',
            'is_active' => true,
            'order' => 3,
        ]);

        // Products
        Product::create([
            'category_id' => $collares->id,
            'name' => 'Kit Collar Clásico',
            'slug' => 'kit-collar-clasico',
            'short_description' => 'El kit perfecto para comenzar tu joya de leche materna. Incluye todo lo esencial.',
            'description' => 'Con el Kit Collar Clásico podrás crear una hermosa joya de leche materna desde la comodidad de tu hogar.',
            'price' => 49.99,
            'original_price' => 69.99,
            'includes' => [
                'Resina epóxica transparente (5ml)',
                'Catalizador medido',
                'Molde de silicona para dije redondo',
                'Cadena plateada 45cm',
                'Pigmentos nacarados (3 colores)',
                'Guantes de látex (2 pares)',
                'Palitos mezcladores',
                'Instrucciones paso a paso ilustradas',
                'Caja de regalo',
            ],
            'whatsapp_message' => 'Hola! Me interesa el *Kit Collar Clásico* por $49.99. ¿Cómo puedo pedirlo?',
            'badge' => 'Más popular',
            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);

        Product::create([
            'category_id' => $collares->id,
            'name' => 'Kit Collar Premium',
            'slug' => 'kit-collar-premium',
            'short_description' => 'La experiencia completa con materiales premium y múltiples moldes.',
            'description' => 'El Kit Collar Premium es para la mamá que merece lo mejor. Incluye moldes exclusivos y cadena de oro de 14k.',
            'price' => 89.99,
            'original_price' => null,
            'includes' => [
                'Resina epóxica de grado joyería (10ml)',
                'Catalizador de precisión',
                'Set de 3 moldes de silicona exclusivos',
                'Cadena dorada 45cm (baño de oro 14k)',
                'Pigmentos nacarados premium (6 colores)',
                'Hoja de purpurina',
                'Guantes de nitrilo (4 pares)',
                'Instrucciones en video (QR)',
                'Caja de lujo con lazo',
                'Tarjeta de certificado artesanal',
            ],
            'whatsapp_message' => 'Hola! Me interesa el *Kit Collar Premium* por $89.99. ¿Cómo puedo pedirlo?',
            'badge' => 'Premium',
            'is_featured' => true,
            'is_active' => true,
            'order' => 2,
        ]);

        Product::create([
            'category_id' => $dijes->id,
            'name' => 'Kit Dije Corazón',
            'slug' => 'kit-dije-corazon',
            'short_description' => 'Crea un dije en forma de corazón con tu leche materna. Un símbolo de amor eterno.',
            'description' => 'El Kit Dije Corazón es el regalo perfecto para celebrar el amor de madre.',
            'price' => 39.99,
            'original_price' => 55.00,
            'includes' => [
                'Resina epóxica transparente (5ml)',
                'Catalizador medido',
                'Molde de silicona corazón',
                'Argolla dorada y mosquetón',
                'Cadena fina 40cm',
                'Pigmentos rosas y blancos',
                'Guantes de látex (2 pares)',
                'Instrucciones paso a paso',
                'Caja de regalo',
            ],
            'whatsapp_message' => 'Hola! Me interesa el *Kit Dije Corazón* por $39.99. ¿Cómo puedo pedirlo?',
            'badge' => null,
            'is_featured' => true,
            'is_active' => true,
            'order' => 3,
        ]);

        Product::create([
            'category_id' => $pulseras->id,
            'name' => 'Kit Pulsera Recuerdo',
            'slug' => 'kit-pulsera-recuerdo',
            'short_description' => 'Una pulsera delicada que llevarás siempre como símbolo del camino recorrido.',
            'description' => 'El Kit Pulsera Recuerdo te permite crear una pulsera única con tu leche materna.',
            'price' => 35.99,
            'original_price' => null,
            'includes' => [
                'Resina epóxica transparente (3ml)',
                'Catalizador',
                'Molde de silicona para pulsera',
                'Hilo elástico de joyería',
                'Cierre de pulsera dorado',
                'Pigmentos nacarados (3 colores)',
                'Guantes de látex (1 par)',
                'Instrucciones paso a paso',
                'Bolsa de regalo',
            ],
            'whatsapp_message' => 'Hola! Me interesa el *Kit Pulsera Recuerdo* por $35.99. ¿Cómo puedo pedirlo?',
            'badge' => 'Nuevo',
            'is_featured' => true,
            'is_active' => true,
            'order' => 4,
        ]);

        // Gallery items (using picsum for placeholder)
        $galleryImages = [
            ['seed' => 'necklace1', 'caption' => 'Un vínculo irrompible', 'alt' => 'Collar de leche materna'],
            ['seed' => 'necklace2', 'caption' => 'Llévalo siempre contigo', 'alt' => 'Collar de leche materna puesto'],
            ['seed' => 'giftbox2', 'caption' => 'Todo lo que necesitas', 'alt' => 'Caja del Kit'],
            ['seed' => 'jewelry1', 'caption' => 'Hecho con amor', 'alt' => 'Joya de leche materna'],
            ['seed' => 'motherhood2', 'caption' => 'Tu historia, tu joya', 'alt' => 'Madre con su joya'],
            ['seed' => 'diy1', 'caption' => 'Crea tu propio tesoro', 'alt' => 'Proceso de creación DIY'],
        ];

        foreach ($galleryImages as $i => $img) {
            GalleryItem::create([
                'image' => "https://picsum.photos/seed/{$img['seed']}/600/600",
                'caption' => $img['caption'],
                'alt' => $img['alt'],
                'is_active' => true,
                'order' => $i + 1,
            ]);
        }
    }
}
