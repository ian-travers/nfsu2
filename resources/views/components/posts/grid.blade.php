@props(['posts'])

<div class="lg:grid lg:grid-cols-3 lg:gap-4">
    @foreach($posts as $post)
        <x-posts.card :post="$post"/>
    @endforeach
</div>
