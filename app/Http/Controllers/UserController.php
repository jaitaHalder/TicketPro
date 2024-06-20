<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Mail\TicketMail;
use App\Mail\UserEmailVerificationMail;
use App\Models\Bus;
use App\Models\BusStop;
use App\Models\Payment;
use App\Models\SubRoute;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @param string $date
     * @return bool
     */
    private function isPreviousDay(string $date): bool
    {
        $today = date('Y-m-d');
        return strtotime($date) < strtotime($today);
    }

    /**
     * @return string|null
     */
    private function emailVerificationLink(): string|null
    {
        if (empty(Auth::user()->__get('email_verified_at'))) {
            $url = route('user.email_verification');

            return <<< HTML
                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                    <strong>Verification Required!</strong> Please click the link <a href="$url" class="alert-link">Send verification link</a> to verify your email address.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                HTML;
        }

        return null;
    }

    /**
     * @param $token
     * @return RedirectResponse
     */
    public function emailVerification($token = null): RedirectResponse
    {
        // When click a verification link
        if ($token !== null) {
            User::query()
                ->where('remember_token', '=', $token)
                ->firstOrFail();

            User::query()
                ->where('remember_token', '=', $token)
                ->update([
                    'email_verified_at' => now(),
                    'remember_token' => null,
                ]);

            return redirect()
                ->route('user.dashboard')
                ->with('success', 'Your email has been successfully verified.');
        }

        try {
            // Sent new link to email
            $token = Str::random(60);

            $user = User::query();
            $user->where('id', '=', Auth::id())
                ->update(['remember_token' => $token]);
            $user = $user->first();

            Mail::to($user->email)->send(new UserEmailVerificationMail($user, $token));

            return redirect()
                ->back()
                ->with('success', 'Please check your email');
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * @return View
     */
    public function signup(): View
    {
        return view('user.auth.signup');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function signupAction(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required|string|max:35",
            "email" => [
                "required",
                "string",
                "email",
                Rule::unique('users')
            ],
            "password" => "required|string|min:6",
        ]);

        $user = new User();
        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'remember_token' => Str::random(10),
        ]);

        $user->save();

        return redirect()
            ->route('user.login')
            ->with('success', 'Your account has been created successfully!');
    }

    /**
     * @return View
     */
    public function login(): View
    {
        return view('user.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginAction(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => "required|string|email",
            "password" => "required|string",
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (request()->getQueryString()) {
                return redirect(route("user.seat_book") . '?' . request()->getQueryString());
            }

            return redirect()->route("user.dashboard");
        } else {
            return back()
                ->withInput()
                ->with("error", "Email or Password is not valid.");
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route("user.login");
    }


    /**
     * @return View
     */
    public function showLinkRequestForm(): View
    {
        return view("user.auth.password_email");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|exists:users,email"
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("error", "This email address doesn't exist.");
        }

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with('success', __($status))
                : back()->with('error', __($status));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $token
     * @return View
     */
    public function showResetForm(Request $request, $token = null): View
    {
        return view('user.auth.password_reset')->with(
            ['token' => $token, 'email' => $request->__get('email')]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user.login')->with('success', __($status))
            : back()->with('error', __($status));
    }

    /**
     * @return View
     */
    public function dashboard(): View
    {
        $emailVerificationLink = $this->emailVerificationLink();
        return view('user.dashboard', compact('emailVerificationLink'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function sitBook(Request $request): View
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $bus = $request->input('bus');
        $date = $request->input('date') ?? date('Y-m-d');
        $day = date('l', strtotime($date));

        // Find Route
        $route = SubRoute::with(['trip' => function ($query) use ($day, $bus) {
            $query->whereRaw("FIND_IN_SET(?, days)", [$day]);
            $query->where('bus_id', '=', $bus);
        }, 'originBusStop', 'destinationBusStop'])
            ->where('origin', '=', $origin)
            ->where('destination', '=', $destination)
            ->get()
            ->filter(function ($route) {
                return $route->trip !== null;
            })->first();

        // If route not exist then abort
        if ($route == null || $this->isPreviousDay($date)) {
            abort(404);
        }

        // Find Bus
        $bus = Bus::query()->find($bus);

        // Find already booked seats
        $ticketSeats = TicketSeat::query()->whereHas('ticket', function ($query) use ($route, $date) {
            $query->where('trip_id', '=', $route->trip_id);
            $query->where('booking_date', '=', $date);
        })->pluck('seat_number')->toArray();

        $search['origin'] = BusStop::query()->find($origin);
        $search['destination'] = BusStop::query()->find($destination);
        $search['date'] = $date ? Helper::convertBookingDate($date) : null;

        $emailVerificationLink = $this->emailVerificationLink();

        return view('user.sit_book', compact('route', 'search', 'date', 'bus', 'ticketSeats', 'emailVerificationLink'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function sitBookAction(Request $request): RedirectResponse
    {
        $trip_id = $request->input('trip_id');
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $date = $request->input('date');
        $seats = $request->input('seats');
        $payment_method = $request->input('payment_method');
        $transaction_id = $request->input('transaction_id');

        if (empty($seats)) {
            return redirect()
                ->back()
                ->with('error', 'Please select seats.')
                ->withInput();
        }

        if (empty($payment_method)) {
            return redirect()
                ->back()
                ->with('error', 'Please select a payment method.')
                ->withInput();
        }

        if (($payment_method == 'bKash' || $payment_method == 'Nagad') && empty($transaction_id)) {
            return redirect()
                ->back()
                ->with('error', 'Your payment transaction ID is required.')
                ->withInput();
        }

        $subRoute = SubRoute::query()
            ->where('trip_id', '=', $trip_id)
            ->where('origin', '=', $origin)
            ->where('destination', '=', $destination)
            ->firstOrFail();

        $sub_route_id = $subRoute->__get('id');
        $pre_ticket_price = $subRoute->__get('price');

        DB::beginTransaction();

        try {
            $ticket = new Ticket();
            $ticket->fill([
                'user_id' => Auth::id(),
                'trip_id' => $trip_id,
                'sub_route_id' => $sub_route_id,
                'booking_date' => $date,
            ]);
            $ticket->save();

            $ticket_id = $ticket->__get('id');

            foreach ($seats as $seat_number) {
                $ticketSeat = new TicketSeat();
                $ticketSeat->fill([
                    'ticket_id' => $ticket_id,
                    'seat_number' => $seat_number,
                ]);

                $ticketSeat->save();
            }

            $amount = $pre_ticket_price * count($seats);

            $payment = new Payment();
            $payment->fill([
                'ticket_id' => $ticket_id,
                'payment_method' => $payment_method,
                'amount' => $amount,
                'currency' => Helper::CURRENCY,
                'paid_at' => now(),
                'transaction_id' => $transaction_id ?? null,
                'notes' => null,
                'status' => 'Pending',
            ]);
            $payment->save();

            DB::commit();

            // Ticket sent to mail
            $ticket = Ticket::with(['trip', 'subRoute', 'seats', 'payment', 'user'])
                ->where('user_id', '=', Auth::id())
                ->where('id', '=', $ticket_id)
                ->first();

            Mail::to($ticket->user->email)->send(new TicketMail($ticket));

            return redirect()
                ->route('user.bookings')
                ->with('success', 'Ticket booked successfully.');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    /**
     * @return View
     */
    public function bookings(): View
    {
        $tickets = Ticket::with(['trip', 'subRoute', 'seats', 'payment'])
            ->where('user_id', '=', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('user.bookings', compact('tickets'));
    }

    /**
     * @param $ticket_id
     * @return View
     */
    public function print($ticket_id): View
    {
        $ticket = Ticket::with(['trip', 'subRoute', 'seats', 'payment', 'user'])
            ->where('user_id', '=', Auth::id())
            ->where('id', '=', $ticket_id)
            ->firstOrFail();

        $print = true;

        return view('user.ticket_print', compact('ticket', 'print'));
    }

    /**
     * @return View
     */
    public function changePassword(): View
    {
        return view('user.chang_password');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePasswordAction(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::query()
            ->where('id', '=', Auth::id())
            ->first();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return back()
                ->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        User::query()
            ->where('id', '=', Auth::id())
            ->update([
                'password' => Hash::make($request->input('password')),
            ]);

        return redirect()
            ->back()
            ->with('success', 'Password changed successfully.');
    }
}
