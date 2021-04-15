@component('mail::message')
# Order Placed

Heyy {{ $user->first_name }},<br>

Your order has been placed successfully and is being processed!

@component('mail::panel')
    Order Total: KSH {{ $orderTotal }}
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'primary'])
    View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
