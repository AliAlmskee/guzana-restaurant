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
    
        $orders = Order::where('status', $status)
                      ->where('created_at', '>=', Carbon::now()->subDays(30))
                      ->orderBy('created_at', 'desc')
                      ->paginate(20);    
                      
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
        $order->status = 'approved';
        $order->save();
    
        $subject = 'Reservierungsbestätigung – Guzana Restaurant'; 
        $body = 'vielen Dank für Ihre Reservierung im Guzana Restaurant.
        Hiermit bestätigen wir Ihnen gerne Ihre Tischreservierung wie folgt: '; 
         $this->sendEmail($subject, $body, $order->user_email,$order);

         return   response()->json(['message' => 'Order approved successfully'], 200);
    }
    
    public function denyOrder(Request $request, Order $order)
    {
        $validated = $request->validate([
            'next_available_date' => 'required|date_format:Y-m-d H:i:s',
        ]);
    
        $order->status = 'denied';
        $order->save();
    
        $subject = 'Bestellung abgelehnt'; 
        $body = "Ihre Bestellung wurde abgelehnt. Nächstes verfügbares Datum: {$validated['next_available_date']}"; 
        $this->sendEmail($subject, $body, $order->user_email,$order);
    
        return response()->json(['message' => 'Order denied successfully'], 200);
    }


}
