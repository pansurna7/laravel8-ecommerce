<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSubMenuFactory extends Factory
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
            ['menu_id' =>'2',
            'title' =>'role',
            'slug' => 'role.index',
            'icon' => 'far fa-circle text-danger nav-icon'],
            
            ['menu_id' =>'2',
            'title' =>'parmission',
            'slug' => 'parmission.index',
            'icon' => 'far fa-circle text-danger nav-icon'],




        ];
    }
}
