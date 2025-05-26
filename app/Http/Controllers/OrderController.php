<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\SendsEmails;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class OrderController extends Controller
{
    use SendsEmails ; 
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
    
        if ($status == 'Bestätigt') {
            $orders = Order::where('status', $status)
                           ->where('created_at', '>=', Carbon::now()->subDays(30))
                           ->orderBy('created_at', 'asc')
                           ->paginate(20);   
        } else {
            $orders = Order::where('status', $status)
                           ->where('created_at', '>=', Carbon::now()->subDays(30))
                           ->orderBy('created_at', 'desc')
                           ->paginate(20);    
        }
    
        return OrderResource::collection($orders);
    }
    
    public function store(OrderRequest $request)
    { 
        $data = $request->validated();
        $data['status'] = 'pending';
        
        $order = Order::create($data);
        
        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }

    public function approveOrder(Order $order)
    {
        if ($order->status != 'pending') {
            return response()->json(
                ['message' => 'Order is not pending'], 
                400
            );
        }
        $order->status = 'Bestätigt';
        $order->save();
    
        $subject = 'Reservierungsbestätigung '; 
        $body = 'vielen Dank für Ihre Reservierung im Guzana Restaurant.
        Hiermit bestätigen wir Ihnen gerne Ihre Tischreservierung wie folgt: '; 
         $this->sendEmail($subject, $body, $order->user_email,$order);

          return  response()->json(['message' => 'Order approved successfully'], 200);
    }
    
    public function denyOrder(Request $request, Order $order)
{
    $validated = $request->validate([
        'next_available_date' => 'required|date_format:Y-m-d H:i:s',
    ]);

    $order->status = 'Abgelehnt';
    $order->save();

    $reservationTime = $order->date;

    $subject = 'Ihre Reservierungsanfrage'; 
    $body =
    "vielen Dank für Ihre Reservierungsanfrage um {$reservationTime} in unserem Restaurant.\n\n" .
    "Leider müssen wir Ihnen mitteilen, dass wir zu diesem Zeitpunkt bereits vollständig ausgebucht sind und Ihre Reservierung daher nicht bestätigen können.\n\n" .
    "Gerne möchten wir Ihnen stattdessen einen alternativen Termin anbieten: {$validated['next_available_date']}.\n\n" .
    "Sollte dieser Termin für Sie nicht passend sein, können Sie uns gerne auf diese E-Mail antworten oder jederzeit bequem über unsere Website einen neuen Termin reservieren.

    Falls der Termin für Sie passt, können Sie ihn ebenfalls ganz einfach per E-Mail bestätigen..";


    $this->sendEmail($subject, $body, 'foxg4393@gmail.com', $order);

    return response()->json(['message' => 'Order denied successfully'], 200);
}



}
