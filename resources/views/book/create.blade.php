@extends('layouts.main')

@section('contentAdmin')
    <form action="{{ route('books.store') }}" method="POST" class="p-4 w-full" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-xl overflow-hidden w-3/4 ">
            <div class="p-3 bg-blue-500">
                <a href="{{ route('books.index') }}" class="text-sm font-medium text-blue-500 flex items-center">
                    <i data-feather="arrow-left" class="w-5 h-5 text-white"></i>
                    <span class="ml-2 text-white">Add a new book</span>
                </a>
            </div>
            <div class="w-full p-3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">Judul</label>
                        <input type="text" name="title" id="judul"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"
                            placeholder="Kisah Nyata" required>
                    </div>
                    <div>
                        <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900">Penulis</label>
                        <input type="text" name="penulis" id="penulis"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"
                            placeholder="Kisah Nyata" required>
                    </div>
                    <div>
                        <label for="penerbit" class="block mb-2 text-sm font-medium text-gray-900">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"
                            placeholder="Kisah Nyata" required>
                    </div>
                    <div>
                        <label for="Jumlah Buku" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Buku</label>
                        <input type="text" name="stok" id="Jumlah Buku"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"
                            placeholder="Kisah Nyata" required>
                    </div>
                    <div class="">
                        <label for="Category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                        <select name="category_id" id="category"
                            class="w-full bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="thn_terbit" class="block mb-2 text-sm font-medium text-gray-900">Tahun Terbit</label>
                        <input type="date" name="thn_terbit" id="thn_terbit"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"
                            placeholder="Kisah Nyata" required>
                    </div>
                    <div>
                        <label for="desc" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea name="description" id="desc" cols="30" rows="10"
                            class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-offset-1 focus:ring-2 focus:ring-blue-500 focus:border-white block w-full p-2.5"></textarea>
                    </div>
                    <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input type="file"
                            class="block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-gray-50 file:text-blue-500
                          hover:file:bg-violet-100
                        "
                            onchange="showPreview(event)" name="image" />
                        <img id="file-ip-1-preview" class="rounded-lg mt-3">
                    </label>
                </div>
                <button class="bg-blue-600 mt-3 rounded-lg text-white font-medium p-3 text-sm">Submit</button>
            </div>
        </div>
    </form>
@endsection
