<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class EmailController extends Controller
{
    //
    public function sendEmail()
    {
      $to = 'mianazan3@gmail.com';
      $subject = 'Test Email';
      $message = 'This is a test email.';
  
      Mail::send('emails.test', ['message' => $message], function($message) use ($to, $subject) {
        $message->to($to)->subject($subject);
      });
  
      return response()->json(['message' => 'Email sent successfully']);
    }
}
