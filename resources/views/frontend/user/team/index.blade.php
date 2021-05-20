@php /** @var \App\Models\User $user */ @endphp
<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white">
            @if($user->isTeamCaptain())
                Manage Team
            @elseif($user->isTeamMember())
                See Team
            @else
                <div class="border border-blue-100 rounded sm:rounded-md">
                    <div class="bg-blue-100 py-2 px-4">
                        <h3 class="text-2xl sm:text-3xl">{{ __('Team') }}</h3>
                    </div>
                </div>
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
</x-layouts.settings>
