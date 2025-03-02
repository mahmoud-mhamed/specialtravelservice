<?php

namespace App\Actions\Roles;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Services\BouncerService;
use Silber\Bouncer\Database\Role;


class RoleDeleteAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_DELETE;

    public function handle(Role $role)
    {
        if (count($role->users) > 0) {
            $this->makeErrorSessionMessage(__('message.cant_delete'));
        } else {
            $this->makeSuccessSessionMessage();
            $role->delete();
            BouncerService::refresh();
        }
        return back();
    }

}
