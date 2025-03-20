@extends('layouts.main')

@section('content')
    {{-- Hero Section --}}
    <div class="max-w-4xl mx-auto mb-18">
        <div class="overflow-hidden rounded-lg shadow-lg max-h-[400px]">
            @if ($books[0]->image)
                <img src="{{ Storage::url($books[0]->image) }}" alt="Cover Buku" class="w-full h-96 object-cover">
            @else
                <img src="https://picsum.photos/1200/400" alt="Cover Buku" class="w-full h-96 object-cover">
            @endif
        </div>
        <div class="text-center mt-4">
            <h3 class="text-2xl font-bold"><a class="text-gray-900 hover:text-blue-500"
                    href="/hall/book/{{ $books[0]->slug }}">{{ $books[0]->name }}</a>
            </h3>
            <div class="flex justify-center items-center text-gray-600 text-sm gap-4 mt-2">
                <span class="flex items-center gap-1"><i class="fa-solid fa-user text-blue-600"></i> <a
                        href="/hall/author/{{ $books[0]->author->slug }}"
                        class="hover:text-blue-500">{{ $books[0]->author->name }}</a></span>
                <span class="flex items-center gap-1"><i class="fa-solid fa-bookmark text-green-500"></i> <a
                        href="/hall/category/{{ $books[0]->category->slug }}"
                        class="hover:text-blue-500">{{ $books[0]->category->name }}</a></span>
                <span class="flex items-center gap-1"><i
                        class="fa-solid fa-clock text-yellow-300"></i>{{ optional($books[0]->published_at)->diffForHumans() ?? 'Belum Terbit' }}</span>
            </div>
            <p class="text-gray-700 mt-2">{{ Str::limit($books[0]->body, 150) }}
            </p>
            <a href="/hall/book/{{ $books[0]->slug }}"
                class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Read
                more</a>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($books->skip(1) as $book)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="relative">
                        @if ($book->image)
                            <img src="{{ Storage::url($book->image) }}" alt="Book Cover" class="w-full h-60 object-cover">
                        @else
                            <img src="https://picsum.photos/400/300" alt="Book Cover" class="w-full h-60 object-cover">
                        @endif
                        <div class="absolute top-2 left-2 bg-black bg-opacity-70 text-white px-3 py-1 text-xs rounded">
                            <a href="/hall/category/{{ $book->category->slug }}"
                                class="hover:underline">{{ $book->category->name }}</a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="text-lg font-bold"><a href="/hall/book/{{ $book->slug }}"
                                class="hover:text-blue-500">{{ $book->name }}</a></h5>
                        <div class="flex items-center text-gray-600 text-sm gap-4 mt-2">
                            <span class="flex items-center gap-1"><i class="fa-solid fa-user text-blue-600"></i> <a
                                    href="/hall/author/{{ $book->author->slug }}"
                                    class="hover:text-blue-500">{{ $book->author->name }}</a></span>
                            <span class="flex items-center gap-1"><i class="fa-solid fa-clock text-yellow-300"></i>
                                {{ optional($book->published_at)->diffForHumans() ?? 'Belum Terbit' }}</span>
                        </div>
                        <p class="text-gray-700 mt-2">{{ Str::limit($book->body, 150) }}</p>
                        <a href="/hall/book/{{ $book->slug }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Read
                            more</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection