@extends('dashboard.layouts.main')

@section('content')
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-11 p-4">
            @if (session()->has('success'))
                <p class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                    {{ session('success') }}
                </p>
            @endif
            <a href="author/create"
                class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">Tambah author</a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-11 p-4">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Slug
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($authors->count())
                            @foreach ($authors as $author)

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                        {{ $author->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $author->slug }}
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <div class="text-yellow-500">
                                            <a href="/dashboard/author/{{ $author->slug }}/edit"><i
                                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        </div>
                                        |
                                        <div class="text-rose-500">
                                            <form action="/dashboard/author/{{ $author->slug }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="hover:cursor-pointer" onclick="return confirm('Are you sure?')"><i
                                                        class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td colspan="3" class="px-6 py-4 text-white text-center">
                                    Belum ada data author.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection