<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'S',
                        'description' => 'Chica'
                    ],
                    [
                        'value' => 'M',
                        'description' => 'Mediana'
                    ],
                    [
                        'value' => 'L',
                        'description' => 'Grande'
                    ],
                    [
                        'value' => 'XL',
                        'description' => 'Extra Grande'
                    ]
                ]
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#000000',
                        'description' => 'Negro'
                    ],
                    [
                        'value' => '#FFFFFF',
                        'description' => 'Blanco'
                    ],
                    [
                        'value' => '#FF0000',
                        'description' => 'Rojo'
                    ],
                    [
                        'value' => '#00FF00',
                        'description' => 'Verde'
                    ],
                    [
                        'value' => '#0000FF',
                        'description' => 'Azul'
                    ],
                    [
                        'value' => '#FFFF00',
                        'description' => 'Amarillo'
                    ],
                    [
                        'value' => '#FF00FF',
                        'description' => 'Magenta'
                    ],
                    [
                        'value' => '#00FFFF',
                        'description' => 'Cian'
                    ],
                    [
                        'value' => '#800000',
                        'description' => 'Marron'
                    ],
                    [
                        'value' => '#808000',
                        'description' => 'Oliva'
                    ],
                    [
                        'value' => '#008000',
                        'description' => 'Verde Oscuro'
                    ]
                ]
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'M',
                        'description' => 'Masculino'
                    ],
                    [
                        'value' => 'F',
                        'description' => 'Femenino'
                    ]
                ]
            ]
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type']
            ]);
            foreach ($option['features'] as $feature) {
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description']
                ]);
            }
        }
    }
}
