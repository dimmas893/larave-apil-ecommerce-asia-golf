<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\AuthorisedDealer;
use App\Models\Brand;
use App\Models\Bundling;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\DiscountItem;
use App\Models\ExclusiveDistributor;
use App\Models\FlashSale;
use App\Models\Item;
use App\Models\ItemBundling;
use App\Models\ItemPhoto;
use App\Models\ItemVariant;
use App\Models\Coupon;
use App\Models\Discussion;
use App\Models\DiscussionAnswer;
use App\Models\ItemBundlingDetails;
use App\Models\ItemDiscount;
use App\Models\ItemMeta;
use App\Models\ItemReview;
use App\Models\MetaItem;
use App\Models\Order;
use App\Models\OrderCoupon;
use App\Models\OrderDetail;
use App\Models\Pertanyaan;
use App\Models\PertanyaanBalasan;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Stock;
use App\Models\Ulasan;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\Image as ImageProvider;

class DataSeeder extends Seeder
{
    public function run()
    {
        // $brand = Brand::create([
        //     'name' => 'adidas',
        //     'logo' => 'adidas.jpeg',
        //     'is_authorized' => true,
        //     'is_exclusive' => true,
        // ]);
        // $categories = Category::create([
        //     'name' => 'nama category',
        //     'structure' => 'structure'
        // ]);
        // $item = Item::create([
        //     'number' => '3242442',
        //     'name' => 'sepatu santai',
        //     'minimal_order' => 1,
        //     'is_bestseller' => true,
        //     'gender' => 'L',
        //     'brand_id' => $brand->id,
        //     'category_id' => $categories->id,
        //     'weight' => 1000,
        //     'price' => 50000,
        //     'deskripsi' => 'Brand sepatu lokal saat ini sudah mulai berkembang dengan pesat. Dari segi kualitas, brand sepatu lokal makin berkembang hingga tidak kalah bersaing dengan brand luar. PVN Shoes merupakan brand sepatu lokal yang sangat populer dikalangan para remaja khususnya wanita.'
        // ]);
        // $itemmeta = ItemMeta::create([
        //     'item_id' => $item->id,
        //     'sold' => 4,
        //     'review' => 3,
        //     'discussion' => 4,
        //     'rating' => 4
        // ]);
        // $product = Product::create([
        //     'code' => '001',
        //     'name' => 'sepatu vans',
        //     'productable_id' => $item->id,
        //     'productable_type' => 'App\Models\Item',
        // ]);
        // $itemvariant = ItemVariant::create([
        //     'code' => Str::random(5),
        //     'name' => 'item variant 1',
        //     'item_id' => $item->id,
        // ]);

        // $product2 = Product::create([
        //     'code' => '002',
        //     'name' => 'sepatu vans',
        //     'productable_id' => $itemvariant->id,
        //     'productable_type' => 'App\Models\ItemVariant',
        // ]);

        // $stock = Stock::create(
        //     [
        //         'item_id' => $item->id,
        //         'item_varian_id' => $itemvariant->id,
        //         'amount' => 11,
        //     ]
        // );
        // $stock = Stock::create(
        //     [
        //         'item_id' => $item->id,
        //         'item_varian_id' => $itemvariant2->id,
        //         'amount' => 11,
        //     ]
        // );

        // $Coupon = Coupon::create([
        //     'code' => Str::random(5),
        //     'description' => 'ini deskription',
        //     'nominal' => 2000,
        //     'customer_id' => (int) $customer->customer_id,
        //     'start_at' => '2022-06-07',
        //     'end_at' => '2024-06-07',
        //     'is_active' => false
        // ]);





        // $orderdetail = OrderDetail::create([
        //     'order_id' => $order->id,
        //     'product_id' => $product->id,
        //     'qty' => 1,
        //     'price' => 5000,
        //     'discount' => 1000,
        //     'total' => 6000
        // ]);








        // $ordercoupon = OrderCoupon::create([
        //     'order_id' => $order->id,
        //     'coupon_id' => $Coupon->id
        // ]);

        // $wishlist = Wishlist::create([
        //     'product_id' => $product->id,
        //     'customer_id' => $customer->id
        // ]);
        // $cart = Cart::create([
        //     'product_id' => $product->id,
        //     'customer_id' => $customer->id,
        //     'qty' => 2
        // ]);
        // $cart2 = Cart::create([
        //     'product_id' => $product2->id,
        //     'customer_id' => $customer->id,
        //     'qty' => 1
        // ]);

        /** faker */

        $faker = Faker::create('id_ID');
        $productableTypes = ['App\Models\Item', 'App\Models\ItemVariant', 'App\Models\ItemBundling'];
        $faker->addProvider(new ImageProvider($faker));
        $imageUrl = $faker->imageUrl('brands');


        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'role' => $faker->randomElement(['customer', 'admin']),
                'status' => $faker->randomElement(['active', 'suspended'])
            ]);

            $customer = Customer::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'whatsapp' => $faker->phoneNumber,
                'phone' => $faker->phoneNumber
            ]);

            $address = Address::create([
                'customer_id' => $customer->id,
                'name' => $faker->company,
                'subdistrict' => $faker->randomNumber(5),
                'province' => $faker->randomNumber(2),
                'city' => 39,
                'address' => $faker->address,
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
            ]);

            $brand = Brand::create([
                'name' => $faker->company,
                'logo' => 'adidas.jpeg',
                'is_authorized' => $faker->boolean,
                'is_exclusive' => $faker->boolean,
            ]);

            $categories = Category::create([
                'name' => $faker->word,
                'structure' => $faker->sentence
            ]);

            $item = Item::create([
                'number' => $faker->unique()->randomNumber(7),
                'name' => $faker->name,
                'minimal_order' => $faker->numberBetween(1, 10),
                'is_bestseller' => $faker->boolean,
                'gender' => $faker->randomElement(['L', 'P']),
                'brand_id' => $brand->id,
                'category_id' => $categories->id,
                'weight' => $faker->numberBetween(20, 100),
                'price' => $faker->numberBetween(10000, 100000),
                'deskripsi' => $faker->paragraph,
            ]);

            $itemdiscount = ItemDiscount::create([
                'item_id' => $item->id,
                'nominal' => $faker->numberBetween(1000, 100000),
                'type' => $faker->randomElement(['newuser', 'flashsale']),
                'start_at' => $faker->dateTimeBetween('2022-06-07', '2023-06-07'),
                'end_at' => $faker->dateTimeBetween('2023-06-08', '2024-06-07'),
            ]);

            $order = Order::create([
                'number' => Str::random(5),
                'customer_id' => $customer->id,
                'address_id' => $address->id,
                'subtotal' => $faker->numberBetween(1, 100),
                'discount' => $itemdiscount->nominal,
                'tax' => $faker->numberBetween(10000, 100000),
                'shipping_fee' => $faker->numberBetween(10000, 100000),
                'total' => $faker->numberBetween(10000, 100000),
                'end_paid' => $faker->dateTimeBetween('2023-02-27 18:36:48', '2023-06-27 18:36:48'),
                'date_checkout' => $faker->dateTimeBetween('2023-06-08', '2024-06-07'),
                'number_paid' => $faker->numberBetween(1000, 100000),
                'method' => $faker->randomElement(['bca', 'bri']),
                'status' => $faker->randomElement(['selesai', 'tiba di tujuan', 'dibatalkan', 'sedang dikirim', 'unpaid', 'paid']),
                'note' => 'note',
            ]);



            for ($j = 0; $j < 5; $j++) {
                $itemvariant = ItemVariant::create([
                    'code' => $faker->randomNumber(5),
                    'name' => 'variant ' . $faker->name . $faker->numberBetween(1, 30),
                    'item_id' => $item->id,
                ]);
                $stock = Stock::create([
                    'item_id' => $item->id,
                    'item_varian_id' => $itemvariant->id,
                    'amount' => $faker->numberBetween(10, 200),
                ]);
                $itemPhoto = ItemPhoto::create([
                    'item_id' => $item->id,
                    'item_variant_id' => $itemvariant->id,
                    'filename' => 'adidas.jpeg',
                    'is_default' => true
                ]);

                $itemreview = ItemReview::create([
                    'item_id' => $item->id,
                    'customer_id' => $customer->id,
                    'order_id' => $order->id,
                    'content' => 'ini content',
                    'photo' => 'adidas.jpeg',
                    'rating' => 4
                ]);

                $itemreview = ItemReview::create([
                    'item_id' => $item->id,
                    'customer_id' => $customer->id,
                    'order_id' => $order->id,
                    'content' => $faker->sentence,
                    'photo' => 'adidas.jpeg',
                    'rating' => $faker->numberBetween(1, 5)
                ]);

                // $discussion = Discussion::create([
                //     'item_id' => $item->id,
                //     'content' => $faker->sentence,
                //     'customer_id' => $customer->id
                // ]);
            }

            $itemmeta = ItemMeta::create([
                'item_id' => $item->id,
                'sold' => $faker->numberBetween(1, 100),
                'review' => $faker->numberBetween(1, 20),
                'discussion' => $faker->numberBetween(1, 20),
                'count_image' => $faker->numberBetween(1, 20),
                'rating' => $faker->numberBetween(1, 100)
            ]);

            $coupon = Coupon::create([
                'code' => $faker->unique()->randomNumber(5),
                'description' => 'deskripsi',
                'nominal' => 3000,
                'start_at' => $faker->dateTimeBetween('2022-06-07', '2023-06-07'),
                'end_at' => $faker->dateTimeBetween('2023-06-08', '2024-06-07'),
                'customer_id' => $customer->id,
            ]);

            $discussion = Discussion::create([
                'item_id' => $item->id,
                'content' => 'ini content',
                'customer_id' => $customer->id,
            ]);

            $discussion = DiscussionAnswer::create([
                'content' => 'ini content',
                'discussion_id' => $discussion->id,
                'user_id' => $user->id,
            ]);

            $itembundling = ItemBundling::create([
                'name' => $faker->word,
                'price' => $faker->numberBetween(1000, 5000),
                'saving' => $faker->sentence
            ]);

            for ($k = 0; $k < 3; $k++) {
                $itembundlingdetail = ItemBundlingDetails::create([
                    'item_bundling_id' => $itembundling->id,
                    'item_id' => $item->id,
                ]);
            }

            $productableTypes = ['App\Models\Item', 'App\Models\ItemVariant', 'App\Models\ItemBundling'];
            $productableType = $faker->randomElement($productableTypes);

            if ($productableType === 'App\Models\Item') {
                $productableId = $item->id;
            } elseif ($productableType === 'App\Models\ItemVariant') {
                $productableId = $itemvariant->id;
            } else {
                $productableId = $itembundling->id;
            }

            $product = Product::create([
                'code' => $faker->unique()->randomNumber(3),
                'name' => $faker->name,
                'productable_id' => $productableId,
                'productable_type' => $productableType,
            ]);

            $wishlist = Wishlist::create([
                'product_id' => $product->id,
                'customer_id' => $customer->id,
            ]);
            $orderDetail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $faker->numberBetween(1, 10),
                'price' => $faker->numberBetween(10000, 1000000),
                'discount' => $faker->numberBetween(1000, 10000),
                'total' => $faker->numberBetween(2000, 20000),
            ]);
        }
    }
}
