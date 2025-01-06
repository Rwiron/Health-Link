@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Invoices</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Invoices</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Details
                </li>
            </ul>
        </div>

        <!-- Layout -->
        <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
            <!-- Invoice List -->
            <div class="xl:col-span-3">
                <div class="sticky card print:hidden top-[calc(theme('spacing.header')_+_theme('spacing.5'))]">
                    <div class="card-body">
                        <h6 class="mb-4 text-16">Invoice List</h6>
                        <div class="flex items-center gap-2">
                            <div class="relative grow">
                                <input type="text" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search for ..." autocomplete="off">
                                <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar="" class="h-[calc(100vh_-_theme('height.14')_-_theme('spacing.5')_-_theme('height.header')_*_3.5)]">
                        @foreach ($appointments as $appointment)
                        <a href="{{ route('doctor.report', ['id' => $appointment->id]) }}" class="block transition-all duration-150 ease-linear border-t card-body border-slate-200 hover:bg-slate-50 [&.active]:bg-slate-100 dark:border-zink-500 dark:hover:bg-zink-600 dark:[&.active]:bg-zink-600">
                            <div class="float-right">
                                <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-500' : ($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-500' : 'bg-red-100 text-red-500') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                            <h6>#{{ $appointment->id }}</h6>
                            <div class="flex">
                                <div class="grow">
                                    <h6 class="mt-3 mb-1 text-16">{{ $appointment->patient->name ?? 'N/A' }}</h6>
                                    <p class="text-slate-500 dark:text-zink-200">${{ $appointment->invoice->total_amount ?? '0.00' }}</p>
                                </div>
                                <p class="self-end mb-0 text-slate-500 dark:text-zink-200 shrink-0">
                                    <i data-lucide="calendar-clock" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i>
                                    <span class="align-middle">{{ $appointment->appointment_date }}</span>
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="xl:col-span-9">
                @if(isset($selectedAppointment))
                <!-- Detailed View Section -->
                @include('doctor.partials.invoice-detail', ['appointment' => $selectedAppointment])
                @else
                <div class="text-center">
                    <p>Please select an invoice from the list to view details.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

