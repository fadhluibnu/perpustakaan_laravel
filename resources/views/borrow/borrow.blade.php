@extends('layouts.main')

@section('contentAdmin')
    <div class="p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800 mb-3">Data Category</h1>
            <form action="" method="post" class="inline-block w-5/12 flex justify-end">
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
            </form>
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
                                        <input type="text" name="book_id" value="{{ $borrow->book_id }}" hidden>
                                        <input type="text" name="status" value="dikembalikan" hidden>
                                        <button type="submit" class="transition-all duration-500 bg-gradient-to-br from-red-400 to-red-500 px-4 py-2 rounded-lg ml-2 font-medium text-sm text-white shadow-lg focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:shadow-none shadow-red-100"  onclick="return confirm('Konfirmasi Pengembalian Buku')">Kembalikan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @foreach ($categories as $category)
                            <tr>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $category->name }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $category->books->count() }}
                                </td>
                                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                    <a href="{{ route('category.edit', $category->slug) }}" type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 no-underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        class="inline">
                                        @method('delete')
                                        @csrf
                                        <button
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 no-underline"
                                            id="deletePost"
                                            onclick="return confirm('Are you sure you want to delete this?');"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
