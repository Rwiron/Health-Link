@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Appointments Management</h5>
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

            <div class="card" id="appointmentsTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Appointments ({{ $appointments->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addAppointmentModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Appointment</span>
                            </a>
                        </div>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Doctor</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Patient</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Date</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Time Slot</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Status</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td class="px-3.5 py-2.5">{{ $appointment->doctor->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $appointment->patient->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $appointment->appointment_date }}</td>
                                    <td class="px-3.5 py-2.5">{{ $appointment->time_slot }}</td>
                                    <td class="px-3.5 py-2.5">{{ ucfirst($appointment->status) }}</td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-3">
                                            <a href="#!" data-id="{{ $appointment->id }}" data-doctor-id="{{ $appointment->doctor_id }}" data-patient-id="{{ $appointment->patient_id }}" data-date="{{ $appointment->appointment_date }}" data-time-slot="{{ $appointment->time_slot }}" data-status="{{ $appointment->status }}" data-notes="{{ $appointment->notes }}" data-modal-target="editAppointmentModal" class="edit-appointment-btn">
                                                Edit
                                            </a>
                                            <a href="#!" data-id="{{ $appointment->id }}" data-modal-target="deleteAppointmentModal" class="delete-appointment-btn">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Appointment Modal -->
            <div id="addAppointmentModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add Appointment</h5>
                        <button data-modal-close="addAppointmentModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('appointments.store') }}" method="POST" id="create-appointment-form">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="doctorId" class="inline-block mb-2 text-base font-medium">Doctor</label>
                                    <select id="doctorId" name="doctor_id" class="form-input" required>
                                        <option value="" disabled selected>Select Doctor</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="appointmentDate" class="inline-block mb-2 text-base font-medium">Appointment Date</label>
                                    <input type="date" id="appointmentDate" name="appointment_date" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="timeSlot" class="inline-block mb-2 text-base font-medium">Time Slot</label>
                                    <input type="time" id="timeSlot" name="time_slot" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="notes" class="inline-block mb-2 text-base font-medium">Notes</label>
                                    <textarea id="notes" name="notes" class="form-input"></textarea>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="addAppointmentModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Add Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Appointment Modal -->

            <!-- Edit Appointment Modal -->
            <!-- Include the same structure as Add Modal but with pre-filled values for editing -->

            <!-- Delete Appointment Modal -->
            <!-- Include a confirmation modal for deleting appointments -->

        </div>
    </div>
</div>

<script>
    // Edit Appointment Modal Script
    document.querySelectorAll('.edit-appointment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editAppointmentModal');
            // Set values and show modal
        });
    });

    // Delete Appointment Modal Script
    document.querySelectorAll('.delete-appointment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteAppointmentModal');
            // Set values and show modal
        });
    });

</script>
@endsection
