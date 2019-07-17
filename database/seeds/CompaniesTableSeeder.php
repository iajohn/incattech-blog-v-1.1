<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Company::create([
        	'name'        =>  'INCATTECH',
          'country'     =>  'Nigeria',
          'city'        =>  'Lagos',
          'street'      =>  'Arowojobe estate, maryland',
          'email'       =>  'incattech@gmail.com',
          'webmail'     =>  'info@incattech.com',
          'number'      =>  '+2348135282319',
          'facebook'    =>  'https://facebook.com/incattech',
          'instagram'   =>  'https://instagram.com/incattech',
          'twitter'     =>  'https://twitter.com/incattech',
          'whatsapp'    =>  'https://api.whatsapp.com/send?phone=2348135282319',
          'youtube'     =>  'https://youtube.com/',
          'about_body'  =>  'Hi. We’re Incattech.com, the publishing arm of Incattech, a promising Fashion Tech company based in Lagos Nigeria. Our aim is to bring to the world the news, products, and narratives on Fashion and Technology If you have a news tip for us, please get in touch info@incattech.com If you have a press request for us, please get in touch info@incattech.com ',
        ]);
    }
}
