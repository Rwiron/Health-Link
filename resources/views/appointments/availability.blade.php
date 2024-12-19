@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16 font-bold">Doctor Availability</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Available Doctors
                    </li>
                </ul>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($availabilities as $availability)
                <div class="card shadow-md w-full max-w-[250px] mx-auto">
                    <div class="card-body">
                        <div class="flex flex-col items-center gap-3 mb-4">
                            <img src="{{ $availability->doctor->image ? asset('storage/' . $availability->doctor->image) : asset('assets/images/avatar-10.png') }}" alt="Doctor" class="w-20 h-20 rounded-full shadow-lg">
                            <div class="text-center">
                                <h5 class="text-lg font-semibold">{{ $availability->doctor->name }}</h5>
                                <p class="text-sm text-slate-500"><strong>Hospital:</strong> {{ $availability->doctor->hospital->name ?? 'Not Assigned' }}</p>
                                <p class="text-slate-500"><strong>specialization:</strong>{{ $availability->doctor->specialization ?? 'General Practitioner' }}</p>




                            </div>
                        </div>
                        <div class="text-sm text-slate-600 mb-3">
                            <p><strong>Date:</strong> {{ $availability->available_date }}</p>
                            <p><strong>Time:</strong> {{ $availability->start_time }} - {{ $availability->end_time }}</p>
                        </div>
                        <div class="text-center">
                            <a href="#!" class="btn bg-custom-500 text-white hover:bg-custom-600 w-full py-2 text-sm book-now-btn" data-doctor-id="{{ $availability->doctor->id }}" data-date="{{ $availability->available_date }}" data-start-time="{{ $availability->start_time }}" data-end-time="{{ $availability->end_time }}">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center">
                    <p class="text-slate-500">No doctor availabilities found.</p>
                </div>
                @endforelse
            </div>

            <!-- Book Appointment Modal -->
            <div id="bookAppointmentModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h5 class="text-16">Book Appointment</h5>
                        <button data-modal-close="bookAppointmentModal" class="text-red-500 hover:text-red-700">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('doctor.appointment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="doctor_id" id="modalDoctorId">
                            <div class="mb-3">
                                <label for="appointmentDate" class="block text-sm font-medium">Appointment Date</label>
                                <input type="date" id="appointmentDate" name="appointment_date" class="form-input w-full" required>
                                <small class="text-slate-500" id="remainingDaysInfo"></small>
                            </div>
                            <div class="mb-3">
                                <label for="startTime" class="block text-sm font-medium">Start Time</label>
                                <input type="time" id="startTime" name="start_time" class="form-input w-full" required>
                            </div>
                            <div class="mb-3">
                                <label for="endTime" class="block text-sm font-medium">End Time</label>
                                <input type="time" id="endTime" name="end_time" class="form-input w-full" required>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="block text-sm font-medium">Notes</label>
                                <textarea id="notes" name="notes" class="form-input w-full" rows="3"></textarea>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="reset" class="text-red-500 bg-white btn hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 hover:bg-custom-600">Book Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal -->


        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.book-now-btn').forEach(button => {
        button.addEventListener('click', function() {
            const doctorId = this.dataset.doctorId;
            const availableDate = new Date(this.dataset.date);
            const maxDate = new Date(availableDate);
            maxDate.setDate(maxDate.getDate() + 5);
            const today = new Date();

            // Set minimum and maximum date for the date picker
            const appointmentDateInput = document.getElementById('appointmentDate');
            appointmentDateInput.min = today.toISOString().split('T')[0];
            appointmentDateInput.max = maxDate.toISOString().split('T')[0];

            // Calculate remaining days and display
            const remainingDays = Math.ceil((availableDate - today) / (1000 * 60 * 60 * 24));
            const remainingDaysInfo = document.getElementById('remainingDaysInfo');
            if (remainingDays > 0) {
                remainingDaysInfo.textContent = `You have ${remainingDays} days to book an appointment starting from ${availableDate.toDateString()}.`;
            } else {
                remainingDaysInfo.textContent = 'Booking is no longer available for this doctor.';
            }

            // Populate doctor ID and show modal
            document.getElementById('modalDoctorId').value = doctorId;
            const modal = document.getElementById('bookAppointmentModal');
            modal.classList.remove('hidden');
        });
    });

    // Close Modal
    document.querySelectorAll('[data-modal-close="bookAppointmentModal"]').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('bookAppointmentModal').classList.add('hidden');
        });
    });

</script>

@endsection
