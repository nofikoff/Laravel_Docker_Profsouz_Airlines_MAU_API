<?php
/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 13.06.18
 * Time: 16:05
 */

namespace Modules\Documents\Services;

use Illuminate\Http\Request;
use Modules\Documents\Entities\Document;

class DocumentService
{

    /**
     * @param Request $request
     * @return Document
     */
    public static function storeFromRequest(Request $request): Document
    {
        if ($request->hasFile('file')) {
            $file          = $request->file('file');
            $filesize      = $file->getSize() / 1000000;
            $original_name = $file->getClientOriginalName();
            $extension     = $file->getClientOriginalExtension();
            $storage_name  = \Auth::id().'_'.str_random(8).'.'.$extension;
            $file->storeAs('public/'.Document::STORAGE_PATH, $storage_name);
        }

        $document = Document::create([
            'branch_id'   => $request->get('branch_id'),
            'user_id'     => \Auth::id(),
            'file'        => $original_name,
            'url'         => $storage_name,
            'size'        => $filesize,
            'description' => $request->get('description'),
            'status'      => $request->get('status'),
            'importance'  => self::isBollOrString($request, 'importance'),
            'is_notify'   => self::isBollOrString($request, 'notify'),
        ]);

        if ($request->get('tags', false)) {
            $document->tags()->attach($request->get('tags'));
        }

        return $document;//TODO TheArdent add auth logic
    }

    /**
     * @param Request $request
     * @param $key
     * @return bool
     */
    private static function isBollOrString(Request $request, $key)
    {
        return is_string($request->get($key)) ? in_array($request->get($key), ["true", "0"]) : $request->has($key);
    }

    /**
     * @param Document $document
     * @param Request $request
     * @return Document
     */
    public static function updateFromRequest(Document $document, Request $request): Document
    {
        $document->branch_id   = $request->get('branch_id');
        $document->description = $request->get('description');
        $document->importance  = (bool)$request->has('importance');
        $document->is_notify   = (bool)$request->has('notify');
        $document->status      = $request->get('status');

        if ($request->get('tags', false)) {
            $document->tags()->sync($request->get('tags'));
        }

        if ($request->has('file')) {
            $file          = $request->file('file');
            $filesize      = $file->getSize() / 1000000;
            $original_name = $file->getClientOriginalName();
            $extension     = $file->extension();
            $storage_name  = \Auth::id().'_'.str_random(8).'.'.$extension;

            $file->storeAs(Document::STORAGE_PATH, $storage_name);

            $document->size = $filesize;
            $document->file = $original_name;
            $document->url  = $storage_name;
        }

        $document->save();

        return $document;
    }
}