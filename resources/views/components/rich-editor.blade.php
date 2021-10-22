@props(['id' => 'rich-editor', 'mode' => 'small', 'theme' => 'light'])

@php
    $themes = [
        'light' => mix('css/rich-editor/default.css', 'build'),
        'dark' => mix('css/rich-editor/defaultdark.css', 'build')
    ];

    $toolbar = [
        'small' => 'bold,italic,underline,strike|size,color|emoticon|youtube|image,link,unlink|maximize,source',
        'full' => 'bold,italic,underline,strike|left,center,right,justify|size,color|code,quote|emoticon|youtube|image,link,unlink|maximize,source'
    ]
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ $themes[$theme] }}">
@endpush

<textarea id="{{ $id }}" {{ $attributes(['rows' => '10']) }}></textarea>

@push('scripts')
    <script>
        var textarea = document.getElementById('{{ $id }}');
        sceditor
            .create(textarea, {
                plugins: 'undo',
                format: 'xhtml',
                toolbar: '{{ $toolbar[$mode] }}',
                emoticonsRoot: 'storage/',
                style: "{{ $themes[$theme] }}"
            })
    </script>
@endpush
