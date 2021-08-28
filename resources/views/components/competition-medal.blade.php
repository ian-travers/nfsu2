@props(['place', 'size'])

@php
    $colors = [
        1 => [
            'main' => '#ffd700',
            'light' => '#ffe833',
            'shadow' => '#640',
        ],
        2 => [
            'main' => '#c0c0c0',
            'light' => '#d1d1d1',
            'shadow' => '#666',
        ],
        3 => [
            'main' => '#cd7f32',
            'light' => '#d59352',
            'shadow' => '#3f270f',
        ],
    ];

@endphp

<svg width="256" height="256" viewBox="0 0 256 256" class="h-{{ $size }} w-{{ $size }}">
    <path d="m84 178c-33-46-48-128-48-128l92-50 92 50s-13 82-45 128l-92-.001z" style="fill:{{ $colors[$place]['main'] }};stroke-width:.5"/>
    <g transform="scale(.5)" style="opacity:.3">
        <path d="m365 58-250 192c10 26 22 53 36 77l291-228-76-41z" style="fill:{{ $colors[$place]['shadow'] }}"/>
    </g>
    <path d="m108 179c-.91 0-1.8-.31-2.6-.94-17-14-31-38-43-71-8.8-25-13-45-13-46-.4-2.1 1-4.2 3.2-4.6 2.2-.39 4.2 1 4.6 3.1.15.81 16 81 53 113 1.7 1.4 1.9 3.9.44 5.5-.79.9-1.9 1.4-3 1.4z" style="fill:{{ $colors[$place]['light'] }};stroke-width:.5"/>
    <g transform="matrix(.5 0 0 .5 0 .0018)">
        <path d="m402 79c-10 48-31 127-64 191-12 23-35 37-61 37l-138-.001c8.8 18 18 34 29 49l184 .001c62-92 89-256 89-256l-39-21z" style="fill:{{ $colors[$place]['shadow'] }};opacity:.3"/>
        <path d="m435 512h-355v-123c0-18 15-34 34-34h288c18 0 34 15 34 34v123h.001z" style="fill:{{ $colors[$place]['shadow'] }}"/>
    </g>
    <g transform="matrix(.5 0 0 .5 -1.2e-6 -1.2e-6)">
        <rect x="79" y="457" width="355" height="55" style="fill:#56361d"/>
        <path d="m108 492c-4.3 0-7.8-3.5-7.8-7.8v-85c0-4.3 3.5-7.8 7.8-7.8s7.8 3.5 7.8 7.8v85c0 4.3-3.5 7.8-7.8 7.8z" style="fill:#56361d"/>
    </g>
    <path d="m170 212h-82c-4.4 0-8-3.3-8-7.3v-1.5c0-4 3.6-7.3 8-7.3h82c4.4 0 8 3.3 8 7.3v1.5c0 4-3.6 7.3-8 7.3z" style="fill:#fff5cc;stroke-width:.48"/>
</svg>
