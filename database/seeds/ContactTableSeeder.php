<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     /*   DB::table('contacts')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'age' => 20,
            'phone' => '554545-4554',
            'indenty'=>'f',
            'user_id'=>1,
        ]);*/

        Contact::insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'age' => 20,
            'phone' => '554545-4554',
            'indenty'=>'f',
            'user_id'=>1,
        ]);
        /*
        App\Contact::insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'age' => 20,
            'phone' => '554545-4554',
            'indenty'=>'f',
            'user_id'=>1,
        ]);*/

    }
}
