<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB SMP NEGERI 1 PIRIME')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('layouts.partials.public-navbar')

    <main class="p-4 sm:p-6 lg:p-8">
        @yield('content')
    </main>

    @include('layouts.partials.public-footer')

    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }

        function swalWIP() {
            if (typeof Swal === 'undefined') return;
            Swal.fire({
                icon: 'info',
                title: 'Informasi Prototype',
                text: 'Sesuai batasan prototype, halaman ini disimulasikan.',
                confirmButtonText: 'Mengerti'
            });
        }

        function demoSuccess() {
            if (typeof Swal === 'undefined') return;
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Informasi pengguna berhasil disinkronkan.',
                confirmButtonText: 'OK'
            });
        }
    </script>

    @stack('scripts')
</body>

</html>
