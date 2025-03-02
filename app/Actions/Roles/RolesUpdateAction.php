<?php

namespace App\Actions\Roles;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Exceptions\NotAuthorizedException;
use App\Http\Requests\RolesRequest;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\Role;


class RolesUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_EDIT;

    public function handle(Role $role, RolesRequest $request)
    {
        $validated_data=$request->validated();
        DB::beginTransaction();
        $role->update(['title' => data_get($validated_data,'title')]);
        Bouncer::sync($role)->abilities(data_get($validated_data,'abilities'));
        DB::commit();
        Bouncer::refresh();

        $this->makeSuccessSessionMessage();
        return back();
    }

    /**
     * @throws NotAuthorizedException
     */
    public function viewForm(Role $role): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkAbility($this->ability);
        $current_abilities = $role->getAbilities()->pluck('name');
        RolesIndexAction::make()->useBreadcrumb([
            ['label' => __('message.edit'), 'url' => route('dashboard.roles.edit', ['role' => $role->id]), 'ability' => $this->ability]
        ]);
        $data=RolesStoreAction::make()->getCreateUpdateData();
        $data['role']=$role;
        $data['current_abilities']=$current_abilities;
        $this->useTransparent();
        return inertia('Roles/Edit',compact('data'));
    }

}
