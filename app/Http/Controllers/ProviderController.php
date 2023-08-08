<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function all()
    {
        $providers = Provider::query()
            ->with(['banks' => function ($q) {
                $q->where('is_active', true)
                    ->select('id', 'name', 'is_disabled', "is_active")
                    ->orderBy('name');
            }])
            ->where('is_active', true)
            ->select('id', 'name', 'is_disabled', "is_active")
            ->orderBy('name')
            ->get();

        return $providers;
    }
}
