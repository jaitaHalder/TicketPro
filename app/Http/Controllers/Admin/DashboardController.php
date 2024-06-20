<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $dashboard = [
            'buses' => Bus::query()->count(),
            'routes' => Route::query()->count(),
            'users' => User::query()->count(),
            'tickets' => Ticket::query()->count(),
        ];

        return view("admin.index", compact('dashboard'));
    }
}
