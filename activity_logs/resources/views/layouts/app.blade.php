<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Activity-Logs') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- bootstrap5 dataTables css cdn -->
    <link rel="stylesheet" href="{{ asset('datatables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css') }}"/>


        {{-- custom ones --}}
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

         <script src="{{ asset('datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "scrollX": true
            });

        });
        </script>
    </body>
</html>
