@extends('layouts.main')

@section('content')
    <div class="p-4">
        <div class="bg-white rounded-lg overflow-hidden relative">
            <div class="flex absolute top-2 left-2">
                <a href="{{ route('category.index') }}" class="text-sm font-medium text-blue-500 flex items-center transition-all duration-300 bg-white/[0.5] hover:bg-white/[0.8] p-3 py-2 rounded-lg backdrop-blur-sm border border-white">
                    <i data-feather="arrow-left" class="w-5 h-5 text-sky-600"></i>
                    <span class="ml-2 text-sky-600">Detail Buku</span>
                </a>
            </div>
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-52 object-cover">
            <div class="p-7">
                <div class="flex items-center mb-6">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                        class="w-20 h-20 rounded-full" />
                    <div class="ml-3">
                        <h1 class="text-gray-700 text-2xl font-bold">{{ $category->name }}</h1>
                        <p class="text-gray-600 text-sm">{{ $category->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $category->books->count() }} buku</p>
                    </div>
                </div>
                <h1 class="text-gray-700 text-lg font-semibold">Books</h1>
                <div class="grid grid-cols-4 gap-10 mb-8">
                    @foreach ($category->books as $book)
                        <a href="{{ route('books.show', $book->slug) }}"
                            class="group transition rounded-md hover:scale-95 duration-300 relative">
                            @php
                                $dipinjam = false;
                            @endphp
                            @if ($book->borrow->isNotEmpty())
                                @foreach ($book->borrow as $borrow)
                                    @if ($borrow->user_id == auth()->user()->id && $borrow->status == 'meminjam')
                                        @php
                                            $dipinjam = true;
                                        @endphp
                                        <div class="bg-zinc-800 p-3 py-1 text-white rounded-r text-sm absolute top-3">Dipinjam
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            @if ($dipinjam == false)
                                @if ($book->stok == 0)
                                    <div class="bg-zinc-800 p-3 py-1 text-white rounded-r text-sm absolute top-3">Tidak Tersedia
                                    </div>
                                @else
                                    <div class="bg-green-600 p-3 py-1 text-white rounded-r text-sm absolute top-3">Tersedia</div>
                                @endif
                            @endif
                            <img src="{{ asset('storage/' . $book->image) }}" alt="gusdur" class="w-full h-96 object-cover rounded">
                            <h1 class="mt-2 font-bold text-lg text-gray-700 truncate group-hover:truncate-none peer">
                                {{ $book->title }}</h1>
                            <div
                                class="p-2 absolute bg-white shadow-lg border border border-slate-300 rounded right-0 left-0 transition-all duration-300 z-[-10] peer-hover:z-10 opacity-0 translate-y-5 peer-hover:translate-y-0 peer-hover:opacity-100 hover:translate-y-0 hover:opacity-100 hover:z-10">
                                {{ $book->title }}</div>
                            <div class="text-sm flex text-gray-700 items-center font-medium">
                                <i data-feather="edit-3" width="16px"></i>
                                <span class="ml-2">{{ $book->penulis }}</span>
                            </div>
                            <div class="text-sm flex text-gray-700 items-center font-medium">
                                <i data-feather="calendar" width="16px"></i>
                                <span class="ml-2">Maret 20, 2022</span>
                            </div>
                            <div class="text-sm flex text-gray-700 items-center font-medium">
                                <i data-feather="layers" width="16px"></i>
                                <span class="ml-2">200 Pages</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
