<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

/** model */

use App\Models\Alamat;

/** resource */

use App\Http\Resources\AlamatResource;

/** repository */

use App\Repositories\AddressRepository;

/** request */

use App\Http\Requests\AddressRequest;
use App\Http\Resources\v2\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(AddressRepository $addressRepository)
    {
        try {
            $address = $addressRepository->findByAddress();
            // dd($address);
            return AddressResource::collection($address);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(AddressRequest $addressRequest, AddressRepository $addressRepository)
    {
        try {
            $data = $addressRequest->validated();
            $address = $addressRepository->create($data);
            return [
                'status' => 'success',
                'message' => _('address created')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function added(Alamat $alamat, AddressRequest $addressRequest, AddressRepository $addressRepository)
    {
        try {
            $data = $addressRequest->validated();
            $address = $addressRepository->added($alamat, $data);
            return [
                'status' => 'success',
                'message' => _('address added')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function choose(Address $address, AddressRepository $addressRepository)
    {
        try {
            $address = $addressRepository->choose($address);
            return [
                'status' => 'success',
                'message' => _('address choosed')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Address $address, AddressRepository $addressRepository)
    {
        try {
            $address = $addressRepository->delete($address);
            return [
                'status' => 'success',
                'message' => _('address deleted')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function detail(Address $address, AddressRepository $addressRepository)
    {
        try {
            $address = $addressRepository->detail($address);
            return $address;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Address $address, AddressRepository $addressRepository, AddressRequest $addressRequest)
    {
        try {
            $data = $addressRequest->validated();
            $address = $addressRepository->update($address, $data);
            return [
                'status' => 'success',
                'message' => _('address updated')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
