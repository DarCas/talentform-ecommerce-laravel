<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Contacts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function index(?Product $product)
    {
        return view('front.contacts')
            ->with('product', $product);
    }

    public function sendmail(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'email' => 'required|email:rfc',
            'fullname' => 'required|string|max:255|min:3',
            'messaggio' => 'required|max:65535|min:10',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect()->back()
                ->withErrors($errors);
        }

        $mail = Mail::to(new Address(
            address: config('mail.to.address'),
            name: config('mail.to.name')
        ));
        $response = $mail->send(
            new Contacts(
                fullname: $validator->getValue('fullname'),
                email: $validator->getValue('email'),
                telefono: $validator->getValue('telefono'),
                messaggio: $validator->getValue('messaggio'),
                product: $validator->getValue('product'),
            )
        );

        if ($response->getMessageId()) {
            return redirect('/contacts?success=true');
        } else {
            return redirect('/contacts?error=true');
        }
    }
}
