@props(['field'])

@error($field)
    <div class="text-danger small mt-1">
        {{ $message }}
    </div>
@enderror