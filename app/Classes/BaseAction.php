<?php

namespace App\Classes;

use App\Exports\ExcelExport;
use App\Services\BouncerService;
use App\Traits\ElAuthorizeAbleTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Facades\Excel;

class BaseAction
{
    use AsAction;
    use ElAuthorizeAbleTrait;

    public function tryDelete($row): bool
    {
        DB::beginTransaction();
        try {
            $row->delete();
            $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            $this->makeErrorSessionMessage(__('message.cant_delete'));
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function tryForceDelete($row): bool
    {
        DB::beginTransaction();
        try {
            $row->forceDelete();
            $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            $this->makeErrorSessionMessage(__('message.cant_delete'));
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function requestExpectJson(): bool
    {
        return request()->expectsJson();
    }

    public function tryDeleteForceDelete($model, $id, $make_message_session = false): bool
    {
        $row = $model::withTrashed()->findOrFail($id);
        try {
            $row->forceDelete();
            if ($make_message_session)
                $this->makeSuccessSessionMessage();
        } catch (\Throwable  $e) {
            if ($make_message_session)
                $this->makeErrorSessionMessage(__('message.cant_delete'));
            return false;
        }
        return true;
    }

    public function tryRestore($model, $id, $make_message_session = false): void
    {
        $row = $model::withTrashed()->findOrFail($id);
        $row->restore();
        $row->update(['deleted_by_id' => null]);
        if ($make_message_session)
            $this->makeSuccessSessionMessage();
    }

    public function makeSuccessSessionMessage($message = null): void
    {
        $this->createToastr('success', '', $message ?? __('message.success_response_message'));
    }

    private function createToastr($type, $title, $message): void
    {
        if ($this->requestExpectJson())
            return;
        Session::flash('toastr', [['type' => $type, 'title' => $title, 'message' => $message]]);
    }

    public function makeErrorSessionMessage($message = null): void
    {
        $this->createToastr('error', '', $message ?? __('message.error_response_message'));
    }

    public function makeErrorCantDeleteMessage($message = null): void
    {
        $this->makeErrorSessionMessage($message ?? __('message.cant_delete'));
    }

    public function breadcrumb(array $items = null)
    {
        if (!$items)
            return null;
        Inertia::share([
            'breadcrumb' => $items,
        ]);
        $this->pageTitle(
            implode(
                " - ",
                array_column(array_slice($items, -2, 2, true), 'label')
            )
        );
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        /*$this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::REPORT), 'url' => '/module/report', 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);*/
    }

    public function allowSearch(): void
    {
        Inertia::share([
            'allowSearch' => true,
        ]);
    }

    public function pageTitle($title): void
    {
        Inertia::share([
            'pageTitle' => $title,
        ]);
    }

    public function exportExcel($data, $map, $file_name): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ExcelExport($data, $map), $file_name . ' ' . Carbon::now()->toDateString() . '.xlsx');
    }

    public function requestIsExport(Abilities|null $ability = null, $key = 'export_excel'): bool
    {
        if ($ability && !BouncerService::checkAbility($ability)) {
            return false;
        }
        return (boolean)request($key);
    }

    public function useFilter($filters = null): void
    {
        if (!$filters)
            return;
        Inertia::share([
            'filters' => $filters,
        ]);
    }
    public function useTransparent($transparent = true): void
    {
        Inertia::share([
            'isTransparent' => $transparent,
        ]);
    }

    public function makeStatisticCard($title,$value,$icon): array
    {
        return [
            'title' => $title,
            'value' => $value,
            'icon' => $icon,
        ];
    }
}
