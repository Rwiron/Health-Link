@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Insurance Providers Management</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Insurance Providers
                    </li>
                </ul>
            </div>

            <div class="card" id="insuranceTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Insurance Providers ({{ $insuranceProviders->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addInsuranceModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Insurance Provider</span>
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($insuranceProviders as $provider)
                        <div class="card shadow-md">
                            <div class="card-body">
                                <div class="flex justify-center">
                                    @if ($provider->image)
                                    <img src="{{ asset('storage/' . $provider->image) }}" alt="Insurance Image" class="h-24 w-24 rounded-full shadow-md">
                                    @else
                                    <span class="text-slate-400">No Image</span>
                                    @endif
                                </div>
                                <h5 class="text-lg font-semibold mt-4 text-center">{{ $provider->name }}</h5>
                                <p class="text-sm text-center text-slate-500">
                                    {{ $provider->hospital->name ?? 'Not Available' }}
                                </p>
                                <div class="flex justify-center mt-4 gap-2">
                                    <a href="#!" data-id="{{ $provider->id }}" data-name="{{ $provider->name }}" data-hospital-id="{{ $provider->hospital_id }}" data-image="{{ $provider->image }}" data-modal-target="editInsuranceModal" class="edit-insurance-btn text-blue-500">
                                        <i data-lucide="pencil" class="size-4"></i>
                                    </a>
                                    <a href="#!" data-id="{{ $provider->id }}" data-modal-target="deleteInsuranceModal" class="delete-insurance-btn text-red-500">
                                        <i data-lucide="trash-2" class="size-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Add Insurance Modal -->
            <div id="addInsuranceModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add Insurance Provider</h5>
                        <button data-modal-close="addInsuranceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data" id="create-insurance-form">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="insuranceName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="insuranceName" name="name" class="form-input" placeholder="Enter provider name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="hospitalId" class="inline-block mb-2 text-base font-medium">Select Hospital</label>
                                    <select id="hospitalId" name="hospital_id" class="form-input" required>
                                        <option value="" disabled selected>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="insuranceImage" class="inline-block mb-2 text-base font-medium">Image</label>
                                    <input type="file" id="insuranceImage" name="image" class="form-input">
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="addInsuranceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Add Provider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Insurance Modal -->

            <!-- Edit Insurance Modal -->
            <div id="editInsuranceModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Edit Insurance Provider</h5>
                        <button data-modal-close="editInsuranceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form id="edit-insurance-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="editInsuranceId">
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="editInsuranceName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="editInsuranceName" name="name" class="form-input" placeholder="Provider name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editHospitalId" class="inline-block mb-2 text-base font-medium">Hospital</label>
                                    <select id="editHospitalId" name="hospital_id" class="form-input" required>
                                        <option value="" disabled>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editInsuranceImage" class="inline-block mb-2 text-base font-medium">Image</label>
                                    <input type="file" id="editInsuranceImage" name="image" class="form-input">
                                    <img id="currentInsuranceImage" src="" alt="Current Image" class="mt-2 h-16 rounded-md shadow-md">
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="editInsuranceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Insurance Modal -->


            <!-- Delete Insurance Modal -->
            <div id="deleteInsuranceModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Delete Insurance Provider</h5>
                        <button data-modal-close="deleteInsuranceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <p class="text-slate-500">Are you sure you want to delete this insurance provider?</p>
                        <form id="delete-insurance-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteInsuranceId">
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="deleteInsuranceModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Delete Insurance Modal -->




            <!-- Other modals (Edit, Delete) remain the same -->
        </div>
    </div>
</div>

<script>
    // Edit Insurance Modal
    document.querySelectorAll('.edit-insurance-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editInsuranceModal');

            // Fetch data attributes
            const id = this.dataset.id;
            const name = this.dataset.name;
            const hospitalId = this.dataset.hospitalId;
            const image = this.dataset.image;

            // Populate modal fields
            document.getElementById('editInsuranceId').value = id;
            document.getElementById('editInsuranceName').value = name;
            document.getElementById('editHospitalId').value = hospitalId;

            // Handle image preview
            const imagePreview = document.getElementById('currentInsuranceImage');
            if (image) {
                imagePreview.src = `/storage/${image}`; // Adjust the path as needed
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
            }

            // Set the form action dynamically
            document.getElementById('edit-insurance-form').action = `/insurance/update/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });



    // Delete Insurance Modal
    document.querySelectorAll('.delete-insurance-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteInsuranceModal');
            const id = this.dataset.id;

            document.getElementById('delete-insurance-form').action = `/insurance/delete/${id}`;
            modal.classList.remove('hidden');
        });
    });

</script>

@endsection
