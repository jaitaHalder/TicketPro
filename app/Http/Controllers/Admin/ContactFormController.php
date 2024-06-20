<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactFormController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $contactForms = ContactForm::all();

        return view('admin.contact_forms.index', compact('contactForms'));
    }

    /**
     * @param ContactForm $contactForm
     * @return RedirectResponse
     */
    public function destroy(ContactForm $contactForm): RedirectResponse
    {
        $contactForm->delete();

        return redirect()
            ->back()
            ->with('success', 'Data has been deleted successfully.');
    }
}
