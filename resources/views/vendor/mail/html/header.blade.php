@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/uploads/logo/logo-white.png') }}" class="logo" alt="JUnique Hair Braiding Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
