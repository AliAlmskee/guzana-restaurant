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
                'photo' => 'http://127.0.0.1:8000/uploads/cbd1f80d-0382-4fa8-8442-9abd172f500f.jpg',
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
                'photo' => 'http://127.0.0.1:8000/uploads/d6270910-5220-43fe-80bb-a7e849fb0e86.jpg',
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
                'photo' => 'http://127.0.0.1:8000/uploads/3f6c3125-6197-41d6-b032-211db32ad981.jpg',
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
                'photo' => 'http://127.0.0.1:8000/uploads/0e298c67-8c6a-43d7-a9ff-a65fea39b506.jpg',
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
                'photo' => 'http://127.0.0.1:8000/uploads/409fce42-02df-447e-a1f2-d1b0ac39767b.jpg',
                'category_id' => 3
            ]
        ];

        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
}