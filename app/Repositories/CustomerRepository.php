<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/** Model */
use App\Models\Customer;

/** resource */
use App\Http\Resources\CustomerResource;

class CustomerRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Customer::class;
    }

}