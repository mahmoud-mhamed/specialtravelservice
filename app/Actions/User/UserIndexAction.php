<?php

namespace App\Actions\User;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\IsActiveEnum;
use App\Enums\ModuleNameEnum;
use App\Models\User;
use Inertia\Inertia;

class UserIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_USERS_INDEX;

    public function handle(): \Inertia\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->allowSearch();
        $this->useBreadcrumb();
        $query = User::query()
            ->filter()
            ->latest('id')
            ->search(['name', 'email']);
        if ($this->requestIsExport(Abilities::M_USERS_INDEX_EXPORT)) {
            return $this->exportExcel($query->get(), ['id', 'name', 'email', 'is_active_text', 'created_at_text'], 'users');
        }
        $data['users'] = $query->paginate();
        $this->useFilter(User::query()->getFilters());
        return Inertia::render('Users/Index', ['data' => $data, ...$this->getCreateUpdateData()]);
    }

    public function getCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'is_active' => IsActiveEnum::getOptionsData(),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS), 'url' => route('dashboard.users.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}
