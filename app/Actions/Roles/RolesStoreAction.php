<?php

namespace App\Actions\Roles;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Exceptions\NotAuthorizedException;
use App\Http\Requests\RolesRequest;
use App\Services\BouncerService;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\BouncerFacade as Bouncer;


class RolesStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_STORE;

    public function handle(RolesRequest $request)
    {
        $validated_data=$request->validated();
        DB::beginTransaction();
        $role = Bouncer::role()->firstOrCreate([
            'name' => 'role_' . time(),
            'title' => data_get($validated_data,'title'),
        ]);
        Bouncer::sync($role)->abilities(data_get($validated_data,'abilities'));
        DB::commit();
        BouncerService::refresh();

        $this->makeSuccessSessionMessage();
        return back();
    }

    /**
     * @throws NotAuthorizedException
     */
    public function viewForm(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkAbility($this->ability);
        $this->useTransparent();

        $data = $this->getCreateUpdateData();

        RolesIndexAction::make()->useBreadcrumb([
            ['label' => __('message.add'), 'url' => route('dashboard.roles.create'), 'ability' => $this->ability]
        ]);
        return inertia('Roles/Create', [
            'data' => $data,
        ]);
    }

    public function getCreateUpdateData(): array
    {
        return [
            'abilities' => Abilities::getAbilitiesGroupByModule()
        ];
    }

}
