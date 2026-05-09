<?php

namespace Database\Seeders;

use App\Models\Ambassador;
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

        // Category
        $dijes = Category::firstOrCreate(
            ['slug' => 'dijes'],
            [
                'name' => 'Dijes',
                'description' => 'Kits DIY para crear dijes de leche materna',
                'is_active' => true,
                'order' => 1,
            ]
        );

        // Products — 4 confirmed SKUs
        $products = [
            [
                'name'              => 'Dije Plateado Corazón',
                'slug'              => 'dije-plateado-corazon',
                'code'              => 'DPC',
                'material'          => 'silver',
                'shape'             => 'heart',
                'short_description' => 'Kit DIY para crear un dije plateado en forma de corazón con tu leche materna.',
                'price'             => 33.00,
                'badge'             => null,
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'name'              => 'Dije Plateado Gota',
                'slug'              => 'dije-plateado-gota',
                'code'              => 'DPG',
                'material'          => 'silver',
                'shape'             => 'drop',
                'short_description' => 'Kit DIY para crear un dije plateado en forma de gota con tu leche materna.',
                'price'             => 33.00,
                'badge'             => null,
                'is_featured'       => true,
                'order'             => 2,
            ],
            [
                'name'              => 'Dije Dorado Corazón',
                'slug'              => 'dije-dorado-corazon',
                'code'              => 'DDC',
                'material'          => 'gold',
                'shape'             => 'heart',
                'short_description' => 'Kit DIY para crear un dije dorado en forma de corazón con tu leche materna.',
                'price'             => 37.00,
                'badge'             => 'Más popular',
                'is_featured'       => true,
                'order'             => 3,
            ],
            [
                'name'              => 'Dije Dorado Gota',
                'slug'              => 'dije-dorado-gota',
                'code'              => 'DDG',
                'material'          => 'gold',
                'shape'             => 'drop',
                'short_description' => 'Kit DIY para crear un dije dorado en forma de gota con tu leche materna.',
                'price'             => 37.00,
                'badge'             => null,
                'is_featured'       => true,
                'order'             => 4,
            ],
        ];

        $commonIncludes = [
            'Resina epóxica de grado joyería',
            'Catalizador medido',
            'Molde de silicona para dije',
            'Preservante en polvo para leche materna',
            'Cadena incluida',
            'Guantes de nitrilo (2 pares)',
            'Mascarilla desechable',
            'Instrucciones paso a paso ilustradas',
            'Caja de regalo',
            'Vela blanca',
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'category_id'       => $dijes->id,
                    'description'       => $data['short_description'],
                    'includes'          => $commonIncludes,
                    'original_price'    => null,
                    'whatsapp_message'  => "Hola! Me interesa el *{$data['name']}* por \${$data['price']}. ¿Cómo puedo pedirlo?",
                    'is_active'         => true,
                ])
            );
        }

        // Ambassador codes
        $ambassadors = [
            ['name' => 'Embajadora', 'lastname' => 'MasLactancia',  'email' => 'maslactancia@example.com',  'code' => 'MASLACTANCIA',  'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'DoulaZul',      'email' => 'doulazul@example.com',      'code' => 'DOULAZUL',      'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'MiaConAmor',    'email' => 'miaconamor@example.com',    'code' => 'MIACONAMOR',    'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Dra.',       'lastname' => 'Danica',        'email' => 'dradarica@example.com',     'code' => 'DRADARICA',     'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Dra.',       'lastname' => 'Irma',          'email' => 'drairma@example.com',       'code' => 'DRAIRMA',       'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'LactaManta26',  'email' => 'lactamanta26@example.com',  'code' => 'LACTAMANTA26',  'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'LaDocSanta',    'email' => 'ladocsanta@example.com',    'code' => 'LADOCSANTA',    'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'Acunar',        'email' => 'acunar@example.com',        'code' => 'ACUNAR',        'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'TibyDoula',     'email' => 'tibydoula@example.com',     'code' => 'TIBYDOULA',     'discount_type' => 'percent', 'discount_value' => 10],
            ['name' => 'Embajadora', 'lastname' => 'AimeMayu',      'email' => 'aimemayu@example.com',      'code' => 'AIMEMAYU',      'discount_type' => 'percent', 'discount_value' => 10],
        ];

        foreach ($ambassadors as $data) {
            Ambassador::firstOrCreate(
                ['code' => $data['code']],
                array_merge($data, ['is_active' => true, 'notes' => null])
            );
        }

        // Gallery items
        $galleryImages = [
            ['seed' => 'necklace1',   'caption' => 'Un vínculo irrompible',     'alt' => 'Collar de leche materna'],
            ['seed' => 'necklace2',   'caption' => 'Llévalo siempre contigo',   'alt' => 'Collar de leche materna puesto'],
            ['seed' => 'giftbox2',    'caption' => 'Todo lo que necesitas',     'alt' => 'Caja del Kit'],
            ['seed' => 'jewelry1',    'caption' => 'Hecho con amor',            'alt' => 'Joya de leche materna'],
            ['seed' => 'motherhood2', 'caption' => 'Tu historia, tu joya',      'alt' => 'Madre con su joya'],
            ['seed' => 'diy1',        'caption' => 'Crea tu propio tesoro',     'alt' => 'Proceso de creación DIY'],
        ];

        foreach ($galleryImages as $i => $img) {
            GalleryItem::firstOrCreate(
                ['image' => "https://picsum.photos/seed/{$img['seed']}/600/600"],
                [
                    'caption'  => $img['caption'],
                    'alt'      => $img['alt'],
                    'is_active'=> true,
                    'order'    => $i + 1,
                ]
            );
        }
    }
}
