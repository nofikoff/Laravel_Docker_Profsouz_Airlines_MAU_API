<?php

namespace Modules\Posts\Services;


use Illuminate\Http\Request;
use Modules\Posts\Entities\Comment;

class CommentService
{

    /**
     * @param Comment $comment
     * @param Request $request
     * @return bool
     */
    public static function update(Comment $comment, Request $request)
    {
        $data = $request->only(['text']) + ['image' => self::storeFile($request, $comment)];
        return $comment->update($data);
    }

    /**
     * @param Request $request
     * @param bool|Comment $comment
     * @return null|string
     */
    public static function storeFile(Request $request, $comment = false)
    {
        if ($file = $request->file('image', false)) {
            $extension    = $file->getClientOriginalExtension();
            $storage_name = 'comments/'.\Auth::id().'_'.str_random(8).'.'.$extension;

            $file->storeAs('public/', $storage_name);

            if($comment) {
                \Storage::delete($comment->image);
            }

            return $storage_name;
        }

        return null;
    }


}