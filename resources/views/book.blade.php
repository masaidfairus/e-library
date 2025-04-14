@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-2">{{ $book->name }}</h2>

            <p class="text-gray-600 text-sm mb-4">
                By:
                <a class="text-blue-600 hover:underline" href="/hall?author={{ $book->author->slug }}">
                    {{ $book->author->name }}
                </a>
                in
                <a class="text-blue-600 hover:underline" href="/hall?category={{ $book->category->slug }}">
                    {{ $book->category->name }}
                </a>
            </p>

            @if ($book->image)
                <div class="max-h-[350px] overflow-hidden rounded-md">
                    <img src="{{ Storage::url($book->image) }}" alt="{{ $book->category->name }}" class="w-full object-cover">
                </div>
            @else
                <img src="https://picsum.photos/1200/400" alt="{{ $book->category->name }}" class="w-full object-cover rounded-md">
            @endif

            <article class="prose max-w-none my-6">
                {!! $book->body !!}
            </article>

            <a href="/hall" class="inline-block text-blue-500 hover:underline mt-4">← Back to hall</a>
        </div>
    </div>
@endsection