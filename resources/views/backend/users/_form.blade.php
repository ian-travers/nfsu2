@php /** @var \App\Models\User $user */ @endphp
<div class="mt-4">
    <x-form.label for="username" value="{{ __('Username') }}"/>
    <x-form.input
        id="username"
        class="block mt-1 w-full"
        type="text"
        name="username"
        value="{{ old('username', $user->username) }}"
        autofocus
        autocomplete="username"
    />
    @error('username')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="country" value="{{ __('Country') }}"/>
    <select
        id="country"
        name="country"
        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
    >
        <option value="undefined">{{ __('Select country ...') }}</option>
        @foreach($countries as $code => $name)
            <option value="{{ $code }}" {{ $code === old('country', $user->country) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
    @error('country')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="email" value="Email"/>
    <x-form.input
        id="email"
        class="block mt-1 w-full"
        type="email"
        name="email"
        value="{{ old('email', $user->email) }}"
        autocomplete="email"
    />
    @error('email')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="role" value="{{ __('Role') }}"/>
    <select
        id="role"
        name="role"
        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
    >
        @foreach($roles as $id => $name)
            <option value="{{ $id }}" {{ $id === old('role', $user->role) ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
    @error('role')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4 space-y-1">
    <x-form.label value="{{ __('Notifications') }}"/>
    <div class="flex items-center">
        <input
            id="browser-notified"
            type="checkbox"
            name="is_browser_notified"
            {{ $user->is_browser_notified ? 'checked' : '' }}
        >
        <x-form.label class="pl-3" for="browser-notified">Browser</x-form.label>
        @error('is_browser_notified')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
    <div class="flex items-center">
        <input
            id="email-notified"
            type="checkbox"
            name="is_email_notified"
            {{ $user->is_email_notified ? 'checked' : '' }}
        >
        <x-form.label class="pl-3" for="email-notified">Email</x-form.label>
        @error('is_email_notified')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
</div>

@unless($user->exists)
    <div class="mt-4">
        <x-form.label for="password" value="{{ __('Password') }}"/>
        <x-form.input
            id="password"
            class="block mt-1 w-full"
            type="password"
            name="password"
            autocomplete="new-password"
        />
        @error('password')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
@endunless
