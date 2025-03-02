<?php

namespace App\Traits;

use App\Classes\Abilities;
use App\Services\BouncerService;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\ActionRequest;
use Symfony\Component\Finder\Exception\AccessDeniedException;

trait ElAuthorizeAbleTrait
{
    protected Abilities $ability;

    /**
     * @return bool
     */
    public function authorize(ActionRequest|null $request): bool
    {
        if (isset($this->ability))
            return BouncerService::checkAbility($this->ability);

        return true;
    }
    private function throwAccessDenied(): void
    {
        if (request()->expectsJson())
            throw (new AccessDeniedException(__('message.cant_have_permission'), 403));
    }

    /**
     * @return void
     */
    public function checkAbility(Abilities|string $ability): void
    {
        if (!BouncerService::checkAbility($ability)) {
            $this->throwAccessDenied();
            throw ValidationException::withMessages(['message' => __('message.cant_have_permission')]);
        }
    }

    /**
     * @return void
     */
    public function getAuthorizationFailure(): void
    {
        $this->throwAccessDenied();
        throw ValidationException::withMessages(['message' => __('message.cant_have_permission')]);

    }
}
