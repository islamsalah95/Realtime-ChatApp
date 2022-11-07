<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'id',
            'message',
            'sender',
            'friend_id',
            'created_at',
            'updated_at',
        ];
    }
}
