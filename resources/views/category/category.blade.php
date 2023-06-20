@extends('layouts.main')

@section('content')
    <div class="p-4">
        <h1 class="text-lg font-semibold text-gray-800 mb-3">All Collection</h1>
        @if ($categories->isEmpty())
            <p class="text-sm ">Tidak terdapat category</p>
        @endif
        <div class="grid grid-cols-3 gap-10 mb-8">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="bg-white rounded-lg overflow-hidden relative">
                    <img src="{{ asset('storage/' . $category->image) }}" alt=""
                        class="h-32 w-full rounded-lg object-cover">
                    <div
                        class="bg-gradient-to-b from-zinc-600/[0.6] to-zinc-800/[0.8] top-0 bottom-0 left-0 right-0 absolute flex transition-all duration-300 backdrop-blur-none hover:backdrop-blur-sm hover:backdrop-brightness-150">
                        <div class="m-auto">
                            <h1 class="text-white font-semibold">{{ $category->name }}</h1>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @foreach ($categories as $category)
            <h1 class="font-semibold text-lg mb-3">{{ $category->name }}</h1>
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
        @endforeach
    </div>
@endsection
@section('contentAdmin')
    <div class="p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800 mb-3">Data Category</h1>
            <a href="{{ route('category.create') }}"
                class="transition-all duration-500 bg-blue-500 rounded-lg text-white font-medium px-5 py-2.5 focus:ring-2
                focus:ring-blue-500 focus:ring-offset-2 text-center hover:bg-blue-600 text-sm">Tambah
                Category</a>
        </div>
        <div class="mt-6">
            <div class="overflow-auto rounded-lg shadow hidden lg:block w-full mt-5 md:mt-0 md:col-span-2">
                <table class="table-auto w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="w-6 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                            <th class="w-44 p-3 text-sm font-semibold tracking-wide text-left">Name</th>
                            <th class="w-28 p-3 text-sm font-semibold tracking-wide text-left">Jumlah Buku</th>
                            <th class="w-8 p-3 text-sm font-semibold tracking-wide text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if ($categories->isEmpty())
                        <tr>
                            <td colspan="7">
                                <p class="text-sm p-5">Tidak terdapat category</p>
                            </td>
                        </tr>
                        @endif
                        @foreach ($categories as $category)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
