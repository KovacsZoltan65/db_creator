<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::query()
            ->where(request('query'), function($query, $searchQuery){
                $query->where('first_name', 'like', "%{$searchQuery}%")
                    ->whereOr('last_name', 'like', "%{$searchQuery}%");
            })
            ->latest()
            ->paginate(config('app.pagination_limit'));
            dd($clients);
        return $clients;
    }
}
