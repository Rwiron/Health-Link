@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16 font-semibold text-gray-900 dark:text-white">Hospital Details</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-gray-400 dark:text-gray-200">
                    <a href="{{ route('client.hospitals.index') }}" class="text-gray-400 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-100 transition-colors">Hospitals</a>
                </li>
                <li class="text-gray-700 dark:text-gray-100">Details</li>
            </ul>
        </div>
        <a href="#" data-modal-target="bookingModal" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">
            <i data-lucide="calendar-plus" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i> Request Appointment
        </a>


        <br><br>

        <div class="grid grid-cols-12 gap-5">
            <!-- Hospital Info Card -->
            <div class="col-span-12 lg:col-span-4">
                <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <div class="card-body p-6">
                        <div class="flex flex-col gap-4">
                            <div class="text-center mb-4">
                                <div class="size-24 mx-auto rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-3">
                                    @if($hospital->logo)
                                    <img src="{{ asset('storage/' . $hospital->logo) }}" alt="{{ $hospital->name }}" class="size-24 rounded-full object-cover">
                                    @else
                                    <i data-lucide="building-2" class="size-12 text-gray-500 dark:text-gray-200"></i>
                                    @endif
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $hospital->name }} Hospital</h4>
                            </div>
                            <div class="flex items-center gap-3 text-gray-500 dark:text-gray-200 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <i data-lucide="map-pin" class="size-5"></i>
                                <span>{{ $hospital->address }}, {{ $hospital->province }}, {{ $hospital->district }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-500 dark:text-gray-200 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <i data-lucide="phone" class="size-5"></i>
                                <span>{{ $hospital->phone }}</span>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Insurance Providers Card -->
                <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-5">
                    <div class="card-body p-6">
                        <h5 class="mb-4 text-16 font-semibold text-gray-900 dark:text-white">Insurance Providers</h5>
                        @if($hospital->insuranceProviders->isNotEmpty())
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($hospital->insuranceProviders as $insurance)
                            <div class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                @if($insurance->image)
                                <img src="{{ asset('storage/' . $insurance->image) }}" alt="{{ $insurance->name }}" class="h-16 w-16 rounded-full mb-2">
                                @else
                                <div class="h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-2">
                                    <i data-lucide="shield-check" class="size-8 text-green-500"></i>
                                </div>
                                @endif
                                <span class="text-gray-600 dark:text-gray-200 text-center">{{ $insurance->name }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 dark:text-gray-200">No insurance providers listed.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <!-- Map Section -->
                <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                    <div class="card-body p-6">
                        <h5 class="mb-4 text-16 font-semibold text-gray-900 dark:text-white">Hospital Location</h5>
                        @if($hospital->map_iframe)
                        <div class="overflow-hidden rounded-lg shadow-md h-[500px]">
                            <div class="w-full h-full">
                                {!! preg_replace('/height="[^"]*"/', 'height="100%"', preg_replace('/width="[^"]*"/', 'width="100%"', $hospital->map_iframe)) !!}
                            </div>
                        </div>
                        @else
                        <p class="text-gray-500 dark:text-gray-200">Map not available for this hospital.</p>
                        @endif
                    </div>
                </div>

                <!-- Services Card -->
                <div class="card bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-5">
                    <div class="card-body p-6">
                        <h5 class="mb-4 text-16 font-semibold text-gray-900 dark:text-white">Services Tariff</h5>
                        @if($hospital->services->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="w-full whitespace-nowrap text-left">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white text-left">Name</th>
                                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white text-left">Category</th>
                                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white text-left">Price in Frw</th>
                                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white text-left">Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($hospital->services as $service)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-100 align-top">{{ $service->name }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-100 align-top">{{ $service->category }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-100 align-top">{{ $service->price }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-100 align-top">{{ $service->duration }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500 dark:text-gray-200">No services listed.</p>
                        @endif
                    </div>
                </div>
            </div>

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
                                        <div class="size-16 rounded-full overflow-hidden">
                                            @if($doctor->image)
                                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover rounded-full">
                                            @else
                                            <div class="h-16 w-16 flex items-center justify-center bg-slate-100 dark:bg-zink-500 rounded-full">
                                                <i data-lucide="user" class="size-8 text-slate-500 dark:text-zink-200"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-2 text-16 font-semibold text-slate-800 dark:text-zink-50">{{ $doctor->name }}</h6>
                                            <p class="text-slate-500 dark:text-zink-200">{{ $doctor->specialization }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="font-semibold text-slate-700 dark:text-zink-100">Services & Fees</h6>
                                        <ul class="mt-2 text-slate-600 dark:text-zink-200">
                                            @foreach($doctor->services as $service)
                                            <li class="text-sm">
                                                <span class="font-semibold">{{ $service->name }}</span> -
                                                <span class="text-green-600 dark:text-green-400">
                                                    {{ $service->pivot->appointment_fees ? number_format($service->pivot->appointment_fees, 0) . ' FRW' : 'Not Set' }}
                                                </span>
                                            </li>
                                            @endforeach
                                        </ul>
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


        <!-- Booking Modal -->
        <div id="bookingModal" modal-center class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="w-screen md:w-[30rem] bg-white shadow-lg rounded-md dark:bg-gray-800">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                    <h5 class="text-16 font-semibold text-gray-900 dark:text-white">Book an Appointment</h5>
                    <button data-modal-close="bookingModal" class="text-gray-500 hover:text-red-500 transition-colors">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                <div class="p-4">
                    <!-- Progress Steps -->
                    <div class="flex justify-between mb-8 relative">
                        <!-- Progress Line -->
                        <div class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 dark:bg-gray-700 -translate-y-1/2">
                            <div id="progressLine" class="h-full bg-custom-500 transition-all duration-300" style="width: 0%"></div>
                        </div>

                        <!-- Step Indicators -->
                        <div class="relative z-10 flex justify-between w-full">
                            <div class="step-indicator" data-step="1">
                                <div class="size-8 rounded-full bg-custom-500 text-white flex items-center justify-center transition-all duration-300">
                                    <span class="step-number">1</span>
                                    <i data-lucide="check" class="size-5 hidden"></i>
                                </div>
                                <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-sm font-medium">Doctor</span>
                            </div>
                            <div class="step-indicator" data-step="2">
                                <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-all duration-300">
                                    <span class="step-number">2</span>
                                    <i data-lucide="check" class="size-5 hidden"></i>
                                </div>
                                <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-sm font-medium">Service</span>
                            </div>
                            <div class="step-indicator" data-step="3">
                                <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-all duration-300">
                                    <span class="step-number">3</span>
                                    <i data-lucide="check" class="size-5 hidden"></i>
                                </div>
                                <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-sm font-medium">Date</span>
                            </div>
                            <div class="step-indicator" data-step="4">
                                <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-all duration-300">
                                    <span class="step-number">4</span>
                                    <i data-lucide="check" class="size-5 hidden"></i>
                                </div>
                                <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-sm font-medium">Review</span>
                            </div>
                        </div>
                    </div>

                    <form id="bookingForm" action="{{ route('client.bookings.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">

                        <!-- Step 1: Select Doctor -->
                        <div class="step-content" data-step="1">
                            <label class="block font-medium text-gray-700 dark:text-gray-200 mb-2">Select Doctor</label>
                            <select name="doctor_id" class="form-input w-full mb-4" required>
                                <option value="">Select a doctor</option>
                                @foreach($hospital->doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            <div class="flex justify-end gap-2 mt-6">
                                <button type="button" class="next-step text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 transition-colors">
                                    Next <i data-lucide="arrow-right" class="size-4 ml-1"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Select Service & Insurance -->
                        <div class="step-content hidden" data-step="2">
                            <label class="block font-medium text-gray-700 dark:text-gray-200 mb-2">Select Service</label>
                            <select name="service_id" class="form-input w-full mb-4" required>
                                <option value="">Select a service</option>
                                @foreach($hospital->services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ number_format($service->price, 0) }} FRW)</option>
                                @endforeach
                            </select>

                            <label class="block font-medium text-gray-700 dark:text-gray-200 mb-2">Select Insurance (Optional)</label>
                            <select id="insurance_id" name="insurance_id" class="form-input w-full mb-4">
                                <option value="">No insurance</option>
                                @foreach($hospital->insuranceProviders as $insurance)
                                <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                                @endforeach
                            </select>

                            <!-- Upload Insurance Document -->
                            <div id="insuranceDocumentContainer" class="hidden mb-4">
                                <label for="insurance_document" class="block font-medium text-gray-700 dark:text-gray-200 mb-2">Upload Insurance Document</label>
                                <input type="file" id="insurance_document" name="insurance_document" class="form-input w-full">
                                <small class="text-gray-500">Accepted formats: JPG, PNG, PDF (Max: 2MB)</small>
                            </div>

                            <div class="flex justify-between gap-2 mt-6">
                                <button type="button" class="prev-step text-gray-700 dark:text-gray-200 btn border hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i data-lucide="arrow-left" class="size-4 mr-1"></i> Back
                                </button>
                                <button type="button" class="next-step text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 transition-colors">
                                    Next <i data-lucide="arrow-right" class="size-4 ml-1"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Select Appointment Date -->
                        <div class="step-content hidden" data-step="3">
                            <label class="block font-medium text-gray-700 dark:text-gray-200 mb-2">Appointment Date</label>
                            <input type="date" name="booking_date" class="form-input w-full mb-4" required>
                            <div class="flex justify-between gap-2 mt-6">
                                <button type="button" class="prev-step text-gray-700 dark:text-gray-200 btn border hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i data-lucide="arrow-left" class="size-4 mr-1"></i> Back
                                </button>
                                <button type="button" class="next-step text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 transition-colors">
                                    Next <i data-lucide="arrow-right" class="size-4 ml-1"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 4: Review & Confirm -->
                        <div class="step-content hidden" data-step="4">
                            <h6 class="font-medium mb-4 text-gray-900 dark:text-white">Review Your Appointment Details</h6>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                <div class="space-y-3">

                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">Patient Name:</span>
                                        <span id="summaryUserName" class="text-gray-600 dark:text-gray-300">{{ auth()->user()->name }}</span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">Doctor:</span>
                                        <span id="summaryDoctor" class="text-gray-600 dark:text-gray-300">Not selected</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">Service:</span>
                                        <span id="summaryService" class="text-gray-600 dark:text-gray-300">Not selected</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">Insurance:</span>
                                        <span id="summaryInsurance" class="text-gray-600 dark:text-gray-300">Not selected</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">Date:</span>
                                        <span id="summaryDate" class="text-gray-600 dark:text-gray-300">Not selected</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between gap-2 mt-6">
                                <button type="button" class="prev-step text-gray-700 dark:text-gray-200 btn border hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i data-lucide="arrow-left" class="size-4 mr-1"></i> Back
                                </button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 transition-colors">
                                    <i data-lucide="check" class="size-4 mr-1"></i> Confirm Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Modal elements
        const modal = document.getElementById('bookingModal');
        const openModalBtn = document.querySelector('[data-modal-target="bookingModal"]');
        const closeModalBtns = document.querySelectorAll('[data-modal-close="bookingModal"]');
        const progressLine = document.getElementById('progressLine');
        const bookingForm = document.getElementById('bookingForm');
        let currentStep = 1;

        // Modal handlers
        const openModal = (event) => {
            event.preventDefault();
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('opacity-100'), 10);
        };

        const closeModal = () => {
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
                resetFormSteps();
            }, 300);
        };

        // Progress handlers
        const updateProgress = (step) => {
            const totalSteps = 4;
            const progress = ((step - 1) / (totalSteps - 1)) * 100;
            progressLine.style.width = `${progress}%`;

            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                const stepNum = index + 1;
                const circle = indicator.querySelector('div');
                const number = indicator.querySelector('.step-number');
                const check = indicator.querySelector('[data-lucide="check"]');

                if (stepNum < step) {
                    circle.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
                    circle.classList.add('bg-custom-500', 'text-white');
                    number.classList.add('hidden');
                    check.classList.remove('hidden');
                } else if (stepNum === step) {
                    circle.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
                    circle.classList.add('bg-custom-500', 'text-white');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                } else {
                    circle.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
                    circle.classList.remove('bg-custom-500', 'text-white');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                }
            });
        };

        const showStep = (step) => {
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.toggle('hidden', parseInt(content.dataset.step) !== step);
            });
            updateProgress(step);
        };

        // Summary handlers
        const updateSummary = () => {
            const getSelectedText = (selectElement) => {
                return selectElement?.options[selectElement.selectedIndex]?.text || 'Not selected';
            };

            const doctorSelect = document.querySelector('select[name="doctor_id"]');
            const serviceSelect = document.querySelector('select[name="service_id"]');
            const insuranceSelect = document.querySelector('select[name="insurance_id"]');
            const dateInput = document.querySelector('input[name="booking_date"]');

            document.getElementById('summaryDoctor').textContent = getSelectedText(doctorSelect);
            document.getElementById('summaryService').textContent = getSelectedText(serviceSelect);
            document.getElementById('summaryInsurance').textContent = insuranceSelect.value ? getSelectedText(insuranceSelect) : 'No insurance';
            document.getElementById('summaryDate').textContent = dateInput.value || 'Not selected';
        };

        // Form reset handler
        const resetFormSteps = () => {
            currentStep = 1;
            showStep(currentStep);
            bookingForm.reset();
            updateProgress(1);
            document.getElementById('insuranceDocumentContainer').classList.add('hidden');
        };

        // Event listeners
        openModalBtn.addEventListener('click', openModal);
        closeModalBtns.forEach(button => button.addEventListener('click', closeModal));
        modal.addEventListener('click', (event) => {
            if (event.target === modal) closeModal();
        });

        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep < 4) {
                    currentStep++;
                    showStep(currentStep);
                    if (currentStep === 4) updateSummary();
                }
            });
        });

        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
        });

        document.querySelectorAll('select, input').forEach(element => {
            element.addEventListener('change', updateSummary);
        });

        // Insurance document handling
        const insuranceSelect = document.getElementById('insurance_id');
        const insuranceDocumentContainer = document.getElementById('insuranceDocumentContainer');

        insuranceSelect.addEventListener('change', function() {
            insuranceDocumentContainer.classList.toggle('hidden', !this.value);
        });

        // Initialize
        showStep(currentStep);
    });
</script>
@endsection
