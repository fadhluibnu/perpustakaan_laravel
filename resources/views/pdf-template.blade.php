<!DOCTYPE html>
<html lang="idn" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style> --}}
    <title>PDF</title>
</head>

<body class="w-full h-screen overflow-hidden">

    <div class="p-8">
        <div class="p-5 bg-white rounded-lg">
            <div class="grid grid-cols-3 gap-4 p-4">
                {{-- <p>{{ $borrow['id'] }}</p> --}}
                <img src="{{ 'storage/' . $borrow['image'] }}" alt="image" class="object-cover">
                <div>
                    <div class="mb-2">
                        <h1 class="font-semibold text-gray-800 text-lg">Judul</h1>
                        <p class="text-gray-800 text-base">{{$borrow['title']}}</p>
                    </div>
                    <div class="mb-2">
                        <h1 class="font-semibold text-gray-800 text-lg">Kode Buku</h1>
                        <p class="text-gray-800 text-base">{{$borrow['kode']}}</p>
                    </div>
                    <div class="mb-2">
                        <h1 class="font-semibold text-gray-800 text-lg">Peminjam</h1>
                        <p class="text-gray-800 text-base">{{$borrow['peminjam']}}</p>
                    </div>
                    <div class="mb-2">
                        <h1 class="font-semibold text-gray-800 text-lg">Dipinjam</h1>
                        <p class="text-gray-800 text-base bg-gradient-to-br from-green-500 to-green-600 inline-block text-white p-1 px-2 rounded mt-px">{{$borrow['created_at']->setTimezone('Asia/Jakarta')->format('d M Y')}}</p>
                    </div>
                    <div class="mb-2">
                        <h1 class="font-semibold text-gray-800 text-lg">Dikembalikan</h1>
                        @if ($borrow['status'] == 'meminjam')
                            <p class="text-gray-800 text-base bg-gradient-to-br from-red-500 to-red-600 inline-block text-white p-1 px-2 rounded mt-px">Belum dikembalikan</p>
                        @else
                            <p class="text-gray-800 text-base bg-gradient-to-br from-green-500 to-green-600 inline-block text-white p-1 px-2 rounded mt-px">{{$borrow['updated_at']->setTimezone('Asia/Jakarta')->format('d M Y')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

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