<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCrudRequest;
use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfil(Request $request, ProfileRepository $profileRepository)
    {

        try {
            return $profileRepository->update($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updatePassword(Request $request, ProfileRepository $profileRepository)
    {
        try {
            return $profileRepository->updatePassword($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function nonAktifAkun(ProfileRepository $profileRepository)
    {
        try {
            return $profileRepository->nonAktifAkunRepository();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function aktifkanAkun(ProfileRepository $profileRepository)
    {
        try {
            return $profileRepository->aktifkanAkunRepository();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteAkunPermanen(ProfileRepository $profileRepository)
    {
        try {
            return $profileRepository->deleteAkunPermanenRepository();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
