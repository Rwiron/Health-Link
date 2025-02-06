@php
use Carbon\Carbon;
@endphp

@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <!-- Header -->
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Doctor's Dashboard</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Appointments
                    </li>
                </ul>
            </div>

            <div class="relative col-span-12 overflow-hidden card 2xl:col-span-8 bg-slate-900">
                <div class="absolute inset-0">

                    <svg xmlns="http://www.w3.org/2000/svg" class="size-100" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="1440" height="560" preserveaspectratio="none" viewbox="0 0 1440 560">
                        <g mask="url(&quot;#SvgjsMask1000&quot;)" fill="none">
                            <use xlink:href="#SvgjsSymbol1007" x="0" y="0"></use>
                            <use xlink:href="#SvgjsSymbol1007" x="720" y="0"></use>
                        </g>
                        <defs>
                            <mask id="SvgjsMask1000">
                                <rect width="1440" height="560" fill="#ffffff"></rect>
                            </mask>
                            <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                            <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                            <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                            <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                            <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                            <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                        </defs>
                        <symbol id="SvgjsSymbol1007">
                            <use xlink:href="#SvgjsPath1001" x="30" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="30" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="30" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="30" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="30" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="30" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="30" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="30" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="30" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="30" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="90" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1004" x="90" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="90" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="90" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="90" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="150" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="150" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="150" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="150" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="150" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="150" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                            </use>
                            <use xlink:href="#SvgjsPath1004" x="150" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="150" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="150" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="150" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="210" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="210" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="210" y="150" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                            </use>
                            <use xlink:href="#SvgjsPath1002" x="210" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="210" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="210" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="210" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="210" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="210" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1003" x="210" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="270" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="270" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="270" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="270" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="270" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="270" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="270" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1002" x="270" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="270" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="270" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="330" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="330" y="90" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1002" x="330" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="330" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="330" y="270" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1001" x="330" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="330" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="330" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="330" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="330" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1004" x="390" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="390" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="390" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="390" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="390" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="390" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="390" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="390" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="390" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="390" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1004" x="450" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="450" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="450" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="450" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="450" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="510" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="510" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="510" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="510" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="510" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1004" x="510" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="510" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1001" x="510" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="510" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="510" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="570" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="570" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="570" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="570" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="570" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="570" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="570" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1005" x="570" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="570" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="570" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="630" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="630" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="630" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="630" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="630" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="630" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1002" x="630" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="630" y="450" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1001" x="630" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="630" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="690" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="690" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="690" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1002" x="690" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1005" x="690" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1001" x="690" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="690" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1003" x="690" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                            <use xlink:href="#SvgjsPath1006" x="690" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                            <use xlink:href="#SvgjsPath1003" x="690" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        </symbol>
                    </svg>
                </div>
                <div class="relative card-body">
                    <div class="grid items-center grid-cols-12">
                        <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                            <h5 class="mb-3 font-normal tracking-wide text-slate-200"> Welcome, Doctor
                                {{ Auth::check() ? Auth::user()->name : 'Guest' }} 🎉
                            </h5>
                            <p class="mb-5 text-slate-400">Health Link empowers doctors to manage appointments, communicate with patients, and keep track of schedules effortlessly. Enhance patient care and streamline your workflow with our user-friendly tools.</p>
                            {{-- <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20 dark:ring-custom-400/20">Start Now</button> --}}


                        </div>
                        <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                            <img src="{{ asset('assets/images/doctor.svg') }}" alt="" class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 mb-4">
                <!-- Total Patients Card -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Patients</p>
                                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $patientsCount }}</h2>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-lg dark:bg-blue-500/20">
                                <i data-lucide="users" class="w-8 h-8 text-blue-600 dark:text-blue-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-500">
                            <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
                            <span>Active patients</span>
                        </div>
                    </div>
                </div>

                <!-- Total Appointments Card -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Appointments</p>
                                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $appointmentsCount }}</h2>
                            </div>
                            <div class="p-3 bg-green-100 rounded-lg dark:bg-green-500/20">
                                <i data-lucide="calendar" class="w-8 h-8 text-green-600 dark:text-green-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-500">
                            <i data-lucide="calendar-check" class="w-4 h-4 mr-1"></i>
                            <span>All time bookings</span>
                        </div>
                    </div>
                </div>

                <!-- Confirmed Appointments Card -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Confirmed</p>
                                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $acceptedAppointmentsCount }}</h2>
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-lg dark:bg-yellow-500/20">
                                <i data-lucide="check-circle" class="w-8 h-8 text-yellow-600 dark:text-yellow-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-yellow-500">
                            <i data-lucide="check" class="w-4 h-4 mr-1"></i>
                            <span>Confirmed bookings</span>
                        </div>
                    </div>
                </div>

                <!-- Pending Appointments Card -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending</p>
                                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $pendingAppointmentsCount }}</h2>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-lg dark:bg-purple-500/20">
                                <i data-lucide="clock" class="w-8 h-8 text-purple-600 dark:text-purple-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-purple-500">
                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                            <span>Awaiting confirmation</span>
                        </div>
                    </div>
                </div>

                <!-- Cancelled Appointments Card -->
                <div class="relative overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Cancelled</p>
                                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $cancelledAppointmentsCount }}</h2>
                            </div>
                            <div class="p-3 bg-red-100 rounded-lg dark:bg-red-500/20">
                                <i data-lucide="x-circle" class="w-8 h-8 text-red-600 dark:text-red-500"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-red-500">
                            <i data-lucide="x" class="w-4 h-4 mr-1"></i>
                            <span>Cancelled bookings</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments Card -->
            <div class="card" id="appointmentsTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Latest Appointments ({{ $latestAppointments->count() }})</h6>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Patient</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Service</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Insurance</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Total Cost</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestAppointments as $appointment)
                                <tr>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex items-center">
                                            <div class="size-10 mr-3 rounded-full bg-slate-100 flex items-center justify-center">
                                                <i data-lucide="user" class="size-5 text-slate-500"></i>
                                            </div>
                                            <span class="font-medium">{{ $appointment->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex items-center">
                                            <i data-lucide="stethoscope" class="size-5 mr-2 text-slate-500"></i>
                                            <span>{{ $appointment->service->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        @if($appointment->insurance)
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                            <i data-lucide="shield-check" class="size-4 mr-1"></i>
                                            {{ $appointment->insurance->name }}
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-800 dark:bg-zink-600 dark:text-zink-200">
                                            <i data-lucide="shield-off" class="size-4 mr-1"></i>
                                            Not Covered
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 font-medium">{{ number_format($appointment->service->price, 2) }} FRW</td>
                                    {{-- <td class="px-3.5 py-2.5">
                                        <button type="button" onclick="openModal({{ $appointment->id }})" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:ring-custom-100 dark:focus:ring-custom-500/30">
                                    <i data-lucide="percent" class="size-4 mr-1"></i>
                                    Review & Discount
                                    </button>
                                    </td> --}}

                                    <td class="px-3.5 py-2.5">
                                        <button type="button" onclick="openModal({{ $appointment->id }})" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:ring-custom-100 dark:focus:ring-custom-500/30">
                                            <i data-lucide="percent" class="size-4 mr-1"></i>
                                            Review & Discount
                                        </button>

                                        @if($appointment->status === 'confirmed')
                                        <a href="{{ route('receipt.print', $appointment->id) }}" target="_blank" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:ring-custom-100 dark:focus:ring-custom-500/30">
                                            <i data-lucide="printer" class="size-4 mr-1"></i>
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
        </div>
    </div>
</div>

<!-- Discount & Payment Modal (Reduced Modal Size) -->
@foreach($latestAppointments as $appointment)
<div id="discountModal-{{ $appointment->id }}" modal-center class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
    <div class="w-full max-w-sm p-4 mx-4">
        <div class="bg-white rounded-xl shadow-2xl dark:bg-gray-800">
            <div class="p-4">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Review & Apply Discount</h2>

                <!-- Patient Info Section -->
                <div class="mb-6">
                    <h3 class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        <i data-lucide="user" class="w-6 h-6 mr-2"></i>
                        Patient Information
                        <span class="ml-auto text-sm text-gray-500">#{{ $appointment->id }}</span>
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Patient Name</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $appointment->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Email</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $appointment->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Insurance Section -->
                <!-- Insurance Section -->
                <div class="mb-6">
                    <h3 class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        <i data-lucide="shield" class="w-6 h-6 mr-2"></i>
                        Insurance Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Insurance Provider</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $appointment->insurance->name ?? 'No Insurance' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Document</p>
                            @if($appointment->insurance_document)
                            <a href="{{ asset('storage/' . $appointment->insurance_document) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">



                                <i data-lucide="file-text" class="w-5 h-5 mr-1"></i>
                                View Document
                            </a>
                            @else
                            <p class="text-gray-400">No Document</p>
                            @endif
                        </div>
                    </div>
                </div>



                <!-- Payment Section -->
                <div class="mb-6">
                    <h3 class="flex items-center text-xl font-semibold text-gray-900 dark:text-white mb-3">
                        <i data-lucide="credit-card" class="w-6 h-6 mr-2"></i>
                        Payment Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Service</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $appointment->service->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Total Cost</p>
                            <p class="font-medium text-gray-900 dark:text-white" id="totalCost-{{ $appointment->id }}">
                                {{ number_format($appointment->service->price, 2) }} FRW
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Discount Form -->
                <form action="{{ route('doctor.applyDiscount', $appointment->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Booking Status Dropdown -->
                        <div class="mb-4">
                            <label class="block mt-3">Update Booking Status:</label>
                            <select name="status" class="form-select w-full border p-2 rounded" onchange="updateStatus(this, {{ $appointment->id }})">

                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                            </select>
                        </div>

                        <!-- Discount Percentage Selector -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Discount Percentage
                            </label>
                            <select id="discountPercentage-{{ $appointment->id }}" data-totalcost="{{ $appointment->service->price }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select discount percentage</option>
                                @foreach([10,20,30,40,50,60,70,80,90,100] as $percent)
                                <option value="{{ $percent }}">{{ $percent }}%</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Auto-filled Discount Amount -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Discount Amount (FRW)
                        </label>
                        <input type="number" id="discountAmount-{{ $appointment->id }}" name="discount" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" min="0" required readonly>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white transition duration-300 ease-in-out transform bg-gradient-to-r from-custom-500 to-custom-600 border border-transparent rounded-lg shadow-sm hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-500">
                            <i data-lucide="check-circle" class="w-5 h-5 mr-2 animate-pulse"></i>
                            Apply Discount & Save
                        </button>
                        <button type="button" onclick="closeModal({{ $appointment->id }})" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-gray-700 transition duration-300 ease-in-out transform bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-red-50 hover:text-red-500 hover:border-red-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i data-lucide="x" class="w-5 h-5 mr-2"></i>
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function openModal(id) {
        document.getElementById('discountModal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('discountModal-' + id).classList.add('hidden');
    }

    // Listen for discount percentage selection on each modal
    document.querySelectorAll('[id^="discountPercentage-"]').forEach(select => {
        select.addEventListener('change', function() {
            const totalCost = parseFloat(this.dataset.totalcost);
            const percent = parseFloat(this.value);
            // Get the appointment id from the element's id (e.g., discountPercentage-5)
            const id = this.id.split('-')[1];
            const discountAmountInput = document.getElementById('discountAmount-' + id);
            if (!isNaN(percent) && totalCost) {
                const discount = totalCost * (percent / 100);
                discountAmountInput.value = discount.toFixed(2);
            } else {
                discountAmountInput.value = '';
            }
        });
    });

</script>



<script>
    function updateStatus(select, appointmentId) {
        let status = select.value;

        fetch("{{ route('doctor.updateStatus') }}", {


                method: "POST"
                , headers: {
                    "Content-Type": "application/json"
                    , "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
                , body: JSON.stringify({
                    appointment_id: appointmentId
                    , status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Booking status updated successfully!");
                } else {
                    alert("Failed to update status. Please try again.");
                }
            })
            .catch(error => {
                console.error("Error updating status:", error);
                alert("An error occurred.");
            });
    }

</script>



@endsection
