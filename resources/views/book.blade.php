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
                <img src="https://picsum.photos/1200/400" alt="{{ $book->category->name }}"
                    class="w-full object-cover rounded-md">
            @endif

            <article class="prose max-w-none my-6">
                {!! $book->body !!}
            </article>

            <a href="/hall" class="inline-block text-blue-500 hover:underline mt-4">← Back to hall</a>

            @auth
                @if ($book->status == 1)
                    <a href="" onclick="alert('Buku sedang dipinjam')"
                        class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow
                            hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fa-solid fa-book-open-reader"></i>
                        Pinjam Buku
                    </a>
                @else
                    <form action="/borrow" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="book_id" value="{{ $book->id }}">

                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow
                                hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <i class="fa-solid fa-book-open-reader"></i>
                            Pinjam Buku
                        </button>
                    </form>
                @endif
            @else
                <a href="/login"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow
                        hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    <i class="fa-solid fa-book-open-reader"></i>
                    Pinjam Buku
                </a>
            @endauth
        </div>
    </div>
@endsection