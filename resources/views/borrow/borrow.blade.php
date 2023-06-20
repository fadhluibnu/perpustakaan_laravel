@extends('layouts.main')

@section('content')
    <div class="grid grid-cols-3 gap-4 p-4">
        @if ($borrows->isEmpty())
            <p class="text-sm ">Tidak ada peminjaman</p>
        @endif
        @foreach ($borrows as $borrow)
            <div class="bg-white rounded-lg">
                <a href="{{ route('books.show', $borrow->book->slug) }}">
                    <div class="grid grid-cols-3 gap-4 p-4">
                        <img src="{{ asset('storage/' . $borrow->book->image) }}" alt="{{ $borrow->book->title }}"
                            class="object-cover h-40 rounded-lg shadow">
                        <div class="col-span-2">
                            <div class="mb-2">
                                <h1 class="font-semibold text-gray-800 text-sm">Judul</h1>
                                <p class="text-gray-800 text-sm">{{ $borrow->book->title }}</p>
                            </div>
                            <div class="mb-2">
                                <h1 class="font-semibold text-gray-800 text-sm">Dipinjam</h1>
                                <p
                                    class="text-gray-800 text-sm bg-gradient-to-br from-green-500 to-green-600 inline-block text-white p-1 px-2 rounded mt-px">
                                    {{ $borrow->created_at->setTimezone('Asia/Jakarta')->format('d M Y') }}</p>
                            </div>
                            <div class="mb-2">
                                <h1 class="font-semibold text-gray-800 text-sm">Dikembalikan</h1>
                                @if ($borrow->status == 'meminjam')
                                    <p
                                        class="text-gray-800 text-sm bg-gradient-to-br from-red-500 to-red-600 inline-block text-white p-1 px-2 rounded mt-px">
                                        Belum dikembalikan</p>
                                @else
                                    <p
                                        class="text-gray-800 text-sm bg-gradient-to-br from-green-500 to-green-600 inline-block text-white p-1 px-2 rounded mt-px">
                                        {{ $borrow->updated_at->setTimezone('Asia/Jakarta')->format('d M Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                <div class="p-4">
                    <a href="/generate-pdf/{{ $borrow->id }}" class="w-full bg-blue-600 mt-1 rounded-lg text-white font-medium p-3 text-sm inline-block text-center">Export to PDF</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('contentAdmin')
    <div class="p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800 mb-3">Data Peminjaman</h1>
            {{-- <form action="" method="post" class="inline-block w-5/12 flex justify-end">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 stroke-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input
                        class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm w-full"
                        placeholder="Cari kode peminjaman ..." type="text" name="search" />
                </label>
                <button type="button"
                    class="transition-all duration-500 bg-gradient-to-br from-blue-400 to-blue-500 px-4 rounded-lg ml-2 font-medium text-sm text-white shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:shadow-none shadow-blue-100">Search</button>
            </form> --}}
        </div>
        <div class="mt-6">
            <div class="overflow-auto rounded-lg shadow hidden lg:block w-full mt-5 md:mt-0 md:col-span-2">
                <table class="table-auto w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">#</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Kode Peminjaman</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Judul Buku</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Peminjam</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Tgl Pinjam</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if ($borrows->isEmpty())
                            <tr>
                                <td colspan="6">
                                    <p class="text-sm p-5">Tidak terdapat perminjaman</p>
                                </td>
                            </tr>
                        @endif
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $borrow->kode_peminjaman }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $borrow->book->title }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $borrow->user->name }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $borrow->created_at->format('d M Y') }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <form action="{{ route('borrow.update', $borrow->kode_peminjaman) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $borrow->book_id }}">
                                        <input type="hidden" name="status" value="dikembalikan">
                                        <button type="submit"
                                            class="transition-all duration-500 enabled:bg-gradient-to-br enabled:from-red-400 enabled:to-red-500 px-4 py-2 rounded-lg ml-2 font-medium text-sm enabled:text-white disabled:text-slate-800 shadow-lg focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:shadow-none shadow-red-100 disabled:shadow-none disabled:bg-slate-300 disabled:cursor-not-allowed"
                                            onclick="return confirm('Konfirmasi Pengembalian Buku')"
                                            @if ($borrow->status == 'dikembalikan') @disabled(true) @endif>Kembalikan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
