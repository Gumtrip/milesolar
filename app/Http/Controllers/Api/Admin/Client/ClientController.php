<?php

namespace App\Http\Controllers\Api\Admin\Client;

use Illuminate\Http\Request;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client\Client;
use App\Http\Requests\Admin\Client\ClientRequest;
use App\Http\Queries\Client\ClientQuery;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(Request $request, ClientQuery $clientQuery)
    {

        $clients = $clientQuery->paginate(config('app.page_size'));
        return ClientResource::collection($clients);
    }

    public function store(ClientRequest $request, Client $client)
    {
        $client->fill($request->all());
        $client->save();
        return new ClientResource($client);

    }

    public function show($id, ClientQuery $clientQuery)
    {
        $client = $clientQuery->findOrFail($id);
        return new ClientResource($client);
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return new ClientResource($client);
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();
        return response(null, 204);
    }
}
