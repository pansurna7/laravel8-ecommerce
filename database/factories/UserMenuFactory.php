<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            [
            'menu' => 'home',
            'icon_left' => 'nav-icon fas fa-tachometer-alt',
            'icon_right' => ''
            ],
            [
                'menu' => 'ACL',
                'icon_left' => 'fas fa-bars',
                'icon_right' => 'fas fa-chevron-circle-down'

                ]

        ];
    }
}
