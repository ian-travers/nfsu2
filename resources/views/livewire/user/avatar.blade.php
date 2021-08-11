<div>
    @if($hasAvatar)
        <img
            class="h-{{ $size }} w-{{ $size }} rounded-full"
            src="{{ $avatarPath }}"
            alt="avatar"
        >
    @else
        <svg
            class="w-{{ $size }} h-{{ $size }}"
            viewBox="0 0 32 32"
        >
            <circle style="fill:#5294E2" cx="16" cy="16" r="14"/>
            <g>
                <path style="fill:#ffffff"
                      d="m 16,6 c -2.2096,0 -4,1.7912 -4,4 0,2.2088 1.7904,4 4,4 2.2096,0 4,-1.7912 4,-4 0,-2.2088 -1.7904,-4 -4,-4 z"/>
                <path style="fill:#ffffff"
                      d="m 16,16.000001 c -6.9993,0.0042 -7,4.430769 -7,4.430769 v 1.8 c 0,0 1.292299,2.76923 7,2.76923 5.707701,0 7,-2.76923 7,-2.76923 v -1.8 c 0,0 0,-4.433538 -6.9986,-4.430769 z"/>
            </g>
        </svg>
    @endif
</div>
