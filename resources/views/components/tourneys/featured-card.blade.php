@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<div
    class="transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 rounded-lg px-6 py-4 max-w-4xl mx-auto"
>
    <div class="flex items-start justify-between">
        <div class="mr-6">
            <img src="{{ asset("storage/images/{$tourney->type()}.png") }}" width="160" height="90" alt="race-type"
                 title="{{ __(ucfirst($tourney->type())) }}" class="rounded-lg">
        </div>

        <div class="flex-1 flex justify-between">
            <div class="space-y-2">
                <div class="text-2xl font-semibold">{{ $tourney->name }}</div>
                <div class="text-lg font-medium">
                    <span class="text-gray-400"> {{ __('Track') }}:</span>
                    {{ $tourney->trackName() }}
                </div>
                <div>
                    <span class="text-gray-400">{{ __('Starts at') }}:</span>
                    <time class="font-mono">{{ $tourney->started_at->format('H:i Y-m-d') }}</time>
                </div>
                <div>
                    <span class="text-gray-400">{{ __('Room') }}:</span>
                    <span class="uppercase">{{ $tourney->room }}</span>
                </div>
                <div>
                    <span class="text-gray-400">{{ Str::ucfirst(__('supervisor')) }}:</span>
                    {{ $tourney->supervisor_username }}
                </div>
                <div class="pr-2">
                    <span class="text-gray-400">{{ __('Additional information') }}:</span>
                    {{ $tourney->description }}
                </div>
            </div>
            <div class="flex flex-col items-end">
                <div>
                    @if($tourney->isSigningUp())
                        <form action="{{ route('tourneys.signup', $tourney) }}" method="post">
                            @csrf
                            <x-form.success-button type="submit">{{ __('Sign Up') }}</x-form.success-button>
                        </form>
                    @endif
                </div>
                <div class="mt-4 self-center">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full font-semibold bg-green-100 text-green-800"
                >
                    {{ $tourney->racers()->count() }}
                </span>
                </div>

                <div class="flex-grow">&nbsp;</div>
                <div>
                    <a href="{{ route('tourneys.show', $tourney) }}">
                        <x-form.primary-button>{{ __('Details') }}</x-form.primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @auth
        @if(auth()->user()->isSigned($tourney))
            <div class="border-t border-gray-400 border-opacity-50 mt-4 py-4">
                <div class="flex items-center justify-between">
                    <p>
                        <span class="font-bold tracking-wide leading-8">{{ auth()->user()->username }}</span>,
                        {{ __('you signed up.') }}
                    </p>
                    @if($tourney->isScheduled())
                        <form action="{{ route('tourneys.withdraw', $tourney) }}" method="post">
                            @csrf
                            <x-form.warning-button
                                type="submit"
                                onclick="return confirm()"
                            >
                                {{ __('Withdraw') }}
                            </x-form.warning-button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    @endauth
</div>


