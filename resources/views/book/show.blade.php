@extends('layouts.main')

@section('content')
    <div class="p-4 h-full">
        <div class="w-full bg-white rounded-lg p-3">
            <div class="flex">
                <a href="{{ route('books.index') }}" class="text-sm font-medium text-blue-500 flex items-center">
                    <i data-feather="arrow-left" class="w-5 h-5 text-sky-600"></i>
                    <span class="ml-2 text-sky-600">Detail Buku</span>
                </a>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-3 relative">
                <div class="flex flex-col items-center sticky top-0">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                        class="w-full h-96 object-cover rounded-lg shadow-lg">
                    <form action="{{ route('borrow.store') }}" method="post" class="w-full">
                        @csrf
                        <input type="text" name="user_id" id="" value="{{ auth()->user()->id }}" hidden>
                        <input type="text" name="book_id" id="" value="{{ $book->id }}" hidden>
                        <input type="text" name="kode_peminjaman"
                            value="{{ date('d') . auth()->user()->id . $book->kode_buku }}" hidden>
                        <input type="text" name="status" value="meminjam" hidden>
                        <button type="submit"
                            class="w-full mt-3 transition-all duration-500 enabled:bg-gradient-to-br enabled:from-blue-400 enabled:to-blue-600 rounded-lg text-white font-medium p-4 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-center hover:bg-blue-600 text-sm shadow-lg hover:shadow-xl shadow-blue-200 hover:shadow-blue-200 focus:shadow-none disabled:shadow-none disabled:bg-slate-700 disabled:cursor-not-allowed"
                            @if ($book->stok == 0) 
                                @disabled(true) 
                            @elseif ($book->borrow->isNotEmpty()) 
                                @foreach ($book->borrow->where('status', 'meminjam') as $borrow)
                                    @if ($book->stok == 0 || $borrow->user_id == auth()->user()->id)
                                        @disabled(true) 
                                    @endif
                                @endforeach
                            @endif>Pinjam
                        </button>
                    </form>
                    <p class="text-slate-700 mt-2 text-sm font-medium">Jumlah Buku : {{ $book->stok }}</p>
                </div>
                <div class="col-span-3">
                    <h1 class="text-3xl font-semibold text-slate-800">{{ $book->title }}</h1>
                    <h2 class="text-base font-medium mt-2 text-slate-700">
                        {{ $book->penulis }} - {{ $book->penerbit }}
                    </h2>
                    <div class="flex items-center">
                        <div class="flex relative @if ($book->histories->isNotEmpty()) ml-2 @endif mt-2 items-center">
                            @if ($book->histories)
                                @if ($book->histories->isNotEmpty())
                                    @foreach ($book->histories->unique('user_id') as $history)
                                        <img src="{{ asset('storage/' . $history->user->image) }}"
                                            alt="{{ $history->user->name }}"
                                            class="w-10 h-10 overflow-hidden rounded-full object-cover border border-white relative -ml-3">
                                    @endforeach
                                @endif
                                <span
                                    class="text-slate-700 @if ($book->histories->isNotEmpty()) ml-2 @else mr-2 @endif">{{ $book->histories->count() }}
                                    people have read</span>
                            @endif
                        </div>
                        <div class="flex mt-2 @if ($book->histories->isNotEmpty()) ml-2 @endif">
                            <h2 class="text-slate-700">| Kategori :</h2>
                            <a href="{{ route('category.show', $book->category->slug) }}"
                                class="text-slate-700 ml-1 underline decoration-double decoration-blue-600">{{ $book->category->name }}</a>
                        </div>
                    </div>
                    <p class="text-base text-slate-700 mt-2">{{ $book->description }}</p>
                </div>
            </div>
            {{-- <div class="flex mt-4 justify-between"> --}}
            {{-- <div class="w-1/4">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                        class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                <div class="w-3/4">
                    <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
                </div> --}}
            {{-- <div class="w-2/5 rounded overflow-hidden">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                        class="w-full object-cover rounded-lg shadow-lg">
                </div>
                <div class="w-3/5 p-5 pt-0">
                    <div class="p-5 rounded-lg shadow-lg">
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Judul</h1>
                            <p class="mb-0">{{ $book->title }}</p>
                        </div>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Penulis</h1>
                            <p class="mb-0">{{ $book->penulis }}</p>
                        </div>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Penerbit</h1>
                            <p class="mb-0">{{ $book->penerbit }}</p>
                        </div>
                        <a href="#" class="bg-white p-5 py-3 shadow rounded relative mb-6 inline-block w-full">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Kategori</h1>
                            <div class="flex justify-between items-center">
                                <p class="mb-0">{{ $book->category->name }}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </div>
                        </a>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Tahun Terbit</h1>
                            <p class="mb-0">{{ $book->thn_terbit }}</p>
                        </div>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Jumlah Buku</h1>
                            <p class="mb-0">{{ $book->stok }}</p>
                        </div>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Status Buku</h1>
                            <p class="mb-0">{{ $book->status }}</p>
                        </div>
                        <div class="bg-white p-5 py-3 shadow rounded relative mb-6">
                            <h1 class="font-semibold absolute -top-3.5 text-slate-800 bg-white text-base">Description</h1>
                            <p class="mb-0">{{ $book->description }}</p>
                        </div>

                        <button type="submit"
                            class="w-full transition-all duration-500 bg-blue-500 rounded-lg text-white font-medium px-5 py-2.5 focus:ring-2
                            focus:ring-blue-500 focus:ring-offset-2 text-center hover:bg-blue-600 text-sm">Pinjam
                        </button>
                    </div>
                </div> --}}
            {{-- </div> --}}
        </div>
    </div>
@endsection
