@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Hospital Details</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('client.hospitals.index') }}" class="text-slate-400 dark:text-zink-200">Hospitals</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Details</li>
            </ul>
        </div>

        <div class="grid grid-cols-12 gap-5">
            <!-- Hospital Info Card -->
            <div class="col-span-12 lg:col-span-4">
                <div class="card">
                    <div class="card-body">
                        <div class="flex flex-col gap-4">
                            <div class="text-center mb-4">
                                <div class="size-24 mx-auto rounded-full bg-slate-100 dark:bg-zink-500 flex items-center justify-center mb-3">
                                    @if($hospital->logo)
                                    <img src="{{ asset('storage/' . $hospital->logo) }}" alt="{{ $hospital->name }}" class="size-24 rounded-full object-cover">
                                    @else
                                    <i data-lucide="building-2" class="size-12 text-slate-500 dark:text-zink-200"></i>
                                    @endif
                                </div>
                                <h4 class="text-xl font-semibold text-slate-800 dark:text-zink-50">{{ $hospital->name }} Hospital</h4>
                            </div>
                            <div class="flex items-center gap-3 text-slate-500 dark:text-zink-200 bg-slate-50 dark:bg-zink-600 p-3 rounded-lg">
                                <i data-lucide="map-pin" class="size-5"></i>
                                <span>{{ $hospital->address }}, {{ $hospital->province }}, {{ $hospital->district }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-500 dark:text-zink-200 bg-slate-50 dark:bg-zink-600 p-3 rounded-lg">
                                <i data-lucide="phone" class="size-5"></i>
                                <span>{{ $hospital->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Insurance Providers Card -->
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="mb-4 text-16 font-semibold">Insurance Providers</h5>
                        @if($hospital->insurance->isNotEmpty())
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($hospital->insurance as $insurance)
                            <div class="flex flex-col items-center p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                @if($insurance->image)
                                <img src="{{ asset('storage/' . $insurance->image) }}" alt="{{ $insurance->name }}" class="h-16 w-16 rounded-full mb-2">
                                @else
                                <div class="h-16 w-16 rounded-full bg-slate-100 dark:bg-zink-600 flex items-center justify-center mb-2">
                                    <i data-lucide="shield-check" class="size-8 text-green-500"></i>
                                </div>
                                @endif
                                <span class="text-slate-600 dark:text-zink-200 text-center">{{ $insurance->name }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-slate-500 dark:text-zink-200">No insurance providers listed.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <!-- Map Section -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 text-16 font-semibold">Hospital Location</h5>
                        @if($hospital->map_iframe)
                        <div class="overflow-hidden rounded-lg shadow-md h-[500px]">
                            <div class="w-full h-full">
                                {!! preg_replace('/height="[^"]*"/', 'height="100%"', preg_replace('/width="[^"]*"/', 'width="100%"', $hospital->map_iframe)) !!}
                            </div>
                        </div>
                        @else
                        <p class="text-slate-500 dark:text-zink-200">Map not available for this hospital.</p>
                        @endif
                    </div>
                </div>

                <!-- Services Card -->
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="mb-4 text-16 font-semibold">Services Tarrif </h5>
                        @if($hospital->services->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap text-left">
                                <thead class="bg-slate-100 dark:bg-zink-600">
                                    <tr>
                                        <th class="px-4 py-3 font-semibold text-slate-800 dark:text-zink-50 text-left">Name</th>
                                        <th class="px-4 py-3 font-semibold text-slate-800 dark:text-zink-50 text-left">Category</th>
                                        <th class="px-4 py-3 font-semibold text-slate-800 dark:text-zink-50 text-left">Price in Frw</th>
                                        <th class="px-4 py-3 font-semibold text-slate-800 dark:text-zink-50 text-left">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                                    @foreach($hospital->services as $service)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-zink-600 transition-all">
                                        <td class="px-4 py-3 text-slate-700 dark:text-zink-100 align-top">{{ $service->name }}</td>
                                        <td class="px-4 py-3 text-slate-700 dark:text-zink-100 align-top">{{ $service->category }}</td>
                                        <td class="px-4 py-3 text-slate-700 dark:text-zink-100 align-top">{{ $service->price }}</td>
                                        <td class="px-4 py-3 text-slate-700 dark:text-zink-100 align-top">{{ $service->duration }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-slate-500 dark:text-zink-200">No services listed.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Doctors Card -->
            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 text-16 font-semibold">Our Medical Team</h5>
                        @if($hospital->doctors->isNotEmpty())
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($hospital->doctors as $doctor)
                            <div class="card hover:shadow-lg transition-all duration-300 dark:bg-zink-600">
                                <div class="card-body">
                                    <div class="flex items-center gap-4">
                                        <div class="size-16 rounded-full bg-slate-100 dark:bg-zink-500 flex items-center justify-center">
                                            <i data-lucide="user" class="size-8 text-slate-500 dark:text-zink-200"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-2 text-16 font-semibold text-slate-800 dark:text-zink-50">{{ $doctor->name }}</h6>
                                            <p class="text-slate-500 dark:text-zink-200">{{ $doctor->specialization }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-slate-500 dark:text-zink-200">No doctors listed.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
