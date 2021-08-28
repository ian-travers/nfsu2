@props(['place', 'type', 'size'])

@php
    $types = [
        'circuit' => [
            'letter' => 'C',
            'x' => 60,
        ],
        'sprint' => [
            'letter' => 'S',
            'x' => 80,
        ],

        'drag' => [
            'letter' => 'D',
            'x' => 70,
        ],
        'drift' => [
            'letter' => 'T',
            'x' => 78,
        ],
    ];

    $colors = [
        1 => [
            'main' => '#ffd700',
            'letter' => '#ff9700',
        ],
        2 => [
            'main' => '#c0c0c0',
            'letter' => '#858585',
        ],
        3 => [
            'main' => '#cd7f32',
            'letter' => '#ad6b2a',
        ],
    ];

@endphp

<svg width="254" height="254" viewBox="0 0 254 254" class="h-{{ $size }} w-{{ $size }}">
    <polygon transform="scale(.5 .491)" points="305 0 452 0 351 173 204 173" style="fill:#f1543f"/>
    <polygon transform="scale(.5 .491)" points="157 173 304 173 203 0 56 0" style="fill:#ff7058"/>
    <circle cx="127" cy="160" r="93.5" style="fill:{{ $colors[$place]['main'] }}"/>
    <text style="fill:{{ $colors[$place]['letter'] }};font-size:165px;stroke-width:2;stroke:#003548">
        <tspan x="{{ $types[$type]['x'] }}" y="216">{{ $types[$type]['letter'] }}</tspan>
    </text>
</svg>
