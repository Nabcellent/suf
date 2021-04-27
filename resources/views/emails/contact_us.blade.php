@component('mail::message')
# {{ $details['subject'] }}

{{ $details['message'] }}

@component('mail::button', ['url' => route('admin.dashboard')])
Open Admin
@endcomponent

Regards,<br>
{{ $details['last_name'] }} {{ $details['last_name'] }}<br>
<a href="mailto:{{ $details['email'] }}">{{ $details['email'] }}</a>
<hr>
{{ config('app.name') }}
@endcomponent
