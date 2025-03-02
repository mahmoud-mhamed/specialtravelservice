<?php

namespace App\Actions\Client;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Client;

class ClientDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CLIENT_DELETE;

    public function handle(Client $client)
    {
        $this->tryDelete($client);
        return back();
    }
}
