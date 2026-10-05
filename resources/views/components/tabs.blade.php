@props([
    'name' => 'my_tabs',
    'label' => 'Default Tab',
    'index' => 0,
])

<label for="{{ $name . '_' . $index }}" class="tab tab-lifted cursor-pointer"
    x-on:click="$dispatch('change-tab', {{ $index }})">
    {{ $label }}
</label>
