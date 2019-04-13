<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,
        'age' => 20,
        'indenty'=>'f',
        'user_id' => function(){
            return factory(User::class)->create()->id;
         },
    ];
});