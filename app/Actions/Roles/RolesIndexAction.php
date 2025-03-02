<?php

namespace App\Actions\Roles;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Traits\PaginatableTrait;
use Silber\Bouncer\Database\Role;

class RolesIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_ROLES_INDEX;
    use PaginatableTrait;
    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
       $data = Role::query()
            ->withCount('users', 'abilities')
            ->when($i = request('search'), function ($q) use ($i){
                $q->where('title', 'like', '%'.$i.'%');
            })
            ->orderBy('id', 'desc');
        $this->allowSearch();
        $this->useBreadcrumb();
        if ($this->requestIsExport(Abilities::M_ROLES_INDEX_EXPORT)) {
            return $this->exportExcel($data->get(), ['id', 'title', 'created_at_text', 'updated_at_text'], 'roles');
        }
        $this->useTransparent();
        return inertia('Roles/Index', [
            'data' => $data->paginate($this->getPerPage()),
        ]);
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::ROLES), 'url' => route('dashboard.roles.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}
