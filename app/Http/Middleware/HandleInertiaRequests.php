<?php

namespace App\Http\Middleware;

use App\Classes\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'toastr' => $request->session()->get('toastr'),
            'lang' => [
                'current' => app()->getLocale(),
            ],
            'menu' => Auth::guard('web')->check() ? (new Menu())->getMenu() : null,
            'asset_url' => asset(''),
            'auth' => Auth::check() ? [
                'user' => Auth::user(),
                'abilities' => $request->user()?->getAbilities()?->pluck('name')->toArray(),
            ] : null,
        ]);
    }
}
