@php /** @var \App\Models\User $user */ @endphp
<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Your team') }}</h3>
                </div>
                @if($user->isTeamMember())
                    <div class="my-3 mx-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline">
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded text-3xl bg-gray-600 text-green-400">
                                {{ $team->clan }}
                            </span>
                                <span class="text-xl text-gray-500 ml-4">{{ $team->name }}</span>
                            </div>
                            <div>
                                @if($user->isTeamCaptain())
                                    <div>
                                        <a href="{{ route('settings.team.edit') }}">
                                            <x-form.primary-button>{{ __('Edit team') }}</x-form.primary-button>
                                        </a>
                                    </div>
                                @else
                                    <form action="{{ route('settings.team.join.leave') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <x-form.warning-button
                                            type="submit"
                                            onclick="return confirm('Leaving the team now?')"
                                        >
                                            {{ __('Leave team') }}
                                        </x-form.warning-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div>
                            <table class="border border-gray200 divide-y divide-200-200 rounded w-full">
                                <thead>
                                <tr class="text-center divide-x divide-gray-200">
                                    <th class="py-2 px-4">{{ __('Username') }}</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @foreach($team->racers as $racer)
                                    <tr class="divide-x divide-gray-200 {{ $racer->isTeamCaptain() ? 'bg-blue-50' : '' }}">
                                        <td class="py-1 px-3">{{ $racer->username }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="my-3 mx-4 space-y-3">
                        <p class="text-xl">{{ __('It looks like you are not in a team yet. You can continue to participate in tourneys as an independent racer. But, you have two more alternatives. Create your own team or join an existing one. You need to know the password to join a team. If you create a team, you will become its captain and set a password to join it. You will give this password to the racers who want to join your team. And before creating a team, find out if there are any racers who will join your team. A team that consists of one racer will look somewhat ridiculous. So make your choice or do nothing.') }}</p>
                        <div class="space-x-4">
                            <a href="{{ route('settings.team.join.join') }}">
                                <x-form.primary-button>{{ __('Join team') }}</x-form.primary-button>
                            </a>

                            <a href="{{ route('settings.team.create') }}">
                                <x-form.primary-button>{{ __('Create team') }}</x-form.primary-button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.settings>
