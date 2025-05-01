<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishesSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            // Appetizers (Category 1)
            [
                'name' => [
                    'ar' => 'سلطة يونانية',
                    'de' => 'Griechischer Salat'
                ],
                'description' => [
                    'ar' => 'سلطة طازجة مع الجبنة الفيتا والخيار والطماطم',
                    'de' => 'Frischer Salat mit Fetakäse, Gurken und Tomaten'
                ],
                'photo' => 'greek-salad.jpg',
                'category_id' => 1
            ],
            [
                'name' => [
                    'ar' => 'حساء الفطر',
                    'de' => 'Pilzsuppe'
                ],
                'description' => [
                    'ar' => 'حساء كريمي مع أنواع مختلفة من الفطر',
                    'de' => 'Cremige Suppe mit verschiedenen Pilzsorten'
                ],
                'photo' => 'mushroom-soup.jpg',
                'category_id' => 1
            ],

            // Main Dishes (Category 2)
            [
                'name' => [
                    'ar' => 'ستيك لحم',
                    'de' => 'Rindersteak'
                ],
                'description' => [
                    'ar' => 'ستيك لحم بقري مشوي مع صلصة الفلفل',
                    'de' => 'Gegrilltes Rindfleischsteak mit Pfeffersauce'
                ],
                'photo' => 'beef-steak.jpg',
                'category_id' => 2
            ],
            [
                'name' => [
                    'ar' => 'سمك السلمون',
                    'de' => 'Lachsfilet'
                ],
                'description' => [
                    'ar' => 'سمك السلمون مشوي مع صلصة الليمون',
                    'de' => 'Gegrillter Lachs mit Zitronensauce'
                ],
                'photo' => 'salmon-fillet.jpg',
                'category_id' => 2
            ],

            // Desserts (Category 3)
            [
                'name' => [
                    'ar' => 'تشيز كيك',
                    'de' => 'Käsekuchen'
                ],
                'description' => [
                    'ar' => 'تشيز كيك كلاسيكي مع طبقة من التوت',
                    'de' => 'Klassischer Käsekuchen mit Beerenschicht'
                ],
                'photo' => 'cheesecake.jpg',
                'category_id' => 3
            ]
        ];

        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
}