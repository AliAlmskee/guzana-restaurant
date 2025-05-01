<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => [
                    'ar' => 'المقبلات',
                    'de' => 'Vorspeisen'
                ]
            ],
            [
                'name' => [
                    'ar' => 'الوجبات الرئيسية',
                    'de' => 'Hauptgerichte'
                ]
            ],
            [
                'name' => [
                    'ar' => 'الحلويات',
                    'de' => 'Desserts'
                ]
            ],
            [
                'name' => [
                    'ar' => 'المشروبات',
                    'de' => 'Getränke'
                ]
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}