<?php

namespace App\Repositories\Auth;


/** config */

use Config as config;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Customer;

use Illuminate\Validation\ValidationException;
use Hash;

class LocalRepository
{
    public function login(array $data)
    {
        // $user = User::where("email", $data["email"])->firstOrFail();
        // if (!$user)
        //     throw ValidationException::withMessages([
        //         "email" => "Email is not exists!"
        //     ]);
        // if (!Hash::check($data["password"], $user->password))
        //     throw ValidationException::withMessages([
        //         "password" => "Password is wrong!"
        //     ]);
        // $token = $user->createToken("pos");
        // $customer = Customer::where("user_id", $user->id)->firstOrFail();

        // return [
        //     "user" => $user,
        //     "customer" => $customer,
        //     "token" => $token->plainTextToken
        // ];
    }

    public function register($data)
    {
        $user = User::firstOrNew([
            "email" => $data["email"]
        ]);
        $user->password = Hash::make($data["password"]);
        $user->name = $data["name"];
        $user->save();

        $customer = Customer::firstOrNew([
            "user_id" => $user->id
        ]);
        $customer->email = $data["email"];
        $customer->name = $data["name"];
        $customer->phone = @$data["phone"];
        $customer->whatsapp = @$data["whatsapp"];
        $customer->save();
        // return [
        // "user" => $user
        // "customer" => $customer
        // ];
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}