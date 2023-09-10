<?php

namespace App\Repositories\Api\v2;

use App\Models\DiscussionAnswer;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class DiscussionAnswerRepository.
 */
class DiscussionAnswerRepository
{
    public function create($data)
    {
        $discussion = new DiscussionAnswer();
        $fieldDiscussion = [
            "discussion_id" => $data["discussionId"],
            "content" => $data["content"],
            "user_id" => Auth()->user(),
        ];
        $discussion->create($fieldDiscussion);
    }

    function update($discussionAnswer, $data)
    {
        $discussionAnswer->content = !empty($data['content']) ? $data['content'] : $discussionAnswer->content;
        $discussionAnswer->save();
    }

    function delete($discussionAnswer)
    {
        $discussionAnswer->delete();
    }
}