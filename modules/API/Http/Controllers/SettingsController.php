<?php

namespace Modules\API\Http\Controllers;

use Modules\API\Http\Resources\BranchResource;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\SettingNotificationRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;

class SettingsController extends APIController
{

    /**
     * @param $locale
     * @return \Illuminate\Http\JsonResponse
     */
    public function setLocale($locale)
    {
        $result = false;

        if (in_array($locale, explode(',', env('SETTINGS_LOCALES')))) {
            if ($user = \Auth::user()) {
                $result = $user->update(['locale' => $locale]);
            }
        } else {
            abort(404, 'Locale not found.');
        }

        return response()->json(['success' => $result]);
    }

    /**
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAccount(UpdateUserRequest $request)
    {
        $user = \Auth::user();

        $dublicate_rows = User::where('phone', '=', '?')
            ->where('id', '!=', '?')
            ->setBindings([User::cropPhone($request->get('phone')), $user->id])
            ->count();

        if ($dublicate_rows) {
            return response()->json([
                'success' => false,
                'message' => trans('users::user.error_phone', [], $user->locale)
            ]);
        }

        $user->update($request->only([
            'last_name',
            'first_name',
            'position',
            'birthday',
            'phone',
        ]));

        if ($request->file('image')) {
            $file = $request->file('image');

            $filename = $request->file('image')->storeAs('public/avatars',
                uniqid().'.'.$file->getClientOriginalExtension());

            $user->img = $filename;
        }

        if ($request->get('webcam')) {
            $file = str_replace('data:image/jpeg;base64,', '', $request->get('webcam'));

            $filename = 'public/avatars/'.uniqid().'.jpeg';
            \Storage::put($filename, base64_decode($file));

            $user->img = $filename;
        }

        if ($request->get('password', false)) {
            if (strcmp($request->get('password'), $request->get('password_confirm')) !== 0) {
                return response()->json([
                    'success' => false,
                    'message' => trans('users::user.error_password', [], $user->locale)
                ]);
            }

            $user->password = $request->get('password');
        }

        $result = $user->save();

        return response()->json([
            'success' => $result,
            'message' => trans('users::user.success_update', [], $user->locale)
        ]);
    }

}
