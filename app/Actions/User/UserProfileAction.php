<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\User;
use Inertia\Inertia;

class UserProfileAction extends BaseAction
{
    public function viewMainData(User $user): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_USERS_MAIN_DATA);
        $this->setProfileTab('MainDataTab', $user);

        $data['row'] = $user;
        return Inertia::render('Users/Profile/Index', compact('data'));
    }

    public function viewEdit(User $user): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_USERS_UPDATE);
        $this->setProfileTab('EditTab', $user, __('message.edit'));
        $data = UserIndexAction::make()->getCreateUpdateData();
        $data['row'] = $user;
        return Inertia::render('Users/Profile/Index', compact('data'));
    }


    public function setProfileTab($tap_component, User &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('dashboard.users.profile.main_data', $row), 'ability' => Abilities::M_USERS_MAIN_DATA];

        if ($title) {
            UserIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            UserIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $this->useTransparent();

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
