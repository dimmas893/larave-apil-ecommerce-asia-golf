<?php

namespace App\Repositories;

use App\Models\Customer;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class AuthCustomerRepository
{
    public function auth()
    {
        // dd(Auth()->user());
        $user_id = Auth()->user()->id;
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        return $customer;
    }
}
