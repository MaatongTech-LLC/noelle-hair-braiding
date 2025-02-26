<?php

namespace Database\Seeders;

use App\Models\Cart;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\Wishlist;
use App\Models\Appointment;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Noelle',
            'email' => 'noelle@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '737-203-1025',
            'role' => 'admin'
        ]);

        // Create Service Categories and Services
        ServiceCategory::factory(5)->create()->each(function ($category) {
            $category->services()->saveMany(Service::factory(10)->make());
        });

        // Create Product Categories and Products
        ProductCategory::factory(5)->create()->each(function ($category) {
            $category->products()->saveMany(Product::factory(10)->make());
        });

         // Create Appointments for Users
         User::all()->each(function ($user) {
            $user->appointments()->saveMany(Appointment::factory(3)->make());
        });

        // Create Orders, Carts, and Wishlists for Users
        User::all()->each(function ($user) {
            $user->orders()->saveMany(Order::factory(3)->make());
            $user->cart()->save(Cart::factory()->make());
            $user->wishlist()->save(Wishlist::factory()->make());
        });

        $this->call(PaymentSeeder::class);

    }
}
