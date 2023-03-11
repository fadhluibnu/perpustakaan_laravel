<!DOCTYPE html>
<html lang="idn" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>{{ $title }} - iLibrary</title>
</head>

<body class="w-full h-screen overflow-hidden">

    {{-- {{ Request::is("/login") ? }} --}}
    @if (Request::is('login') || Request::is('register'))
        @yield('content')
    @else
        <div class="flex">
            @include('layouts.sidebar')
            <!-- shadow-sm border-slate-300 focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-sky-200 focus:border-sky-500 focus:ring-sky-500 rounded-full placeholder-slate-400 -->
            <div
                class="{{ auth()->user()->role != 'admin' && Request::is('books') ? 'w-[50rem]' : 'w-5/6' }} bg-slate-50/[0.1] h-screen overflow-y-auto">
                @if (Request::is('category') || Request::is('books'))
                    <div class="flex p-2 items-center">
                        <div
                            class="flex items-center bg-white p-3 py-1 rounded-full shadow-sm focus:border-2 focus:border-sky-50 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 stroke-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="search" class="peer px-3 py-2 bg-white w-full outline-0 border-0 ">
                        </div>
                        <div
                            class="flex p-3 px-4 rounded-full bg-white shadow-sm text-sm items-center ml-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <span class="ml-2 font-medium">27/01/2022</span>
                        </div>
                    </div>
                @endif
                @can('isUser')
                    @yield('content')
                @endcan
                @can('isAdmin')
                    @yield('contentAdmin')
                @endcan
            </div>
            @can('isUser')
                {{-- w-2/6  --}}
                @if (Request::is(route('books.index', '*')))
                    <div class="w-[30rem] bg-white h-screen">
                    </div>
                @endif
            @endcan
        </div>
    @endif
    {{-- {{ : null }} --}}
    <!-- <div class="flex bg-slate-900">
        <div class="w-1/5 flex">
            <div class=" transition flex p-3 items-center duration-300">
                <img src="logo.png" alt="Logo" width="30" height="30" style="object-fit: contain;">
                <p class="m-0 font-bold text-2xl tracking-wide ml-3 text-white">iLibrary</p>
            </div>
        </div>
        <div class="w-4/5">
            <div class="flex w-full items-center justify-between p-3 mb-2 backdrop-blur-lg z-50">
                <h1 class="m-0 text-2xl font-bold text-white tracking-wide">Dashboard</h1>
                <div>
                    <div
                        class="p-2 border-2 border-white-400 rounded-full transition-all  duration-300 text-white hover:border-transparent bg-gradient-to-br from-transparent to-transparent hover:bg-gradient-to-br hover:from-blue-400 hover:to-blue-500">
                        <div class="h-6 w-6 flex">
                            <i data-feather="search" width="16px" class="m-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/5 h-screen bg-blue-50/30">
            <div class="p-4">
                <div class="menu">
                    <p class="m-0 text-base font-medium text-slate-400">MENU</p>
                    <ul class="list-none list-inside mt-3">
                        <li>
                            <a href=""
                                class="transition-all flex no-underline text-white items-center	p-3 bg-gradient-to-br from-blue-400 to-blue-500 shadow-xl shadow-blue-500/30 rounded-xl duration-300 hover:from-blue-400 hover:to-blue-400">
                                <i data-feather="home" width="20px" stroke-width="2.5"></i>
                                <p class="ml-2 font-semibold">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="" class="flex no-underline text-gray-500 items-center p-3 rounded-lg">
                                <i data-feather="briefcase" width="20px" stroke-width="2.5"></i>
                                <p class="ml-2 font-semibold">Borrowed</p>
                            </a>
                        </li>
                        <li>
                            <a href="" class="flex no-underline text-gray-500 items-center p-3 rounded-lg">
                                <i data-feather="user" width="20px" stroke-width="2.5"></i>
                                <p class="ml-2 font-semibold">My Account</p>
                            </a>
                        </li>
                    </ul>
                    <p class="m-0 text-base font-medium text-slate-400 mt-6">SETTING</p>
                    <ul class="list-none list-inside mt-3">
                        <li>
                            <a href="" class="flex no-underline text-gray-500 items-center p-3 rounded-lg">
                                <i data-feather="user" width="20px" stroke-width="2.5"></i>
                                <p class="ml-2 font-semibold">My Account</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-4/5 h-screen bg-white py-0 overflow-scroll">
            <div class="p-5">
                <h1 class="text-lg font-semibold text-gray-800 mb-3">Library Collection</h1>
                <div class="grid grid-cols-5 gap-10">
                    <div class="transition rounded-md hover:scale-95 duration-300">
                        <img src="/gusdur.jpg" alt="gusdur" width="100%" height="325" style="object-fit: cover;"
                            class="rounded">
                        <h1 class="mt-2 font-bold text-lg text-gray-800">Gur Dur</h1>
                        <div class="text-sm flex text-gray-700 items-center font-semibold">
                            <i data-feather="edit-3" width="16px"></i>
                            <span class="ml-2">Greg Barton</span>
                        </div>
                        <div class="text-sm flex text-gray-700 items-center font-semibold">
                            <i data-feather="calendar" width="16px"></i>
                            <span class="ml-2">Maret 20, 2022 </span>
                        </div>
                        <div class="text-sm flex text-gray-700 items-center font-semibold">
                            <i data-feather="layers" width="16px"></i>
                            <span class="ml-2">200 Pages</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        const clsNotif = document.querySelector('#btn-notif');
        const notif = document.querySelector('#hilangkan');

        clsNotif.onclick = function() {
            notif.classList.add("hidden");
        }
    </script>+
</body>

</html>
