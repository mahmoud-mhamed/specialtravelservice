<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_STORE;

    /**
     * @throws \Throwable
     */
    public function handle(UserRequest $request)
    {
        $validated_data = $request->validated();
        User::query()->create($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}
