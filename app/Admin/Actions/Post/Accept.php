<?php

namespace App\Admin\Actions\Post;

use App\Models\Post;
use Encore\Admin\Actions\RowAction;

class Accept extends RowAction
{
    /**
     * Action name
     *
     * @var string
     */
    public $name = 'Accept';

    /**
     * Action of accept
     *
     * @param Post $post
     * @return Accept
     */
    public function handle(Post $post)
    {
        $post->status = 'Accept';
        $post->save();

        return $this->response()->success('Post Accepted Successfully')->refresh();
    }
}
