<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\OrderStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationOnStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChanged $event)
    {
        $order = $event->order;

        // Cek status order dan buat notifikasi
        if (in_array($order->status, ['paid', 'settled', 'pending'])) {
            Notification::create([
                'user_id' => $order->user_id,
                'product_id' => $order->product_id,
                'status' => $order->status,
                'message' => "Order #{$order->id} status changed to {$order->status}",
            ]);
        }
    }
}
