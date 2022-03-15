<tr>
    <td class="header">
        <a href="{{ env('APP_URL') }}" style="display: flex; align-items:center; justify-content:center; padding: 1rem 0px;">
            @if (trim($slot) === 'Laravel')
            <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
            @endif
            {{ $slot }}
        </a>
    </td>
</tr>