<?php

namespace Lio\Replies;

use Lio\Users\User;

final class EloquentReplyRepository implements ReplyRepository
{
    /**
     * @var \Lio\Replies\EloquentReply
     */
    private $model;

    public function __construct(EloquentReply $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Lio\Replies\Reply|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(ReplyAble $relation, User $author, string $body): Reply
    {
        $reply = $this->model->newInstance(compact('body'));
        $reply->author_id = $author->id();

        $relation->replyAble()->save($reply);

        return $reply;
    }

    public function update(Reply $reply, array $attributes = []): Reply
    {
        $reply->update($attributes);

        return $reply;
    }

    public function delete(Reply $reply)
    {
        $reply->delete();
    }
}
