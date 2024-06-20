<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusStop;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class BusStopController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $busStops = BusStop::all();

        return view("admin.bus_stops.index", compact("busStops"));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("admin.bus_stops.create");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "name" => "required|string|unique:bus_stops,name",
        ]);

        try {
            $busStop = new BusStop();
            $busStop->fill([
                "name" => $request->input("name"),
            ]);
            $busStop->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Bus stop has been inserted successfully.");
    }

    /**
     * @param BusStop $busStop
     * @return View
     */
    public function show(BusStop $busStop): View
    {
        return view("admin.bus_stops.show", compact("busStop"));
    }

    /**
     * @param BusStop $busStop
     * @return View
     */
    public function edit(BusStop $busStop): View
    {
        return view("admin.bus_stops.edit", compact("busStop"));
    }

    /**
     * @param Request $request
     * @param BusStop $busStop
     * @return RedirectResponse
     */
    public function update(Request $request, BusStop $busStop): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "name" => [
                "required",
                "string",
                Rule::unique('bus_stops', 'name')->ignore($busStop->__get('id')),
            ],
        ]);

        try {
            $busStop->fill([
                "name" => $request->input("name"),
            ]);
            $busStop->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Bus stop has been updated successfully.");
    }

    /**
     * @param BusStop $busStop
     * @return RedirectResponse
     */
    public function destroy(BusStop $busStop): RedirectResponse
    {
        if ($busStop->origins()->count() > 0 || $busStop->destinations()->count()) {
            return redirect()->back()->with("warning", "'{$busStop->__get('name')}' is already in use and cannot be deleted.");
        }

        try {
            $busStop->deleteOrFail();
        } catch (Throwable $exception) {
            return redirect()->back()->with("error", $exception->getMessage());
        }

        return redirect()->back()->with("success", "Bus stop been deleted successfully.");
    }
}
