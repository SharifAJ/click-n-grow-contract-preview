@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium']) }}>
    {{ $value ?? $slot }} @if($required) <span class="text-error">*</span> @endif
</label>
