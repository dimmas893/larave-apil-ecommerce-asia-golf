<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
/** use your repository */
use App\Http\Requests\LimitRequest;
use App\Repositories\AuthorisedDealerRepository;
use App\Repositories\ExclusiveDistributorRepository;
/** use your resource */
use App\Http\Resources\v2\BrandReResource;
/** use your request */
use App\Http\Requests\BrandIndexRequest;
use Illuminate\Http\Request;


class AuthorisedDealerController extends Controller
{
    function index(BrandIndexRequest $brandIndexRequest, AuthorisedDealerRepository $authorisedDealerRepository)
    {
        try {
            $filter = $brandIndexRequest->validated();
            $perPage = $filter['perPage'];
            return BrandReResource::collection($authorisedDealerRepository->findIndexAuthorisedDealer($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function limit(LimitRequest $limitRequest, AuthorisedDealerRepository $authorisedDealerRepository)
    {
        try {
            $data = $limitRequest->validated();
            $limit = $data['limit'];
            return BrandReResource::collection($authorisedDealerRepository->limit($limit));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}