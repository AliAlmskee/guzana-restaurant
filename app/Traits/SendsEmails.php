<?php

namespace App\Traits;

use App\Mail\UserEmail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

trait SendsEmails
{
    /**
     * Send an email with default or custom parameters
     *
     * @param Request $request
     * @param string $defaultSubject
     * @param string $defaultBody
     * @param string $defaultTo
     * @return \Illuminate\Http\JsonResponse
     */public function sendEmail(
    string $subject,
    string $body,
    string $to,
    Order $order = null
) {
    try {
        Mail::to($to)->send(new UserEmail($subject, $body, $order));

        return response()->json([
            'success' => true,
            'message' => 'Email sent successfully!',
            'to' => $to,
            'subject' => $subject
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send email',
            'error' => $e->getMessage()
        ], 500);
    }
}
}