<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'role_id'   => '1',
            'firstname' => 'Super',
            'lastname'  => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@blog.com',
            'password'  => bcrypt('admin'),
        ]);

        App\Profile::create([
            'user_id'   => $user->id,
            'profile_pics'  => 'assets/uploads/authorpics/dp.png',
            'about'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'facebook'  => 'https://facebook.com/incattech',
            'instagram' => 'https://instagram.com/incattech',
            'twitter'   => 'https://twitter.com/incattech',
            'youtube'   => 'https://youtube.com/',
            'whatsapp'  => 'https://api.whatsapp.com/send?phone=2348135282319',
        ]);

        $user = App\User::create([
            'role_id'   => '2',
            'firstname' => 'First',
            'lastname'  => 'Author',
            'username'  => 'author',
            'email'     => 'author@blog.com',
            'password'  => bcrypt('author'),
        ]);

        App\Profile::create([
            'user_id'   => $user->id,
            'profile_pics'  => 'assets/uploads/authorpics/dp.png',
            'about'     => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'facebook'  => 'https://facebook.com/',
            'instagram' => 'https://instagram.com/',
            'twitter'   => 'https://twitter.com/',
            'youtube'   => 'https://youtube.com/',
            'whatsapp'  => 'https://api.whatsapp.com/send?phone=',
        ]);
    }
}
