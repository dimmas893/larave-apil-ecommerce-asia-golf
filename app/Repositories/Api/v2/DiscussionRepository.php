<?php

namespace App\Repositories\Api\v2;

use App\Models\Discussion;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class DiscussionRepository.
 */
class DiscussionRepository
{
    public function create($data)
    {
        $discussion = new Discussion();
        $fieldDiscussion = [
            "item_id" => $data["itemId"],
            "content" => $data["content"],
            "customer_id" => Auth()->user(),
        ];
        $discussion->create($fieldDiscussion);
    }

    function update($discussion, $data)
    {
        $discussion->content = !empty($data['content']) ? $data['content'] : $discussion->content;
        $discussion->save();
    }

    function delete($discussion)
    {
        $discussion->discussionAnswer()->delete();
        $discussion->delete();
    }
}