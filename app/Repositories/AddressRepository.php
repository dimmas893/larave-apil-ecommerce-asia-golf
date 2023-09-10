<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/** Model */

use App\Models\Alamat;

/** resource */

use App\Http\Resources\AlamatResource;
use App\Http\Resources\v2\AddressResource;
use App\Models\Address;
use App\Models\Customer;

class AddressRepository
{

    private $user_id;

    public function __construct()
    {
        $this->user_id = Auth()->user();
    }

    public function findByAddress()
    {
        $user_id = Auth()->user()->id;
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        $address = Address::where('customer_id', $customer->id)->get();
        return $address;
    }

    public function create(array $data)
    {
        $user_id = Auth()->user()->id;
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        $this->addedAddress($customer, $data);
    }

    function addedAddress($customer, $data)
    {
        return Address::create([
            'customer_id' => $customer->id,
            'name' => $data['name'],
            'address' => $data['address'],
            'subdistrict' => $data['subdistrict'],
            'city' => $data['city'],
            'province' => $data['province'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'is_active' => false,
        ]);
    }

    // function added($customer, array $data)
    // {
    //     Address::where('id', $alamat->id)->update(['status' => 'not active']);
    //     $this->addedAddress($customer, $data);
    // }

    function choose($address)
    {
        // dd('ds');
        $user_id = Auth()->user()->id;
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        $updateDataFalse = Address::where('customer_id', $customer->id)->get();
        // dd($updateDataFalse);
        foreach ($updateDataFalse as $p) {
            $p->update(['is_active' => false]);
        }
        Address::where('id', $address->id)->update(['is_active' => true]);
    }



    public function delete($address)
    {
        Address::where('id', $address->id)->delete();
    }

    public function detail($address)
    {
        return new AddressResource($address);
    }

    public function update($address, array $data)
    {
        $address->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'subdistrict' => $data['subdistrict'],
            'city' => $data['city'],
            'province' => $data['province'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ]);
    }
}
