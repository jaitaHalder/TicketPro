<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusStop;
use App\Models\Route;
use App\Models\SubRoute;
use App\Models\Trip;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class TripController extends Controller
{
    const int SUB_ROUTE_LIMIT = 10;
    /**
     * @return View
     */
    public function index(): View
    {
        $trips = Trip::with(["bus", "route"])->get();

        return view("admin.trips.index", compact("trips"));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $buses = Bus::all()->where("status", 1);
        $busStops = BusStop::query()->orderBy('name')->get();
        $routes = Route::all()->where("status", 1);
        $limit = self::SUB_ROUTE_LIMIT;

        return view("admin.trips.create", compact("buses", "busStops", "routes", "limit"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "bus_id" => "required|exists:buses,id",
            "route_id" => "required|exists:routes,id",
            "days" => "required|array|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Save the Trip
            $trip = new Trip();
            $trip->fill([
                "bus_id" => $request->input("bus_id"),
                "route_id" => $request->input("route_id"),
                "days" => implode(",", $request->input("days")),
                "status" => $request->input("status"),
            ]);
            $trip->save();
            $trip_id = $trip->__get("id");

            foreach ($request->input('sub_routes') as $data) {
                if (empty($data["origin"]) || empty($data["destination"])) {
                    continue;
                }

                $subRoute = new SubRoute();
                $subRoute->fill($data);
                $subRoute->setAttribute("trip_id", $trip_id);
                $subRoute->save();
            }

            // Commit the transaction
            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();

            return redirect()->back()->with("error", "QueryException code: " . $exception->getMessage());
        }

        return redirect()->back()->with("success", "Trip has been inserted successfully.");
    }

    /**
     * @param Trip $trip
     * @return View
     */
    public function show(Trip $trip): View
    {
        $buses = Bus::all()->where("status", 1);
        $busStops = BusStop::query()->orderBy('name')->get();
        $routes = Route::all()->where("status", 1);
        $subRoutes = SubRoute::all()->where("trip_id", $trip->__get("id"));
        $limit = self::SUB_ROUTE_LIMIT;

        return view("admin.trips.show", compact("trip", "buses", "busStops", "routes", "subRoutes", "limit"));
    }

    /**
     * @param Trip $trip
     * @return View
     */
    public function edit(Trip $trip): View
    {
        $buses = Bus::all()->where("status", 1);
        $busStops = BusStop::query()->orderBy('name')->get();
        $routes = Route::all()->where("status", 1);
        $subRoutes = SubRoute::all()->where("trip_id", $trip->__get("id"));
        $limit = self::SUB_ROUTE_LIMIT;

        return view("admin.trips.edit", compact("trip", "buses", "busStops", "routes", "subRoutes", "limit"));
    }

    /**
     * @param Request $request
     * @param Trip $trip
     * @return RedirectResponse
     */
    public function update(Request $request, Trip $trip): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "bus_id" => "required|exists:buses,id",
            "route_id" => "required|exists:routes,id",
            "days" => "required|array|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            $trip->fill([
                "bus_id" => $request->input("bus_id"),
                "route_id" => $request->input("route_id"),
                "days" => implode(",", $request->input("days")),
                "status" => $request->input("status"),
            ]);
            $trip->save();

            // Insert New Sub Routes
            foreach ($request->input('sub_routes') as $data) {
                if (empty($data["origin"]) || empty($data["destination"])) {
                    continue;
                }

                $subRoute = new SubRoute();
                $subRoute->fill($data);
                $subRoute->setAttribute("trip_id", $trip->__get("id"));
                $subRoute->save();
            }

            if ($request->input('exist_sub_routes')) {
                foreach ($request->input('exist_sub_routes') as $data) {
                    $subRoute = SubRoute::query()->find($data["id"]);

                    if (empty($data["origin"]) || empty($data["destination"])) {
                        $subRoute?->delete();
                    } else {
                        // Update Sub Routes
                        $subRoute?->update($data);
                    }
                }
            }

            // Commit the transaction
            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Trip has been updated successfully.");
    }

    /**
     * @param Trip $trip
     * @return RedirectResponse
     */
    public function destroy(Trip $trip): RedirectResponse
    {
        if ($trip->tickets()->count() > 0) {
            return redirect()->back()->with("warning", "The trip is already in use and cannot be deleted.");
        }

        try {
            $trip->deleteOrFail();
        } catch (Throwable $exception) {
            return redirect()->back()->with("error", $exception->getMessage());
        }

        return redirect()->back()->with("success", "Trip has been deleted successfully.");
    }
}
