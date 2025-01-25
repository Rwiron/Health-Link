@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Services Management</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Service Management
                    </li>
                </ul>
            </div>

            <div class="card" id="serviceTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Services ({{ $services->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addServiceModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Service</span>
                            </a>
                        </div>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Hospital</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Name</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Category</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Price in Frw</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Duration</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Status</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr>
                                    <td class="px-3.5 py-2.5">{{ $service->hospital->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $service->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $service->category }}</td>
                                    <td class="px-3.5 py-2.5">{{ number_format($service->price, 2) }}</td>
                                    <td class="px-3.5 py-2.5">{{ $service->duration }}</td>
                                    <td class="px-3.5 py-2.5">{{ $service->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-3">
                                            <a href="#!" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-price="{{ $service->price }}" data-duration="{{ $service->duration }}" data-category="{{ $service->category }}" data-description="{{ $service->description }}" data-status="{{ $service->status }}" data-hospital-id="{{ $service->hospital_id }}" data-modal-target="editServiceModal" class="edit-service-btn text-blue-500">

                                                <i data-lucide="edit-2" class="size-4"></i>
                                            </a>
                                            <a href="#!" class="delete-service-btn text-red-500" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-modal-target="deleteServiceModal">
                                                <i data-lucide="trash-2" class="size-4"></i>
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

            <!-- Add Service Modal -->
            <div id="addServiceModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">

                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">

                    <div class="flex items-center justify-between px-4 py-3 border-b">
                        <h5 class="text-lg font-bold">Add Service</h5>
                        <button data-modal-close="addServiceModal" class="text-gray-500 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <form action="{{ route('services.store') }}" method="POST" class="p-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="hospitalId" class="block mb-2 text-sm font-medium">Hospital</label>
                                <select id="hospitalId" name="hospital_id" class="form-input" required>
                                    <option value="" disabled selected>Select Hospital</option>
                                    @foreach ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="serviceName" class="block mb-2 text-sm font-medium">Service Name</label>
                                <input type="text" id="serviceName" name="name" class="form-input" placeholder="Enter service name" required>
                            </div>
                            {{-- <div>
                                <label for="serviceCategory" class="block mb-2 text-sm font-medium">Category</label>
                                <input type="text" id="serviceCategory" name="category" class="form-input" placeholder="Enter category" required>
                            </div> --}}

                            <div>
                                <label for="serviceCategory" class="block mb-2 text-sm font-medium">Category</label>
                                <select id="serviceCategory" name="category" class="form-input" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="Consultation">Consultation</option>
                                    <option value="Dentistry">Dentistry</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Rehabilitation">Rehabilitation</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Radiology">Radiology</option>
                                    <option value="Pharmacy">Pharmacy</option>
                                    <option value="Laboratory">Laboratory</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="ENT (Ear, Nose, Throat)">ENT (Ear, Nose, Throat)</option>
                                    <option value="Gastroenterology">Gastroenterology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Ophthalmology">Ophthalmology</option>
                                    <option value="General Medicine">General Medicine</option>
                                    <option value="Urology">Urology</option>
                                    <option value="Gynecology">Gynecology</option>
                                    <option value="Nephrology">Nephrology</option>
                                    <option value="Pulmonology">Pulmonology</option>
                                    <option value="Endocrinology">Endocrinology</option>
                                    <option value="Rheumatology">Rheumatology</option>
                                    <option value="Anesthesiology">Anesthesiology</option>
                                    <option value="Pathology">Pathology</option>
                                    <option value="Emergency Medicine">Emergency Medicine</option>
                                    <option value="Plastic Surgery">Plastic Surgery</option>
                                    <option value="Pain Management">Pain Management</option>
                                    <option value="Sports Medicine">Sports Medicine</option>
                                    <option value="Infectious Disease">Infectious Disease</option>
                                </select>
                            </div>

                            <div>
                                <label for="serviceDescription" class="block mb-2 text-sm font-medium">Description</label>
                                <textarea id="serviceDescription" name="description" rows="4" class="form-input" placeholder="Enter service description"></textarea>
                            </div>

                            <div>
                                <label for="servicePrice" class="block mb-2 text-sm font-medium">Price</label>
                                <input type="number" id="servicePrice" name="price" class="form-input" placeholder="Enter price" step="0.01" required>
                            </div>
                            <div>
                                <label for="serviceDuration" class="block mb-2 text-sm font-medium">Duration</label>
                                <input type="text" id="serviceDuration" name="duration" class="form-input" placeholder="Enter duration (e.g., 30 minutes)" required>
                            </div>
                            {{-- <div>
                                <label for="serviceStatus" class="block mb-2 text-sm font-medium">Status</label>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="serviceStatus" name="status" class="form-checkbox">
                                    <label for="serviceStatus" class="text-sm">Active</label>
                                </div>
                            </div> --}}

                            <div>
                                <label for="serviceStatus" class="block mb-2 text-sm font-medium">Status</label>
                                <div class="flex items-center gap-2">
                                    <!-- Hidden input for unchecked state -->
                                    <input type="hidden" name="status" value="0">

                                    <!-- Checkbox for active status -->
                                    <input type="checkbox" id="serviceStatus" name="status" value="1" class="form-checkbox">
                                    <label for="serviceStatus" class="text-sm">Active</label>
                                </div>
                            </div>


                        </div>
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" data-modal-close="addServiceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                            <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Add Service</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Edit Service Modal -->
            <div id="editServiceModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Edit Service</h5>
                        <button data-modal-close="editServiceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form id="edit-service-form" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editServiceId">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editHospitalId" class="block mb-2 text-sm font-medium">Hospital</label>
                                    <select id="editHospitalId" name="hospital_id" class="form-input" required>
                                        <option value="" disabled>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="editServiceName" class="block mb-2 text-sm font-medium">Service Name</label>
                                    <input type="text" id="editServiceName" name="name" class="form-input" placeholder="Enter service name" required>
                                </div>
                                <div>
                                    <label for="editServiceCategory" class="block mb-2 text-sm font-medium">Category</label>
                                    <select id="editServiceCategory" name="category" class="form-input" required>
                                        <option value="">Select a category</option>
                                        <option value="Consultation">Consultation</option>
                                        <option value="Dentistry">Dentistry</option>
                                        <option value="Pediatrics">Pediatrics</option>
                                        <option value="Surgery">Surgery</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="editServiceDescription" class="block mb-2 text-sm font-medium">Description</label>
                                    <textarea id="editServiceDescription" name="description" rows="4" class="form-input" placeholder="Enter service description"></textarea>
                                </div>
                                <div>
                                    <label for="editServicePrice" class="block mb-2 text-sm font-medium">Price</label>
                                    <input type="number" id="editServicePrice" name="price" class="form-input" placeholder="Enter price" step="0.01" required>
                                </div>
                                <div>
                                    <label for="editServiceDuration" class="block mb-2 text-sm font-medium">Duration</label>
                                    <input type="text" id="editServiceDuration" name="duration" class="form-input" placeholder="Enter duration (e.g., 30 minutes)" required>
                                </div>
                                <div>
                                    <label for="editServiceStatus" class="block mb-2 text-sm font-medium">Status</label>
                                    <div class="flex items-center gap-2">
                                        <!-- Hidden input for unchecked state -->
                                        <input type="hidden" name="status" value="0">

                                        <!-- Checkbox for active status -->
                                        <input type="checkbox" id="editServiceStatus" name="status" value="1" class="form-checkbox">
                                        <label for="editServiceStatus" class="text-sm">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="editServiceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white bg-custom-500 btn hover:bg-custom-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Service Modal -->
            <div id="deleteServiceModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Delete Service: <span id="serviceToDelete" class="text-red-500"></span></h5>
                        <button data-modal-close="deleteServiceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="text-slate-500">Are you sure you want to delete this service?</p>
                        <form id="delete-service-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="deleteServiceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white bg-red-500 btn hover:bg-red-600">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-service-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editServiceModal');

            // Populate fields
            document.getElementById('editServiceId').value = this.dataset.id;
            document.getElementById('editName').value = this.dataset.name;
            document.getElementById('editPrice').value = this.dataset.price;
            document.getElementById('editDuration').value = this.dataset.duration;
            document.getElementById('editCategory').value = this.dataset.category;
            document.getElementById('editStatus').checked = this.dataset.status == 1;

            // Set form action
            document.getElementById('edit-service-form').action = `/services/${this.dataset.id}`;
            modal.classList.remove('hidden');
        });
    });

    document.querySelector('[data-modal-target="addServiceModal"]').addEventListener('click', () => {
        document.getElementById('addServiceModal').classList.remove('hidden');
    });

</script>


<script>
    // Edit Service Modal Script
    document.querySelectorAll('.edit-service-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editServiceModal');

            // Fetch data attributes from the clicked button
            const id = this.dataset.id;
            const hospitalId = this.dataset.hospitalId;
            const name = this.dataset.name;
            const category = this.dataset.category;
            const description = this.dataset.description;
            const price = this.dataset.price;
            const duration = this.dataset.duration;
            const status = this.dataset.status;

            // Populate modal fields with the fetched data
            document.getElementById('editServiceId').value = id;
            document.getElementById('editHospitalId').value = hospitalId;
            document.getElementById('editServiceName').value = name;
            document.getElementById('editServiceCategory').value = category;
            document.getElementById('editServiceDescription').value = description;
            document.getElementById('editServicePrice').value = price;
            document.getElementById('editServiceDuration').value = duration;
            document.getElementById('editServiceStatus').checked = status === '1';

            // Set the form action dynamically
            document.getElementById('edit-service-form').action = `/services/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });


    //delete
    document.querySelectorAll('.delete-service-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteServiceModal');
            const serviceId = this.dataset.id;
            const serviceName = this.dataset.name;

            // Set the service name in the modal
            document.getElementById('serviceToDelete').textContent = serviceName;

            // Update the delete form action dynamically
            document.getElementById('delete-service-form').action = `/services/${serviceId}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

</script>
@endsection
