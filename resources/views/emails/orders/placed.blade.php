@component('mail::message')
# Order Placed

Heyy {{ $firstName }}{{ $icons['hello'] }},<br>

Your order has been placed successfully and is being processed!<br>
We will contact you using this number: +254 {{ $order->phone }}.{{ $icons['relax'] }}

@component('mail::panel')
    Order Total: KSH {{ currencyFormat($order->total) }}
@endcomponent

@component('mail::button', ['url' => route('profile', ['page' => 'orders']), 'color' => 'primary'])
    View Order
@endcomponent

@component('mail::subcopy')
    Order No: #{{ $order->order_no }}
@endcomponent

Thanks you for shopping with us{{ $icons['thanks'] }},<br>

Regards,<br>
{{ config('app.name') }}
@endcomponent
