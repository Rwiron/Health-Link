@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Doctor Availability</h5>
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

            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Doctor Availabilities</h6>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Doctor</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Date</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Start Time</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">End Time</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($availabilities as $availability)
                                <tr>
                                    <td class="px-3.5 py-2.5">{{ $availability->doctor->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->available_date }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->start_time }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->end_time }}</td>
                                    <td class="px-3.5 py-2.5">
                                        <a href="#!" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 book-now-btn" data-doctor-id="{{ $availability->doctor->id }}" data-date="{{ $availability->available_date }}" data-start-time="{{ $availability->start_time }}" data-end-time="{{ $availability->end_time }}">
                                            Book Now
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-3.5 py-2.5 text-center text-slate-500">
                                        No availabilities found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
    // Open Modal and Populate Data
    document.querySelectorAll('.book-now-btn').forEach(button => {
        button.addEventListener('click', function() {
            const doctorId = this.dataset.doctorId;
            const date = this.dataset.date;
            const startTime = this.dataset.startTime;
            const endTime = this.dataset.endTime;

            document.getElementById('modalDoctorId').value = doctorId;
            document.getElementById('appointmentDate').value = date;
            document.getElementById('startTime').value = startTime;
            document.getElementById('endTime').value = endTime;

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
