@extends('dashboard.layouts.main')

@section('content')
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-12 p-4">
            @if (session()->has('success'))
                <p class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                    {{ session('success') }}
                </p>
            @endif
            <a href="book/create" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">Tambah
                book</a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-12 p-4">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cover
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Published
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Author
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($books->count())
                            @foreach ($books as $book)

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ $book->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        @if ($book->cover)
                                            <img src="{{ Storage::url($book->cover) }}" class="w-24" alt="">
                                        @else
                                            <img src="https://picsum.photos/400/300" class="w-24" alt="">
                                        @endif
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ optional($book->published_at)->format('d M Y') ?? 'Belum Terbit' }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ $book->category->name }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ $book->author->name }}
                                    </th>
                                    <td class="px-6 py-4 flex gap-2">
                                        <div class="text-yellow-500">
                                            <a href="/dashboard/book/{{ $book->slug }}/edit"><i
                                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        </div>
                                        |
                                        <div class="text-rose-500">
                                            <form action="/dashboard/book/{{ $book->slug }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="hover:cursor-pointer"
                                                    onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td colspan="3" class="px-6 py-4 text-white text-center">
                                    Belum ada data buku.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection