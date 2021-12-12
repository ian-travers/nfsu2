@php /** @var \App\Models\Conversation\Message $message */ @endphp

@if(auth()->user()->is($message->user))
    <div>
        <div class="w-5/6 float-right bg-green-200 border border-green-400 rounded-lg mb-3 px-4 py-2">
                {{ $message->body }}
                <span class="block text-xs text-gray-600 text-right">{{ $message->created_at->isoFormat('lll') }}</span>
        </div>
    </div>
@else
    <div class="w-5/6 float-left flex flex-row items-center mb-3">
        <div class="pr-2">
            @livewire('user.avatar', ['user' => $message->dialogue->partner(), 'size' => 8])
        </div>
        <div class="bg-blue-200 border border-blue-400 rounded-lg px-4 py-2">
            {{ $message->body }}
            <span class="block text-xs text-gray-600 text-right">{{ $message->created_at->isoFormat('lll') }}</span>
        </div>
    </div>
@endif
