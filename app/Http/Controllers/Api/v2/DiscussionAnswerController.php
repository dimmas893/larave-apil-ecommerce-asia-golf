<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\DiscussionAnswer;
use App\Repositories\Api\v2\DiscussionAnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscussionAnswerController extends Controller
{
    function create(Request $request, DiscussionAnswerRepository $discussionAnswerRepository)
    {
        try {
            $request->validate([
                'discussionId' => [
                    'required',
                    Rule::exists(Discussion::class, 'id')
                ],
                'content' => [
                    'required'
                ]
            ]);
            $discussionAnswerRepository->create($request);
            return [
                'status' => "success",
                'message' => _('discussion answer created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(DiscussionAnswer $discussionAnswer, Request $request, DiscussionAnswerRepository $discussionAnswerRepository)
    {
        try {
            $request->validate([
                'content' => [
                    'required'
                ]
            ]);
            $discussionAnswerRepository->update($discussionAnswer, $request);
            return [
                'status' => "success",
                'message' => _('discussion answer updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(DiscussionAnswer $discussionAnswer, DiscussionAnswerRepository $discussionAnswerRepository)
    {
        try {
            $discussionAnswerRepository->delete($discussionAnswer);
            return [
                'status' => "success",
                'message' => _('discussion answer deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}