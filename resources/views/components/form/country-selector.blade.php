<select
    wire:model.lazy="country"
    id="country"
    name="country"
    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md"
>
    <option value="undefined">{{ __('Select country ...') }}</option>
    @foreach($countries as $code => $name)
        <option value="{{ $code }}">{{ $name }}</option>
    @endforeach
</select>
