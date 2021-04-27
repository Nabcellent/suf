<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; color:rgba(159, 25, 16, 1)">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
