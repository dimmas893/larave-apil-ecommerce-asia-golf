<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class SyncItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = DB::connection("pos")
            ->select("SELECT 
                items.number,
                items.name,
                brand_id,
                genders.name as gender_name,
                net_weight,
                unit_price
             FROM items LEFT JOIN genders ON gender_id = genders.id");

            
        $data_variant = DB::connection("pos")
            ->select("SELECT 
                description,
                item_id
            FROM item_variants
                where description <> ''");

        DB::statement("CREATE TEMPORARY TABLE item_temp (
            number varchar,
            name varchar,
            image varchar,
            min_pemesanan int,
            kondisi varchar,
            is_bestseller    boolean,
            brand_id integer,
            gender varchar,
            berat float,
            harga float,
            deskripsi text
        )");

        DB::statement("CREATE TEMPORARY TABLE item_variant_temp (
            name varchar,
            item_id int
        )");

        $chunked_items = array_chunk($data,1000,true);
        foreach($chunked_items as $items){
            DB::table("item_temp")->insert(collect($items)->map(function($item){
                return [
                    "number" => $item->number,
                    "name" => $item->name,
                    "gender" => $item->gender_name ? $item->gender_name:"",
                    "brand_id" => $item->brand_id ? $item->brand_id : 0,
                    "berat" => $item->net_weight,
                    "harga" => $item->unit_price
                ];
            })->toArray());
        }

        $chunked_variant_items = array_chunk($data_variant,1000,true);
        foreach($chunked_variant_items as $items){
            DB::table("item_variant_temp")->insert(collect($items)->map(function($item){
                return [
                    "name" => $item->description,
                    "item_id" => $item->item_id
                ];
            })->toArray());
        }

        DB::statement("INSERT INTO items (
            number,
            name,
            image,
            brand_id,
            gender,
            berat,
            harga
            )
        SELECT 
            number,
            name,
            image,
            brand_id,
            gender,
            berat,
            harga
        FROM 
            item_temp
        ON CONFLICT (number) DO UPDATE SET 
            name = EXCLUDED.name,
            brand_id = EXCLUDED.brand_id,
            gender = EXCLUDED.gender,
            berat = EXCLUDED.berat,
            harga = EXCLUDED.harga
        ");

        DB::statement("TRUNCATE item_variants");
        DB::statement("INSERT INTO item_variants (name, item_id)
            SELECT name, item_id FROM item_variant_temp
        ");


        return 0;
    }
}
