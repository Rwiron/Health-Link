<div class="card print:shadow-none print:border-none">
    <div class="card-body print:hidden">
        <div class="flex flex-col gap-5 md:items-center md:flex-row">
            <div class="grow">
                <h6 class="mb-1 text-16">#{{ $appointment->id }}</h6>
                <ul class="flex items-center gap-3">
                    <li class="text-slate-500 dark:text-zink-200">Created: {{ $appointment->created_at->format('d M, Y') }}</li>
                    <li class="text-slate-500 dark:text-zink-200">Due: {{ $appointment->appointment_date }}</li>
                </ul>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button onclick="window.print()" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                    <i data-lucide="save" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i>
                    <span class="align-middle">Save & Print</span>
                </button>
            </div>
        </div>
    </div>
    <div class="!pt-0 card-body">
        <div class="p-5 rounded-md md:p-8 bg-slate-50 dark:bg-zink-600 print:p-0">
            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                <div class="text-center xl:col-span-2 ltr:xl:text-left rtl:xl:text-right">
                    <div class="flex items-center justify-center mx-auto rounded-md size-16 bg-slate-100 dark:bg-zink-600 xl:mx-0">
                        @if ($selectedAppointment && $selectedAppointment->doctor->hospital)
                        <img src="{{ asset('storage/' . $selectedAppointment->doctor->hospital->logo) }}" alt="Hospital Logo" class="h-8">
                        @else
                        <img src="{{ asset('default-hospital-logo.png') }}" alt="Default Hospital Logo" class="h-8">
                        @endif
                    </div>

                    <h5 class="mt-4 mb-1">{{ $appointment->doctor->hospital->name ?? 'Hospital Name' }}</h5>
                    <p class="text-slate-500 dark:text-zink-200">{{ $appointment->doctor->hospital->address ?? 'Hospital Address' }}</p>
                </div>
                <!--end col-->
                <div class="ltr:xl:text-right rtl:xl:text-left xl:col-start-10 xl:col-span-3">
                    <p class="mb-1 text-slate-500 dark:text-zink-200">Legal Registration No: <span class="font-semibold">{{ $appointment->doctor->hospital->id ?? 'N/A' }}</span></p>
                    <p class="mb-1 truncate text-slate-500 dark:text-zink-200">Hospital Name: <span class="font-semibold">{{ $appointment->doctor->hospital->name ?? 'N/A' }}</span></p>
                    <p class="mb-1 text-slate-500 dark:text-zink-200">Contact No: <span class="font-semibold">{{ $appointment->doctor->hospital->phone ?? 'N/A' }}</span></p>
                </div>
                <!--end col-->
            </div>
            <!--end grid-->

            <div class="grid grid-cols-1 mt-6 text-center divide-y md:divide-y-0 md:divide-x rtl:divide-x-reverse divide-dashed md:grid-cols-4 divide-slate-200 dark:divide-zink-500">
                <div class="p-3">
                    <h6 class="mb-1">#{{ $appointment->id }}</h6>
                    <p class="text-slate-500 dark:text-zink-200">Invoice No</p>
                </div>
                <!--end col-->
                <div class="p-3">
                    <h6 class="mb-1">{{ $appointment->created_at->format('d M, Y') }}</h6>
                    <p class="text-slate-500 dark:text-zink-200">Create Date</p>
                </div>
                <!--end col-->
                <div class="p-3">
                    <h6 class="mb-1">
                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-500' : ($appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-500' : 'bg-red-100 text-red-500') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </h6>
                    <p class="text-slate-500 dark:text-zink-200">Payment Status</p>
                </div>
                <!--end col-->
                <div class="p-3">
                    <p class="text-slate-500 dark:text-zink-200">Created By</p>
                    <h6 class="mb-1"> Doctor : {{ $loggedInDoctor->name }}</h6>
                </div>

                <!--end col-->
            </div>
            <!--end grid-->

            <div class="my-5">
                <h5>Patient Information</h5>
                <p><strong>Name:</strong> {{ $appointment->patient->name ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                <p><strong>Doctor:</strong> {{ $appointment->doctor->name ?? 'N/A' }}</p>
                <p><strong>Hospital:</strong> {{ $appointment->doctor->hospital->name ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
