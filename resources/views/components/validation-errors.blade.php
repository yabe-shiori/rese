@if ($errors->has($field))
    <p class="text-red-500 text-base mt-1">{{ $errors->first($field) }}</p>
@endif
