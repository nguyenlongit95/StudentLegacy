<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'nguyenlongit95',
            'email' => 'nguyenlongit95@gmail.com',
            'password' => bcrypt('thanhnhan96'),
            'Level'=> 1
        ]);
        DB::table('categories_products')->insert([
            'NameCategory' => 'HouseHold',
            'Info' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, ',
            'Parent_id' => 1
        ]);
        DB::table('products')->insert([
            'Nameproduct' => 'Fan Electric A960',
            'idCategories' => 1,
            'Quantity' => 10,
            'Price' => 100,
            'Sales' => 5,
            'Info' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'Description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,'
        ]);
        DB::table('rattings')->insert([
            'idProduct' => 1,
            'Ratting' => 5
        ]);
        DB::table('custom_properties')->insert([
            'idProduct' => 1,
            'Properties' => 'Capacity',
            'Value' => '100W'
        ]);
        DB::table('image_products')->insert([
            'ImageProduct' => 'of1.png',
            'idProduct' => 1
        ]);
        DB::table('orders')->insert([
            'idUser' => 1,
            'Name' => 'Nguyen Cong Thai Long',
            'Address' => 'Ha Noi',
            'Phone'=> '+84693803548',
            'Total'=>2,
            'CodeOrder'=>"abc123123"
        ]);
        DB::table('order_details')->insert([
            'idProduct' => 1,
            'idOrder' => 1,
            'NameProduct' => 'Fan Electric A960',
            'Quantity'=> 1,
            'Price'=> 100,
            'CodeOrder'=> 'abc123123'
        ]);
        DB::table('state_orders')->insert([
            'idOrder' => 1,
            'State' => 1,
        ]);
        DB::table('info_of_pages')->insert([
            'PageName' => 'Abouts',
            'Info' => 'Lorem',
            'Value' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
        ]);
        DB::table('linkeds')->insert([
            'Linked' => 'FaceBook',
            'Value' => 'https://www.facebook.com/profile.php?id=100013698812957'
        ]);
        DB::table('contacts')->insert([
            'Name' => 'nguyenlongit95',
            'Email' => 'nguyenlongit1308@gmail.com',
            'Address' => 'Ha Noi',
            'Message' => 'Im want build a website!',
            'State'=> 1
        ]);
        DB::table('sliders')->insert([
            'Sliders' => 'nguyenlongit95.jpg',
            'Slogan' => 'nguyenlongit95@gmail.com'
        ]);
        DB::table('categories_blogs')->insert([
            'NameCategory' => 'nguyenlongit95',
            'Parent_id' => 1
        ]);
        DB::table('blogs')->insert([
            'Title' => 'Im a new coder',
            'Info' => 'nguyenlongit95@gmail.com',
            'Description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,',
            'Author'=> "LongNguyen",
            'Tags' => 'nguyenlongit95',
            'idCategoryBlog' => '1'
        ]);
        DB::table('comments')->insert([
            'idBlog' => 1,
            'idUser' => 1,
            'Comment' => 'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'Author'=> 'NguyenLongIT95'
        ]);

    }
}
