<?php

namespace App\Actions\Client;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Supplier;
use Inertia\Inertia;

class ClientIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_CLIENT_INDEX;

    public function handle(): \Inertia\Response
    {
        $this->useBreadcrumb();
        $query = Client::query()
            ->search(['name', 'phone', 'national_id', 'note']);
        $this->allowSearch();
        $data = $this->getFormCreateUpdateData();
        $data['rows'] = $query->paginate();
        $this->useFilter(Client::query()->getFilters());

        return Inertia::render('Client/Index', compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CLIENT), 'url' => route('dashboard.client.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}
