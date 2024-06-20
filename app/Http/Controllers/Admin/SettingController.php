<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SettingController extends Controller
{
    private array $settings;

    public function __construct()
    {
        $this->settings = Setting::query()->pluck("value", "setting_name")->toArray();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view("admin.settings.index", $this->compactSetting());
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Validation
        $errors = Validator::make($request->all(), [
            "SETTING_SITE_LOGO" => "nullable|file|mimes:jpeg,png,gif",
            "SETTING_SITE_FAVICON" => "nullable|file|mimes:jpeg,png,gif",
        ], [
            "SETTING_SITE_LOGO" => "The logo field must be a file of type: jpeg, png or gif.",
            "SETTING_SITE_FAVICON" => "The favicon field must be a file of type: jpeg, png or gif.",
        ])->errors();


        if ($errors->isNotEmpty()) {
            $errorText = "&#x2022; " . implode("<br>&#x2022; ", $errors->all());

            return redirect(route("admin.settings.index"))
                ->with("error", $errorText);
        }

        try {
            // SETTING_SITE_TITLE
            Setting::query()->where("setting_name", "SETTING_SITE_TITLE")
                ->update(["value" => $request->input("SETTING_SITE_TITLE")]);

            // SETTING_SITE_DESCRIPTION
            Setting::query()->where("setting_name", "SETTING_SITE_DESCRIPTION")
                ->update(["value" => $request->input("SETTING_SITE_DESCRIPTION")]);

            // SETTING_SOCIAL_FACEBOOK
            Setting::query()->where("setting_name", "SETTING_SOCIAL_FACEBOOK")
                ->update(["value" => $request->input("SETTING_SOCIAL_FACEBOOK")]);

            // SETTING_SOCIAL_YOUTUBE
            Setting::query()->where("setting_name", "SETTING_SOCIAL_YOUTUBE")
                ->update(["value" => $request->input("SETTING_SOCIAL_YOUTUBE")]);

            // SETTING_SOCIAL_INSTAGRAM
            Setting::query()->where("setting_name", "SETTING_SOCIAL_INSTAGRAM")
                ->update(["value" => $request->input("SETTING_SOCIAL_INSTAGRAM")]);

            // SETTING_SOCIAL_LINKEDIN
            Setting::query()->where("setting_name", "SETTING_SOCIAL_LINKEDIN")
                ->update(["value" => $request->input("SETTING_SOCIAL_LINKEDIN")]);

            // SETTING_SOCIAL_TWITTER
            Setting::query()->where("setting_name", "SETTING_SOCIAL_TWITTER")
                ->update(["value" => $request->input("SETTING_SOCIAL_TWITTER")]);

            // CONTACT_EMAIL
            Setting::query()->where("setting_name", "CONTACT_EMAIL")
                ->update(["value" => $request->input("CONTACT_EMAIL")]);

            // CONTACT_PHONE
            Setting::query()->where("setting_name", "CONTACT_PHONE")
                ->update(["value" => $request->input("CONTACT_PHONE")]);

            // CONTACT_ADDRESS
            Setting::query()->where("setting_name", "CONTACT_ADDRESS")
                ->update(["value" => $request->input("CONTACT_ADDRESS")]);

            // CONTACT_GOOGLE_MAP
            Setting::query()->where("setting_name", "CONTACT_GOOGLE_MAP")
                ->update(["value" => $request->input("CONTACT_GOOGLE_MAP")]);

            // SETTING_ABOUT_US
            Setting::query()->where("setting_name", "SETTING_ABOUT_US")
                ->update(["value" => $request->input("SETTING_ABOUT_US")]);

            // PRIVACY_POLICY
            Setting::query()->where("setting_name", "PRIVACY_POLICY")
                ->update(["value" => $request->input("PRIVACY_POLICY")]);

            // SETTING_SITE_LOGO
            if ($request->hasFile("SETTING_SITE_LOGO")) {
                // Delete previous file
                $filePath = public_path($this->settings["SETTING_SITE_LOGO"]);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                // Handle file upload
                $image = $request->file("SETTING_SITE_LOGO");
                $imageName = "logo." . $image->getClientOriginalExtension();
                $image->storeAs("public", $imageName);

                Setting::query()->where("setting_name", "SETTING_SITE_LOGO")
                    ->update(["value" => $imageName]);
            }

            // SETTING_SITE_FAVICON
            if ($request->hasFile("SETTING_SITE_FAVICON")) {
                // Delete previous file
                $filePath = public_path($this->settings["SETTING_SITE_FAVICON"]);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                // Handle file upload
                $image = $request->file("SETTING_SITE_FAVICON");
                $imageName = "favicon." . $image->getClientOriginalExtension();
                $image->storeAs("public", $imageName);

                Setting::query()->where("setting_name", "SETTING_SITE_FAVICON")
                    ->update(["value" => $imageName]);
            }

            return redirect(route("admin.settings.index"))
                ->with("success", "Settings has been updated successfully!");
        } catch (Exception $exception) {
            return redirect(route("admin.settings.index"))
                ->with("error", $exception->getMessage());
        }
    }


    /**
     * @return array
     */
    private function compactSetting(): array
    {
        $settings = $this->settings;
        return compact("settings");
    }
}
