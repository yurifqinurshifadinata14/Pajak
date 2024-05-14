@props(['title', 'model', 'type', 'value', 'status'])

<div class="form-floating">
    <input type="{{ $type }}" class="form-control" {{ $status }} id="{{ $title }}"
        :value="{{ $value }}" x-model="{{ $model }}" placeholder="{{ $title }}">
    <label for="{{ $title }}">{{ $title }}</label>

</div>
