@props(['name' => 'file', 'default' => null, 'height' => 300])

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('vendor/dropify/css/dropify.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('vendor/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush

<input type="file" name="{{ $name }}" class="dropify" data-default-file="{{ $default }}" data-height="{{ $height }}" />
@error($name)
    <span class="invalid-feedback">{{ $message }}</span>
@enderror