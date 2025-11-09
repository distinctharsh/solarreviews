@props(['value' => null])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    @if($value)
        {{ $value }}
    @else
        {{ $slot ?? '' }}
    @endif
</label>
