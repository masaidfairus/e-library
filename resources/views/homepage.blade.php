@extends('layouts.main')

@section('content')
    {{-- Hero Start --}}
    <section class="pt-10 bg-gray-100 sm:pt-16 lg:pt-24">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
    <div class="max-w-2xl mx-auto text-center">
      <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl lg:leading-tight">Real humans are
      here to help you building your brand</h2>
      <p class="mt-6 text-lg text-gray-900">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.
      </p>
      <a href="#" title=""
      class="inline-flex items-center justify-center px-6 py-4 mt-12 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700"
      role="button">
      <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
      </svg>
      Contact our support
      </a>
    </div>
    </div>

    <div class="container mx-auto 2xl:px-12">
    <img class="w-full mt-6" src="https://cdn.rareblocks.xyz/collection/celebration/images/team/4/group-of-people.png"
      alt="" />
    </div>
    </section>
    {{-- Hero End --}}

    {{-- Stats Start --}}
    <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
      <dt class="text-base/7 text-gray-600">Transactions every 24 hours</dt>
      <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">44 million</dd>
      </div>
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
      <dt class="text-base/7 text-gray-600">Assets under holding</dt>
      <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">$119 trillion</dd>
      </div>
      <div class="mx-auto flex max-w-xs flex-col gap-y-4">
      <dt class="text-base/7 text-gray-600">New users annually</dt>
      <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">46,000</dd>
      </div>
    </dl>
    </div>
    </div>
    {{-- Stats End --}}

    {{-- Highlight Start --}}
    <section class="py-10 bg-white sm:py-16 lg:py-24">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">

    <div class="max-w-2xl mx-auto text-center">
      <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">Latest from blog</h2>
      <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-600">Amet minim mollit non deserunt ullamco
      est sit aliqua dolor do amet sint. Velit officia consequat duis.</p>
    </div>

    <div class="grid max-w-md grid-cols-1 mx-auto mt-12 lg:max-w-full lg:mt-16 lg:grid-cols-3 gap-x-16 gap-y-12">

      @foreach ($books as $book)
      <div>
      <a href="/hall/book/{{ $book->slug }}" title="" class="block aspect-w-4 aspect-h-3">
      @if ($book->cover)
      <img class="object-cover w-full h-full"
      src="{{ Storage::url($book->image) }}" alt="" />
      @else
      <img class="object-cover w-full h-full"
      src="https://cdn.rareblocks.xyz/collection/celebration/images/blog/1/blog-post-1.jpg" alt="" />
      @endif
      </a>

      <span class="inline-flex px-4 py-2 text-xs font-semibold tracking-widest uppercase rounded-full {{ $book->category_color }} mt-9">
      {{ $book->category->name }}
      </span>

      <p class="mt-6 text-xl font-semibold">
      <a href="/hall/book/{{ $book->slug }}" title="" class="text-black"> {{ $book->name }} </a>
      </p>

      <p class="mt-4 text-gray-600">{{ Str::limit($book->body, 150) }}</p>
      <div class="h-0 mt-6 mb-4 border-t-2 border-gray-200 border-dashed"></div>
      <span class="block text-sm font-bold tracking-widest text-gray-500 uppercase"> {{ $book->author->name }} .
      {{ $book->published_at->format('F j, Y') }}
      </span>
      </div>
  @endforeach

    </div>
    </div>
    </section>
    {{-- Highlight end --}}
@endsection