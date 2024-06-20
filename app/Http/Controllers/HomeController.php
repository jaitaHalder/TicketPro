<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\BusStop;
use App\Models\ContactForm;
use App\Models\SubRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $date = $request->input('date') ?? date('Y-m-d');

        $day = date('l', strtotime($date));


        $origins = SubRoute::with(['originBusStop:id,name'])
            ->groupBy('origin')
            ->get()
            ->sortBy(function ($subRoute) {
                return $subRoute->originBusStop->name;
            });

        $destinations = SubRoute::with(['destinationBusStop:id,name'])
            ->where('origin', '=', $origin)
            ->groupBy('destination')
            ->get()
            ->sortBy(function ($subRoute) {
                return $subRoute->destinationBusStop->name;
            });

        $routes = SubRoute::with(['trip' => function ($query) use ($day) {
            $query->whereRaw("FIND_IN_SET(?, days)", [$day]);
        }, 'originBusStop', 'destinationBusStop'])
            ->where('origin', '=', $origin)
            ->where('destination', '=', $destination)
            ->get();

        $search['origin'] = BusStop::query()->find($origin);
        $search['destination'] = BusStop::query()->find($destination);
        $search['date'] = $date ? date('l d F Y', strtotime($date)) : null;

        return view('index', compact('origins', 'destinations', 'routes', 'search', 'date'));
    }

    /**
     * @return View
     */
    public function privacyPolicy(): View
    {
        $privacy_policy = Helper::setting('PRIVACY_POLICY');

        return view('privacy_policy', compact('privacy_policy'));
    }

    /**
     * @return View
     */
    public function aboutUs(): View
    {
        $about_us = Helper::setting('SETTING_ABOUT_US');

        return view('about_us', compact('about_us'));
    }

    /**
     * @return View
     */
    public function contactUs(): View
    {
        $settings = Helper::settings();

        return view('contact_us', compact('settings'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function contactFormSubmit(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        ContactForm::query()->create($data);

        return redirect()
            ->back()
            ->with('success', 'Your form submitted successfully.');
    }
}
