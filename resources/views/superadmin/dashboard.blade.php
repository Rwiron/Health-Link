@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <!-- Header -->
            <div class="flex flex-col gap-2 py-6 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-2xl font-semibold text-gray-800 dark:text-white">Dashboard Overview</h5>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Welcome back, Super Admin</p>
                </div>
                <ul class="flex items-center gap-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                    <li class="hover:text-primary-500 transition-colors">
                        <a href="#!">Dashboard</a>
                    </li>
                    <li class="text-gray-300 dark:text-gray-600 mx-1">/</li>
                    <li class="text-primary-500 dark:text-primary-400">
                        Overview
                    </li>
                </ul>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- Total Hospitals Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Hospitals</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total_hospitals }}</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-blue-400 to-blue-600">
                            <i data-lucide="building" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-blue-600 dark:text-blue-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">12%</span> from last month
                    </div>
                </div>

                <!-- Total Doctors Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Doctors</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total_doctors }}</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-green-400 to-green-600">
                            <i data-lucide="stethoscope" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-green-600 dark:text-green-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">8%</span> from last month
                    </div>
                </div>

                <!-- Total Patients Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Patients</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total_patients }}</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-purple-400 to-purple-600">
                            <i data-lucide="users" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-purple-600 dark:text-purple-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">15%</span> from last month
                    </div>
                </div>

                <!-- Total Bookings Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-amber-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Bookings</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total_bookings }}</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-amber-400 to-amber-600">
                            <i data-lucide="calendar" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-amber-600 dark:text-amber-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">23%</span> from last month
                    </div>
                </div>

                <!-- Total Insurance Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-amber-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Insurance</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total_insurance }}</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-amber-400 to-amber-600">
                            <i data-lucide="shield" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-amber-600 dark:text-amber-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">23%</span> from last month
                    </div>
                </div>

                <!-- Total Payments Card without insurance -->
                {{-- <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Payments without insurance</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($total_amount, 2) }} FRW</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600">
                            <i data-lucide="credit-card" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">18%</span> from last month
                    </div>
                </div> --}}


                <!-- Total Payments Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Total Payments</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($total_payments, 2) }} FRW</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600">
                            <i data-lucide="credit-card" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">18%</span> from last month
                    </div>
                </div>

                <!-- Total Discounts Card -->
                {{-- <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-rose-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Insurance Coverage</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($total_discounts, 2) }} FRW</h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-rose-400 to-rose-600">
                            <i data-lucide="tag" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-rose-600 dark:text-rose-400">
                        <i data-lucide="trending-down" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">5%</span> from last month
                    </div>
                </div> --}}

                <!-- Net Revenue Card -->
                {{-- <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg hover:shadow-2xl hover:-translate-y-1 transform transition duration-300 cursor-pointer border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-300 mb-2">Net Revenue</p>
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">
                                {{ number_format($total_payments - $total_discounts, 2) }} FRW
                            </h2>
                        </div>
                        <div class="flex items-center justify-center p-3 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600">
                            <i data-lucide="wallet" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-sm flex items-center text-indigo-600 dark:text-indigo-400">
                        <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                        <span class="mr-1">12%</span> from last month
                    </div>
                </div> --}}
            </div>



            <!-- Recent Bookings & Pending Bookings -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Recent Bookings -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                        <h6 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Appointments</h6>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Patient</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Hospital</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Service</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($recent_bookings as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-5 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $booking->user->name }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $booking->hospital->name }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $booking->service->name }}</td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500' :
                                               ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500' :
                                               'bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pending Bookings -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                        <h6 class="text-lg font-semibold text-gray-800 dark:text-white">Pending Appointments</h6>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Patient</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Doctor</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Service</th>
                                    <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($pending_bookings as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-5 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $booking->user->name }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $booking->doctor->name }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $booking->service->name }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        <div class="flex items-center">
                                            <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-400"></i>
                                            {{ $booking->booking_date }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Feedback -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h6 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Feedback</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Name</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Message</th>
                                <th class="px-5 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Replies</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($recent_feedback as $feedback)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-5 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $feedback->name }}</td>
                                <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $feedback->email }}</td>
                                <td class="px-5 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <i data-lucide="message-circle" class="w-4 h-4 mr-2 text-gray-400"></i>
                                        {{ Str::limit($feedback->message, 50) }}
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                            {{ $feedback->replies->count() }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
