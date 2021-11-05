<div class="bg-white rounded-md sm:rounded-lg text-gray-900 px-4 py-2 sm:py-6 mx-4">
    <div class="border border-blue-100 rounded sm:rounded-md">
        <div class="bg-blue-100 px-4 py-2">
            <h3 class="text-2xl sm:text-3xl">{{ __('Your notifications settings') }}</h3>
        </div>
        <div class="text-xl my-3 mx-4 space-y-2">
            <p>{{ __('Choose how you receive notifications. These notification settings apply to several events. Namely, a new tourney has been created, a new competition has been created, a new post has been published.') }}</p>

            <p>{{ __('Browser notification means a bell icon only on this site. Email notification means sending you a corresponding letter to your email address.') }}</p>
        </div>

        <div class="grid gap-4 justify-items-center my-8 mx-4">
            <div wire:click="toggleBrowser" class="flex items-center justify-between w-1/6">
                <span class="font-medium text-gray-900 cursor-pointer">{{ __('Browser') }}</span>
                <button type="button"
                        class="{{ $is_browser_notified ? 'bg-blue-500' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ml-2"
                        aria-pressed="false"
                >
                <span
                    class="{{ $is_browser_notified ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
                >
                    <span
                        class="{{ $is_browser_notified ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200' }} absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"

                        aria-hidden="true"
                    >
                        <svg class="bg-white h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                            <path
                                d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </span>
                    <span
                        class="{{ $is_browser_notified ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100' }} absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >
                        <svg class="bg-white h-3 w-3 text-blue-500" fill="currentColor" viewBox="0 0 12 12">
                            <path
                                d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"/>
                         </svg>
                    </span>
                </span>
                </button>
            </div>

            <div wire:click="toggleEmail" class="flex items-center justify-between w-1/6">
                <span class="font-medium text-gray-900 cursor-pointer">{{ __('Email') }}</span>
                <button type="button"
                        class="{{ $is_email_notified ? 'bg-blue-500' : 'bg-gray-200' }} relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ml-2"
                        aria-pressed="false"
                >
                <span
                    class="{{ $is_email_notified ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
                >
                    <span
                        class="{{ $is_email_notified ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200' }} absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"

                        aria-hidden="true"
                    >
                        <svg class="bg-white h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                            <path
                                d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </span>
                    <span
                        class="{{ $is_email_notified ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100' }} absolute inset-0 h-full w-full flex items-center justify-center transition-opacity"
                        aria-hidden="true"
                    >
                        <svg class="bg-white h-3 w-3 text-blue-500" fill="currentColor" viewBox="0 0 12 12">
                            <path
                                d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"/>
                         </svg>
                    </span>
                </span>
                </button>
            </div>
        </div>

        <div class="mt-4 flex justify-end px-4 py-2">
            <x-form.primary-button
                wire:click="submit"
            >
                {{ __('Save') }}
            </x-form.primary-button>
        </div>
    </div>
</div>
