@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <section class="content-header">
            <div class="container mx-auto px-4">
                <div class="mb-4">
                    <h1 class="text-3xl font-semibold">Dashboard</h1>
                </div>
            </div>
        </section>

        <div class="content px-4">
            <div class="bg-black shadow rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Box 1 with Tailwind Styles Applied -->
                    <a href="#" class="block max-w-sm p-6 bg-gray-500 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">72.791</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Total Kuota Tahunan Tahun 2024</p>
                        <span class="mt-4 text-blue-500 flex items-center">
                            Detail <i class="fas fa-arrow-circle-right ml-2"></i>
                        </span>
                    </a>

                </div>

                <!-- Additional Rows -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                    <a href="#" class="block max-w-sm p-6 bg-gray-500 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">0</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Total Permohonan Rekomendasi Ekspor</p>
                        <span class="mt-4 text-blue-500 flex items-center">
                            Detail <i class="fas fa-arrow-circle-right ml-2"></i>
                        </span>
                    </a>

                    <a href="#" class="block max-w-sm p-6 bg-grey-500 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">0</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Total Rekomendasi Ekspor</p>
                        <span class="mt-4 text-blue-500 flex items-center">
                            Detail <i class="fas fa-arrow-circle-right ml-2"></i>
                        </span>
                    </a>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
          @csrf
            <button type="submit" class="btn btn-info">Logout</button>
            </form>
        </div>
    </section>
</div>
@endsection
