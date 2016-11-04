Get ready for some great stuff!

Your fpKids Resources order has been placed.

Campus: {{ $order->campus }}
Estimated delivery date: {{ $order->delivery_date_formatted }}.

Summary
----------------------------------------------------------------

@foreach($order->items as $item){!! $item->product->name !!}@if ($item->choices) || {!!  $item->choices !!}@endif || Qty: {{ $item->quantity }}
@endforeach

----------------------------------------------------------------

Thank you.

NOTE: This is an automated email. Please do not reply directly.

If you need help, contact the Global fpKids Administrator.
http://faithpromise.org/staff

