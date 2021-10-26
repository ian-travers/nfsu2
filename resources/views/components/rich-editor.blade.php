@props(['id' => 'rich-editor', 'mode' => 'full', 'value' => null])

@php
    $toolbar = [
        'small' => 'bold,italic,underline,strike|size,color|emoticon|youtube|image,link,unlink|maximize,source',
        'full' => 'bold,italic,underline,strike|left,center,right,justify|size,color|code,quote|emoticon|youtube|image,link,unlink|maximize,source'
    ]
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ mix('css/rich-editor/default.css', 'build') }}">
@endpush

<textarea id="{{ $id }}" {{ $attributes(['rows' => '10']) }}>{!! $value !!}</textarea>

@push('scripts')
    <script>
        var textarea = document.getElementById('{{ $id }}');
        sceditor
            .create(textarea, {
                plugins: 'undo',
                format: 'xhtml',
                toolbar: '{{ $toolbar[$mode] }}',
                emoticonsRoot: 'storage/',
                style: "{{ mix('css/rich-editor/default.css', 'build') }}"
            })
    </script>
@endpush
