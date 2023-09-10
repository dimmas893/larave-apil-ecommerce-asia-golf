<?php

namespace App\Repositories;

use App\Models\Order;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class TransactionHistoryRepository
{
    public function getDataTransactionHistory($authCustomer, array $filter)
    {
        // dd('ds');
        $order = Order::query();
        if (!empty($filter['sort'])) {
            $search = $filter['sort'];
            $order->orderBy('created_at', $search);
        }
        if (!empty($filter['status'])) {
            $search = $filter['status'];
            $order->where('status', $search);
        }
        $data =  $order->where('customer_id', $authCustomer->id)->paginate($filter['perPage']);
        return $data;
    }

    public function getDataDetailTransactionHistory($order)
    {
        return $order;
    }

    public function getDataUnpaid($authCustomer)
    {
        $order = Order::where('customer_id', $authCustomer->id)->where('status', 'unpaid')->get();
        return $order;
    }
}
