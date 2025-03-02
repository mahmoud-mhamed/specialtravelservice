<?php

namespace App\Actions\Client;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CLIENT_STORE;

    public function handle(ClientRequest $request)
    {
        Client::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}
