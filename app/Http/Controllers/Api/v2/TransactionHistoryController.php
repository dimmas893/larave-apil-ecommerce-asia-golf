<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionHistoryRequest as RequestsTransactionHistoryRequest;
use App\Http\Requests\v2\TransactionHistoryRequest;
use App\Http\Requests\v2\TransactionHistoryReuest;
use App\Http\Resources\v2\TransactionHistoryResource;
use App\Models\Order;
use App\Repositories\AuthCustomerRepository;
use App\Repositories\TransactionHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index(RequestsTransactionHistoryRequest $transactionHistoryRequest, TransactionHistoryRepository $transactionHistoryRepository, AuthCustomerRepository $authCustomerRepository)
    {
        // dd(Auth::user());
        $filter = $transactionHistoryRequest->validated();
        $authCustomer = $authCustomerRepository->auth();
        $data = $transactionHistoryRepository->getDataTransactionHistory($authCustomer, $filter);
        return TransactionHistoryResource::collection($data);
    }

    public function detail(Order $order, TransactionHistoryRepository $transactionHistoryRepository, AuthCustomerRepository $authCustomerRepository)
    {

        $authCustomer = $authCustomerRepository->auth();
        $data = $transactionHistoryRepository->getDataDetailTransactionHistory($order);
        // dd($data);
        return new TransactionHistoryResource($data);
    }

    public function unpaid(TransactionHistoryRepository $transactionHistoryRepository, AuthCustomerRepository $authCustomerRepository)
    {

        $authCustomer = $authCustomerRepository->auth();
        $data = $transactionHistoryRepository->getDataUnpaid($authCustomer);
        // dd($data);
        return TransactionHistoryResource::collection($data);
    }
}
