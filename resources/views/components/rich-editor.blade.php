@props(['mode' => 'small', 'id' => 'rich-editor'])

@php
    $toolbar = [
        'small' => 'bold,italic,underline,strike|size,color|emoticon|youtube|image,link,unlink|maximize,source',
        'full' => 'bold,italic,underline,strike|left,center,right,justify|size,color|code,quote|emoticon|youtube|image,link,unlink|maximize,source'
    ]
@endphp

<textarea id="{{ $id }}" {{ $attributes(['rows' => '10']) }}>{{ $toolbar[$mode] }}</textarea>

@push('scripts')
    <script>
        var textarea = document.getElementById('{{ $id }}');
        sceditor
            .create(textarea, {
                plugins: 'undo',
                format: 'xhtml',
                toolbar: '{{ $toolbar[$mode] }}',
                emoticonsRoot: 'storage/',
                style: "{{ mix('css/app.css', 'build') }}"
            })
    </script>
@endpush
