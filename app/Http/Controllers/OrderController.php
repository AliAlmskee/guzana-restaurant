<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\SendsEmails;
use Illuminate\Support\Facades\Request;


class OrderController extends Controller
{
    use SendsEmails ; 
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        $orders = Order::where('status', $status)
        ->paginate($request->query('per_page', 15));     

        return OrderResource::collection($orders)->pagabel;
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

        $order->status = 'approved';
        $order->save();
    
        $subject = 'Bestellung genehmigt'; 
        $body = 'Ihre Bestellung wurde genehmigt.'; 
        $this->sendEmail($subject, $body, $order->user_email);
    
        return response()->json(null, 204);
    }
    
    public function denied(Request $request, Order $order)
    {
        $request->validate([
            'body' => 'required|string',
            'date' => 'required|date',
        ]);
    
        $order->status = 'denied';
        $order->save();
    
        $subject = 'Bestellung abgelehnt'; 
        $body = "Ihre Bestellung wurde abgelehnt am {$validate->date}"; 
        $this->sendEmail($subject, $body, $order->user_email);
    
        return response()->json(null, 204);
    }
    


}
