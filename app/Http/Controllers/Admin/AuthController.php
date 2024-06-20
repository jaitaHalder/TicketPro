<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view("admin.auth.index");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route("admin.dashboard.index");
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
        Auth::guard('admin')->logout();
        return redirect()->route("admin.auth.index");
    }

    /**
     * @return View
     */
    public function profile(): View
    {
        $user = Auth::guard('admin')->user();

        return view("admin.auth.profile", compact("user"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function profileUpdate(Request $request): RedirectResponse
    {
        $id = Auth::guard('admin')->id();
        $user = Admin::query()
            ->where('id', '=', $id)
            ->first();

        // Profile Update
        if ($request->input("form") === "profile") {
            $request->validate([
                "name" => "required",
                "email" => [
                    "required",
                    "email",
                    Rule::unique('admins')->ignore($id)
                ],
            ]);

            try {
                Admin::query()
                    ->where("id", $id)
                    ->update([
                        "name" => $request->input("name"),
                        "email" => $request->input("email"),
                    ]);

                return redirect()->back()->with("success", "Profile has been updated successfully.");
            } catch (Exception $exception) {
                return redirect()->back()->with("error", "QueryException code: " . $exception->getMessage());
            }
        }

        // Password Update
        if ($request->input("form") === "password") {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);


            if (!Hash::check($request->input('old_password'), $user->password)) {
                return back()
                    ->withErrors(['old_password' => 'The old password is incorrect.']);
            }

            try {
                Admin::query()
                    ->where("id", $id)
                    ->update([
                        "password" => Hash::make($request->input("password")),
                    ]);

                return redirect()->back()->with("success", "Password has been updated successfully.");

            } catch (Exception $exception) {
                return redirect()->back()->with("error", "QueryException code: " . $exception->getMessage());
            }
        }

        return redirect()->back();
    }
}
