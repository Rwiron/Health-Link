@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Doctor Availability Management</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Doctor Availabilities
                    </li>
                </ul>
            </div>

            <div class="card" id="doctorAvailabilityTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Doctor Availabilities ({{ $availabilities->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addAvailabilityModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Availability</span>
                            </a>
                        </div>
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
                                @foreach ($availabilities as $availability)
                                <tr>
                                    <td class="px-3.5 py-2.5">{{ $availability->doctor->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->available_date }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->start_time }}</td>
                                    <td class="px-3.5 py-2.5">{{ $availability->end_time }}</td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-3">
                                            <a href="#!" data-id="{{ $availability->id }}" data-doctor-id="{{ $availability->doctor_id }}" data-date="{{ $availability->available_date }}" data-start-time="{{ $availability->start_time }}" data-end-time="{{ $availability->end_time }}" data-modal-target="editAvailabilityModal" class="edit-availability-btn">
                                                Edit
                                            </a>
                                            <a href="#!" data-id="{{ $availability->id }}" data-modal-target="deleteAvailabilityModal" class="delete-availability-btn">
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

            <!-- Add Availability Modal -->
            <div id="addAvailabilityModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add Availability</h5>
                        <button data-modal-close="addAvailabilityModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('doctor.availability.store') }}" method="POST" id="create-availability-form">
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
                                    <label for="availableDate" class="inline-block mb-2 text-base font-medium">Date</label>
                                    <input type="date" id="availableDate" name="available_date" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="startTime" class="inline-block mb-2 text-base font-medium">Start Time</label>
                                    <input type="time" id="startTime" name="start_time" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="endTime" class="inline-block mb-2 text-base font-medium">End Time</label>
                                    <input type="time" id="endTime" name="end_time" class="form-input" required>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="addAvailabilityModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Add Availability</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Availability Modal -->

            <!-- Edit Availability Modal -->
            <div id="editAvailabilityModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Edit Availability</h5>
                        <button data-modal-close="editAvailabilityModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form id="edit-availability-form" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editAvailabilityId">
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="editDoctorId" class="inline-block mb-2 text-base font-medium">Doctor</label>
                                    <select id="editDoctorId" name="doctor_id" class="form-input" required>
                                        <option value="" disabled>Select Doctor</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editAvailableDate" class="inline-block mb-2 text-base font-medium">Date</label>
                                    <input type="date" id="editAvailableDate" name="available_date" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editStartTime" class="inline-block mb-2 text-base font-medium">Start Time</label>
                                    <input type="time" id="editStartTime" name="start_time" class="form-input" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editEndTime" class="inline-block mb-2 text-base font-medium">End Time</label>
                                    <input type="time" id="editEndTime" name="end_time" class="form-input" required>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="editAvailabilityModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Availability Modal -->

            <!-- Delete Availability Modal -->
            <div id="deleteAvailabilityModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Delete Availability</h5>
                        <button data-modal-close="deleteAvailabilityModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <p class="text-slate-500">Are you sure you want to delete this availability?</p>
                        <form id="delete-availability-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteAvailabilityId">
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="deleteAvailabilityModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Delete Availability Modal -->
        </div>
    </div>
</div>

<script>
    // Edit Availability Modal
    document.querySelectorAll('.edit-availability-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editAvailabilityModal');

            const id = this.dataset.id;
            const doctorId = this.dataset.doctorId;
            const date = this.dataset.date;
            const startTime = this.dataset.startTime;
            const endTime = this.dataset.endTime;

            document.getElementById('editAvailabilityId').value = id;
            document.getElementById('editDoctorId').value = doctorId;
            document.getElementById('editAvailableDate').value = date;
            document.getElementById('editStartTime').value = startTime;
            document.getElementById('editEndTime').value = endTime;

            document.getElementById('edit-availability-form').action = `/doctor/availability/${id}`;
            modal.classList.remove('hidden');
        });
    });

    // Delete Availability Modal
    document.querySelectorAll('.delete-availability-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteAvailabilityModal');
            const id = this.dataset.id;

            document.getElementById('delete-availability-form').action = `/doctor/availability/${id}`;
            modal.classList.remove('hidden');
        });
    });

</script>
@endsection
