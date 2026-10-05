@props(['disabled' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}
    @if($disabled) disabled @endif>
    {{ $slot }}
</button>