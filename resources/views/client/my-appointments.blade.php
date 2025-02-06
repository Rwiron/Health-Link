@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-2xl font-bold text-gray-900 dark:text-white">My Appointments</h5>
            </div>
            <div class="flex items-center gap-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('client.hospitals.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                                Hospitals
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400 mx-1"></i>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">My Appointments</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <a href="{{ route('client.hospitals.index') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i data-lucide="calendar-plus" class="w-4 h-4 mr-2"></i>
                    New Appointment
                </a>
            </div>
        </div>

        @if(session('success'))
        <div id="success-alert" class="flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <i data-lucide="check-circle" class="flex-shrink-0 inline w-5 h-5 mr-3"></i>
            <span class="sr-only">Success</span>
            <div>
                {{ session('success') }}
            </div>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);

        </script>
        @endif

        @if($appointments->isEmpty())
        <div class="flex flex-col items-center justify-center p-12 bg-white rounded-lg shadow dark:bg-gray-800">
            <i data-lucide="calendar-x" class="w-20 h-20 text-gray-400 mb-4"></i>
            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">No Appointments Found</h3>
            <p class="mb-6 text-gray-500 dark:text-gray-400">You haven't booked any appointments yet.</p>
            <a href="{{ route('client.hospitals.index') }}" class="inline-flex items-center px-5 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Book Your First Appointment
            </a>
        </div>
        @else
        <div class="bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="p-6">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4">Hospital</th>
                                <th scope="col" class="px-6 py-4">Doctor</th>
                                <th scope="col" class="px-6 py-4">Service</th>
                                <th scope="col" class="px-6 py-4">Insurance</th>
                                <th scope="col" class="px-6 py-4">Insurance Document</th>
                                <th scope="col" class="px-6 py-4">Date</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $appointment->hospital->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 mr-3 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i data-lucide="user" class="w-4 h-4 text-gray-600"></i>
                                        </div>
                                        {{ $appointment->doctor->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <i data-lucide="stethoscope" class="w-4 h-4 mr-2 text-gray-400"></i>
                                        {{ $appointment->service->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($appointment->insurance)
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <i data-lucide="shield-check" class="w-4 h-4 mr-1"></i>
                                        {{ $appointment->insurance->name }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        <i data-lucide="shield-off" class="w-4 h-4 mr-1"></i>
                                        Not Covered
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <!-- NEW: Insurance Document Column -->
                                    @if($appointment->insurance_document && $appointment->insurance_document !== 'None')
                                    <a href="{{ asset('storage/' . $appointment->insurance_document) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                                        <i data-lucide="file" class="w-4 h-4 mr-1"></i>
                                        View Document
                                    </a>
                                    @else
                                    <span class="text-gray-500 dark:text-gray-300">None</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-400"></i>
                                        {{ \Carbon\Carbon::parse($appointment->booking_date)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full
                                        @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                        @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                        @elseif($appointment->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <!-- Cancel Button -->
                                    <form action="{{ route('client.bookings.cancel', $appointment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition-colors duration-200 ease-in-out dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                            <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                            Cancel
                                        </button>
                                    </form>

                                    <!-- Print Receipt Button (Only if Confirmed) -->
                                    @if($appointment->status == 'confirmed')
                                    <a href="{{ route('receipt.print', $appointment->id) }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-custom-500 rounded-lg shadow-sm hover:bg-custom-600 focus:outline-none focus:ring-2 focus:ring-custom-400 focus:ring-offset-2 transition-colors duration-200 ease-in-out dark:bg-custom-600 dark:hover:bg-custom-700 dark:focus:ring-custom-500 dark:focus:ring-offset-gray-800">
                                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                        Print Receipt
                                    </a>
                                    @endif
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
