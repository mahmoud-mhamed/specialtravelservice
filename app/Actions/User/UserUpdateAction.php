<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\BouncerService;
use Illuminate\Support\Facades\DB;

class UserUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_USERS_UPDATE;

    public function handle(User $user,UserRequest $request)
    {
        $validated_data=$request->validated();
        if (!data_get($validated_data,'password'))
            unset($validated_data['password']);
        DB::beginTransaction();
        $user->update($validated_data);
        $user->roles()->detach();
        data_get($request,'role') && $user->assign($validated_data['role']);
        DB::commit();
        sleep(3);
        BouncerService::refresh();
        $this->makeSuccessSessionMessage();
        return back();
    }
}
