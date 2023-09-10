<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\Item;
use App\Repositories\Api\v2\DiscussionRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscussionController extends Controller
{

    function create(Request $request, DiscussionRepository $discussionRepository)
    {
        try {
            $request->validate([
                'itemId' => [
                    'required',
                    Rule::exists(Item::class, 'id')
                ],
                'content' => [
                    'required'
                ]
            ]);
            $discussionRepository->create($request);
            return [
                'status' => "success",
                'message' => _('discussion created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(Discussion $discussion, Request $request, DiscussionRepository $discussionRepository)
    {
        try {
            $request->validate([
                'content' => [
                    'nullable'
                ]
            ]);
            $discussionRepository->update($discussion, $request);
            return [
                'status' => "success",
                'message' => _('discussion updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Discussion $discussion, DiscussionRepository $discussionRepository)
    {
        try {
            $discussionRepository->delete($discussion);
            return [
                'status' => "success",
                'message' => _('discussion deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}