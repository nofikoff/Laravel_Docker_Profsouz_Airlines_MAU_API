<?php
/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 13.06.18
 * Time: 16:34
 */

namespace Modules\Posts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostQuestion;

class PostService
{

    /**
     * @param Request $request
     * @return Post
     * @throws \Mpdf\MpdfException
     * @throws \Throwable
     */
    public static function storeFromRequest(Request $request): Post
    {
        $user = \Auth::user();
        /** @var Post $post */
        $post = $user->posts()->create($request->all());

        if ($request->get('type') == Post::TYPE_QUESTION) {
            /** @var PostQuestion $question */
            $question = $post->question()->create($request->all());

            $options = is_array($request->get('options')) ? $request->get('options') : explode(',', $request->get('options'));

            if(is_array($options)) {
                foreach ($options as $option) {
                    if (trim($option)) {
                        $question->options()->create(['name' => $option]);
                    }
                }
            }

            $post->question->setDefaultOptionByOptionName($request->get('default_option'));
        }

        if ($request->get('type') == Post::TYPE_FINN_HELP) {
            $post->financial_info()->create($request->all());
        }

        if ($request->get('tags', false)) {
            $post->tags()->sync($request->get('tags'));
        }

        self::storeFiles($request, $post);

        return $post;
    }

    /**
     * @param Request $request
     * @param Post $post
     */
    public static function storeFiles(Request $request, Post $post)
    {
        if ($request->hasFile('attachments')) {
            $files = $request->file('attachments');
            $files = is_array($files) ? $files : [$files];

            $path = 'public/posts/'.$post->id.'/attachments';
            /** @var UploadedFile $file */
            foreach ($files as $file) {
                $fileName  = $file->getClientOriginalName();
                $extension = $file->extension();
                $storeName = md5($fileName.time()).'.'.$extension;

                $file_path = $file->storeAs($path, $storeName);

                $post->attachments()->create([
                    'name' => $fileName,
                    'file' => $file_path
                ]);
            }
        }
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return Post
     */
    public static function updateFromRequest(Post $post, Request $request): Post
    {
        if(!is_numeric($request->get('info_status_id'))){
            $request->request->remove('info_status_id');
        }
        $post->update($request->all());

        if ($post->type == Post::TYPE_QUESTION) {
            $post->question()->update($request->only(['expiration_at', 'closed']));
            if(is_array($request->get('options'))) {
                $post->question->options()->whereNotIn('name', $request->get('options'))->delete();
            }

            $options = is_array($request->get('options')) ? $request->get('options') : explode(',', $request->get('options'));

            if(is_array($options)) {
                foreach ($options as $option) {
                    if (trim($option) && ! $post->question->options()->where('name', $option)->first()) {
                        $post->question->options()->create(['name' => $option]);
                    }
                }
            }
            $post->question->setDefaultOptionByOptionName($request->get('default_option'));
        }

        if ($post->type == Post::TYPE_FINN_HELP) {
            $post->financial_info()->updateOrCreate($request->only([
                'pdf_rr',
                'pdf_mfo',
                'pdf_card',
                'pdf_bank',
                'pdf_edrpoy',
                'pdf_extradited',
                'pdf_passport_code',
                'pdf_passport_seria',
                'pdf_identification',
            ]));
        }

        if ($request->get('tags', false)) {
            $post->tags()->sync($request->get('tags'));
        }

        self::storeFiles($request, $post);

        return $post;
    }
}