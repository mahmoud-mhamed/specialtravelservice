<?php

namespace App\Actions\Client;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CLIENT_EDIT;

    public function handle(Client $client,ClientRequest $request)
    {
        $client->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}
