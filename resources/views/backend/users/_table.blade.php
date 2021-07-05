@php /** @var \App\Models\User $user */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('Username') }}</x-table.th>
                        <x-table.th>{{ __('Country') }}</x-table.th>
                        <x-table.th>{{ __('Flag') }}</x-table.th>
                        <x-table.th>{{ __('Status') }}</x-table.th>
                        <x-table.th>{{ __('Role') }}</x-table.th>
                        <x-table.th>{{ __('Team captain') }}</x-table.th>
                        <x-table.th>{{ __('Admin') }}</x-table.th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Change Password</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @livewire('user.avatar', ['user' => $user])
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->username }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->country }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="fflag ff-lg fflag-{{ $user->country }}"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @include('components.user-status-badge', ['active' => !$user->trashed()])
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->getRole() }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                <span class="flex justify-center">
                                    @if($user->isTeamCaptain())
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </span>

                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                <span class="flex justify-center">
                                @if($user->isAdmin())
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <x-form.secondary-button
                                    type="button"
                                    data-target="changePassword"
                                    class="modal-open"
                                    data-user-id="{{ $user->id }}"
                                    data-user-username="{{ $user->username }}"
                                >
                                    {{ __('Change password') }}...
                                </x-form.secondary-button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($user->trashed())
                                    <form action="{{ route('adm.users.restore', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button
                                            type="submit"
                                            onclick="return confirm(__('This user will be able to login the site! Proceed?'))"
                                            class="text-green-600 hover:text-green-900"
                                        >
                                            {{ __('Restore') }}
                                        </button>
                                    </form>
                                    <form action="{{ route('adm.users.delete', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button
                                            type="submit"
                                            onclick="return confirm(__('This user will be deleted. His username will become available for registration. Proceed?'))"
                                            class="text-red-600 hover:text-red-900"> {{ __('Delete') }}</button>
                                    </form>
                                @else
                                    <a
                                        href="{{ route('adm.users.edit', $user) }}"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('adm.users.trash', $user) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button
                                            type="submit"
                                            onclick="return confirm(__('This user will not be able to login the site! Proceed?'))"
                                            class="text-yellow-600 hover:text-yellow-900"
                                        >
                                            {{ __('Trash') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
