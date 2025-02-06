@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">

        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Doctors Management</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2">
                            <li><a href="#" class="text-sm text-slate-500 hover:text-slate-700">Dashboard</a></li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="ml-2 text-sm font-medium text-slate-700">Doctor Management</span>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button type="button" data-modal-target="addDoctorModal" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 rounded-lg shadow-sm transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Doctor
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($doctors as $doctor)
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-6">
                        @if($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-indigo-500 ring-offset-2">
                        @else
                        <div class="h-16 w-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                            <span class="text-2xl font-semibold text-white">{{ substr($doctor->name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $doctor->name }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $doctor->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400">Hospital</h4>
                            <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white" data-hospital-id="{{ $doctor->hospital->id }}">{{ $doctor->hospital->name }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Services</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($doctor->services as $service)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200" data-service-id="{{ $service->id }}">
                                    {{ $service->name }} - {{ number_format($service->price, 0) }} FRW
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-700 flex justify-end space-x-3">
                        {{-- <button data-id="{{ $doctor->id }}" data-modal-target="editDoctorModal" class="edit-doctor-btn p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/50 rounded-lg transition-all duration-150">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                        <button data-id="{{ $doctor->id }}" data-modal-target="deleteDoctorModal" class="delete-doctor-btn p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-lg transition-all duration-150">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Add Doctor Modal -->
        <div id="addDoctorModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                    <h5 class="text-lg font-medium">Add Doctor</h5>
                    <button data-modal-close="addDoctorModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    <form action="{{ route('superadmin.doctors.store') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                            <!-- Doctor Name -->
                            <div class="xl:col-span-6">
                                <label for="name" class="inline-block mb-2 text-base font-medium">Name</label>
                                <input type="text" id="name" name="name" class="form-input" placeholder="Enter doctor name" required>
                            </div>

                            <!-- Doctor Email -->
                            <div class="xl:col-span-6">
                                <label for="email" class="inline-block mb-2 text-base font-medium">Email</label>
                                <input type="email" id="email" name="email" class="form-input" placeholder="Enter email" required>
                            </div>

                            <!-- Password -->
                            <div class="xl:col-span-6">
                                <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                                <input type="password" id="password" name="password" class="form-input" placeholder="Enter password" required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="xl:col-span-6">
                                <label for="password_confirmation" class="inline-block mb-2 text-base font-medium">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Confirm password" required>
                            </div>

                            <!-- Select Hospital -->
                            <div class="xl:col-span-12">
                                <label for="hospital_id" class="inline-block mb-2 text-base font-medium">Select Hospital</label>
                                <select id="hospital_id" name="hospital_id" class="form-input" required>
                                    <option value="" disabled selected>Select Hospital</option>
                                    @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Select Services -->
                            <div class="xl:col-span-12">
                                <label for="service_ids" class="inline-block mb-2 text-base font-medium">Select Services</label>
                                <select id="service_ids" multiple class="form-input w-full" required>
                                    <!-- Options will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Fields for Service Attributes -->
                        <div id="serviceAttributesContainer" class="mt-4">
                            <!-- Service attribute fields will be populated via JavaScript -->
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="reset" data-modal-close="addDoctorModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">
                                Cancel
                            </button>
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">
                                Add Doctor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>








        <!-- Edit Doctor Modal -->
        <div id="editDoctorModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                    <h5 class="text-16">Edit Doctor</h5>
                    <button data-modal-close="editDoctorModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    <form id="edit-doctor-form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editDoctorId" name="id">
                        <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                            <div class="xl:col-span-6">
                                <label for="editName" class="inline-block mb-2 text-base font-medium">Name</label>
                                <input type="text" id="editName" name="name" class="form-input" placeholder="Enter doctor name" required>
                            </div>
                            <div class="xl:col-span-6">
                                <label for="editEmail" class="inline-block mb-2 text-base font-medium">Email</label>
                                <input type="email" id="editEmail" name="email" class="form-input" placeholder="Enter email" required>
                            </div>
                            <div class="xl:col-span-6">
                                <label for="editPassword" class="inline-block mb-2 text-base font-medium">Psd (leave blank to keep current)</label>
                                <input type="password" id="editPassword" name="password" class="form-input" placeholder="Enter new password">
                            </div>
                            <div class="xl:col-span-6">
                                <label for="editPasswordConfirmation" class="inline-block mb-2 text-base font-medium">Confirm Password</label>
                                <input type="password" id="editPasswordConfirmation" name="password_confirmation" class="form-input" placeholder="Confirm new password">
                            </div>
                            <div class="xl:col-span-12">
                                <label for="editHospitalId" class="inline-block mb-2 text-base font-medium">Select Hospital</label>
                                <select id="editHospitalId" name="hospital_id" class="form-input">
                                    <option value="" disabled selected>Select Hospital</option>
                                    @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="editServiceIds" class="inline-block mb-2 text-base font-medium">Select Services</label>
                                <select id="editServiceIds" name="service_ids[]" class="form-input" multiple required>
                                    <!-- Options populated via JS -->
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="reset" data-modal-close="editDoctorModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Delete Doctor Modal -->
        <div id="deleteDoctorModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                    <h5 class="text-16">Delete Doctor</h5>
                    <button data-modal-close="deleteDoctorModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        Are you sure you want to delete this doctor? This action cannot be undone.
                    </p>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" data-modal-close="deleteDoctorModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                        <button type="button" id="confirmDelete" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Delete</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hospitalSelect = document.getElementById('hospital_id');
        const serviceSelect = document.getElementById('service_ids');
        const serviceAttributesContainer = document.getElementById('serviceAttributesContainer');

        // Fetch services for the selected hospital
        hospitalSelect.addEventListener('change', async function() {
            try {
                const hospitalId = this.value;
                const response = await fetch(`/superadmin/doctors/services/${hospitalId}`);
                const data = await response.json();

                // Clear previous selections
                serviceSelect.innerHTML = '';
                serviceAttributesContainer.innerHTML = '';

                // Populate the services dropdown
                data.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = service.name;
                    serviceSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching services:', error);
            }
        });

        // Handle service selection and create attribute fields
        serviceSelect.addEventListener('change', function() {
            serviceAttributesContainer.innerHTML = '';
            const selectedServices = Array.from(this.selectedOptions);

            selectedServices.forEach((option, index) => {
                const serviceId = option.value;
                const serviceName = option.textContent;

                const attributeGroup = document.createElement('div');
                attributeGroup.classList.add('mb-4', 'p-4', 'border', 'rounded');

                attributeGroup.innerHTML = `
                    <h4 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">${serviceName}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="hidden" name="services[${index}][id]" value="${serviceId}">

                        <div>
                            <label class="text-sm font-medium text-slate-500 dark:text-slate-400">Description</label>
                            <input type="text" name="services[${index}][description]" class="form-input w-full" placeholder="Service description">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-500 dark:text-slate-400">Status</label>
                            <select name="services[${index}][status]" class="form-input w-full" required>
                                <option value="">Select Status</option>
                                <option value="1">Available</option>
                                <option value="0">Unavailable</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-500 dark:text-slate-400">Appointment Fees (FRW)</label>
                            <input type="number" name="services[${index}][appointment_fees]" class="form-input w-full" min="0" required>
                        </div>
                    </div>
                `;

                serviceAttributesContainer.appendChild(attributeGroup);
            });
        });
    });







    // Edit Doctor Modal Logic
    document.querySelectorAll('.edit-doctor-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const modal = document.getElementById('editDoctorModal');
            const doctorId = this.dataset.id;
            const doctor = {
                id: doctorId
                , name: this.closest('.bg-white').querySelector('h3').textContent
                , email: this.closest('.bg-white').querySelector('p').textContent
                , hospital_id: this.closest('.bg-white').querySelector('[data-hospital-id]').dataset.hospitalId
                , services: Array.from(this.closest('.bg-white').querySelectorAll('.bg-indigo-100')).map(span => ({
                    id: span.dataset.serviceId
                    , name: span.textContent.split('-')[0].trim()
                }))
            };

            // Populate form fields
            document.getElementById('editDoctorId').value = doctor.id;
            document.getElementById('editName').value = doctor.name;
            document.getElementById('editEmail').value = doctor.email;
            document.getElementById('editHospitalId').value = doctor.hospital_id;

            // Set form action
            document.getElementById('edit-doctor-form').action = `/superadmin/doctors/${doctor.id}`;

            // Fetch and populate services for the selected hospital
            try {
                const response = await fetch(`/superadmin/doctors/services/${doctor.hospital_id}`);
                const services = await response.json();
                const serviceSelect = document.getElementById('editServiceIds');

                serviceSelect.innerHTML = '';
                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = `${service.name} (${service.category})`;
                    option.selected = doctor.services.some(ds => ds.id === service.id);
                    serviceSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching services:', error);
            }

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

    // Update services when hospital changes in edit modal
    document.getElementById('editHospitalId').addEventListener('change', async function() {
        try {
            const response = await fetch(`/superadmin/doctors/services/${this.value}`);
            const services = await response.json();
            const serviceSelect = document.getElementById('editServiceIds');

            serviceSelect.innerHTML = '';
            services.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id;
                option.textContent = `${service.name} (${service.category})`;
                serviceSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching services:', error);
        }
    });


    // Delete Doctor Modal Logic
    document.querySelectorAll('.delete-doctor-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteDoctorModal');
            const doctorId = this.dataset.id;
            const doctorCard = this.closest('.bg-white');
            const confirmDeleteBtn = document.getElementById('confirmDelete');

            // Set up the delete confirmation
            confirmDeleteBtn.onclick = async () => {
                try {
                    const response = await fetch(`/superadmin/doctors/${doctorId}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            , 'Accept': 'application/json'
                            , 'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Remove the doctor card from the UI
                        doctorCard.remove();
                        // Close the modal
                        modal.classList.add('hidden');
                        // Success message is handled by Toastr
                        Toastr.success('Doctor deleted successfully!', 'Success');
                    } else {
                        // Error message is handled by Toastr
                        Toastr.error('Error deleting doctor!', 'Error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    // Error message is handled by Toastr
                    Toastr.error('Error deleting doctor!', 'Error');
                }
            };

            // Show the modal
            modal.classList.remove('hidden');
        });
    });


    // Close modal when clicking cancel button
    document.querySelectorAll('[data-modal-close="deleteDoctorModal"]').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('deleteDoctorModal').classList.add('hidden');
        });
    });

    // Close modal when clicking outside the modal
    document.getElementById('deleteDoctorModal').addEventListener('click', (event) => {
        if (event.target === document.getElementById('deleteDoctorModal')) {
            document.getElementById('deleteDoctorModal').classList.add('hidden');
        }
    });

</script>
@endsection
