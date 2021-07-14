@props(['title', 'tracks', 'currentTrack'])

<optgroup label="{{ $title }}">
    @foreach($tracks as $id => $name)
        <option value="{{ $id }}" {{ $id == $currentTrack ? 'selected' : '' }}>{{ $name }}</option>
    @endforeach
</optgroup>
