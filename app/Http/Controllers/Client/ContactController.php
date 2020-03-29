<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use App\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.contact.index');
    }


    /**
     * Send contact email.
     *
     * @param  App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function sendContactEmail(ContactRequest $request)
    {
        $data = $request->only([
            'name',
            'email',
            'subject',
            'message',
        ]);

        $users = User::where('role', config('user.role.manager'))->get('email')->toArray();

        try {
            Mail::to($users)->send(new ContactEmail($data));
        } catch (\Throwable $th) {
            Log::error($th);

            return back()->with('error', 'Email failed!');
        }

        return redirect('/home')->with('success', 'Email success!');
    }
}
