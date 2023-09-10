<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use File;
use Illuminate\Support\Facades\Hash;
use Str;
//use Your Model

/**
 * Class ProfileRepository.
 */
class ProfileRepository
{
    public function update($request)
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();
        $customer = Customer::where('user_id', $user->id)->firstOrFail();
        $lampiranFulltextFile = null;
        if ($request->hasFile('photo')) {
            if ($customer->photo) {
                File::delete(public_path('/storage/customer/' . $customer->photo));
            }
            $file = $request->file('photo');
            $file_extension = $file->getClientOriginalExtension();
            $lokasiFile = public_path() . '/storage/customer';

            $this->lampiranFulltextFile =  $request->id . Str::random(5) . '.' . $file_extension;
            $request->file('photo')->move($lokasiFile, $this->lampiranFulltextFile);
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        } else {
            $this->lampiranFulltextFile = $customer->photo;
            $lampiranFulltextFile = $this->lampiranFulltextFile;
        }

        // dd($lampiranFulltextFile);
        User::where('id', $user_id)->update([
            'email' => $request->email,
        ]);
        Customer::where('user_id', $user->id)->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $lampiranFulltextFile,
        ]);

        return [
            'message' => 'Berhasil mengubah profile'
        ];
    }

    public function updatePassword($request)
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();
        if (Hash::check($request->password_old, $user->password)) {
            $user->update([
                'password' => $request->password_baru,
            ]);
            return response()->json([
                'message' => "berhasil mengganti password"
            ]);
        } else {
            return response()->json([
                'message' => "password tidak cocok"
            ], 404);
        }
    }

    public function nonAktifAkunRepository()
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();
        $user->update([
            'status' => 'active'
        ]);
        return response()->json(['message' => 'Akun berhasil di nonaktif']);
    }

    public function aktifkanAkunRepository()
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();
        $user->update([
            'status' => true
        ]);
        return response()->json(['message' => 'Akun berhasil di aktifkan']);
    }


    public function deleteAkunPermanenRepository()
    {
        $user_id = Auth()->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();
        $user->delete();
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        $customer->delete();
        return response()->json(['message' => 'Akun berhasil di hapus permanen']);
    }
}
