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
                    <div class="flex items-center gap-3 mb-6">
                        <h6 class="text-xl font-semibold grow">Insurance Providers ({{ $insuranceProviders->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addInsuranceModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 shadow-lg transition-all duration-200">
                                <i data-lucide="plus" class="inline-block size-4 mr-1"></i>
                                <span class="align-middle">Add Provider</span>
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($insuranceProviders as $provider)
                        <div class="card bg-white dark:bg-zinc-800 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="card-body">
                                <div class="flex justify-center mb-4">
                                    @if ($provider->image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $provider->image) }}" alt="{{ $provider->name }}" class="h-28 w-28 rounded-full object-cover shadow-lg ring-4 ring-gray-100 dark:ring-zinc-700">
                                        <div class="absolute inset-0 rounded-full bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                    </div>
                                    @else
                                    <div class="h-28 w-28 rounded-full bg-gray-100 dark:bg-zinc-700 flex items-center justify-center">
                                        <i data-lucide="image" class="size-8 text-gray-400 dark:text-zinc-400"></i>
                                    </div>
                                    @endif
                                </div>

                                <h5 class="text-lg font-bold mb-2 text-center text-gray-800 dark:text-zinc-100">{{ $provider->name }}</h5>

                                <div class="px-2 py-3 bg-gray-50 dark:bg-zinc-700/50 rounded-lg mb-4">
                                    <p class="text-sm text-center text-gray-600 dark:text-zinc-300 line-clamp-2">
                                        <i data-lucide="building-2" class="inline-block size-4 mr-1 align-text-bottom"></i>
                                        @foreach ($provider->hospitals as $hospital)
                                        {{ $hospital->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </p>
                                </div>

                                <div class="flex justify-center gap-3">
                                    <button data-id="{{ $provider->id }}" data-name="{{ $provider->name }}" data-hospital-ids="{{ json_encode([$provider->hospital_id]) }}" data-image="{{ $provider->image ? asset('storage/' . $provider->image) : '' }}" data-modal-target="editInsuranceModal" class="edit-insurance-btn p-2 rounded-lg bg-blue-50 dark:bg-blue-500/20 text-blue-500 hover:bg-blue-100 dark:hover:bg-blue-500/30 transition-colors duration-200">
                                        <i data-lucide="pencil" class="size-4"></i>
                                    </button>

                                    <button data-id="{{ $provider->id }}" data-modal-target="deleteInsuranceModal" class="delete-insurance-btn p-2 rounded-lg bg-red-50 dark:bg-red-500/20 text-red-500 hover:bg-red-100 dark:hover:bg-red-500/30 transition-colors duration-200">
                                        <i data-lucide="trash-2" class="size-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Add Insurance Modal -->
            <div id="addInsuranceModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add Insurance Provider</h5>
                        <button data-modal-close="addInsuranceModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data" id="create-insurance-form">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div>
                                        <label for="insuranceName" class="inline-block mb-2 text-base font-medium">Name</label>
                                        <input type="text" id="insuranceName" name="name" class="form-input" placeholder="Enter provider name" required>
                                    </div>
                                    <div>
                                        <label for="insuranceImage" class="inline-block mb-2 text-base font-medium">Image</label>
                                        <input type="file" id="insuranceImage" name="image" class="form-input">
                                    </div>
                                </div>
                                <div>
                                    <label for="hospitalIds" class="inline-block mb-2 text-base font-medium">Select Hospitals</label>
                                    <select id="hospitalIds" name="hospital_ids[]" class="form-input h-[150px]" multiple required>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
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
                                    <label for="hospitalIds" class="inline-block mb-2 text-base font-medium">Select Hospitals</label>
                                    <select id="hospitalIds" name="hospital_ids[]" class="form-input" multiple required>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="xl:col-span-12">
                                    <label for="editInsuranceImage" class="inline-block mb-2 text-base font-medium">Image</label>
                                    <input type="file" id="editInsuranceImage" name="image" class="form-input">
                                    <img id="currentInsuranceImage" src="" alt="Current Image" class="mt-2 h-16 rounded-md shadow-md">
                                </div> --}}


                                <div class="xl:col-span-12">
                                    <label for="editInsuranceImage" class="inline-block mb-2 text-base font-medium">Image</label>
                                    <input type="file" id="editInsuranceImage" name="image" class="form-input">
                                    <img id="currentInsuranceImage" src="" alt="Current Image" class="mt-2 h-16 rounded-md shadow-md hidden">
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
            const hospitalIds = JSON.parse(this.dataset.hospitalIds || '[]'); // Parse hospital IDs
            const image = this.dataset.image;

            // Populate modal fields
            document.getElementById('editInsuranceId').value = id;
            document.getElementById('editInsuranceName').value = name;

            // Handle hospital multi-select
            const hospitalSelect = document.getElementById('hospitalIds'); // Adjusted to match your ID
            Array.from(hospitalSelect.options).forEach(option => {
                option.selected = hospitalIds.includes(parseInt(option.value));
            });

            // Handle image preview
            const imagePreview = document.getElementById('currentInsuranceImage');
            if (image) {
                imagePreview.src = image; // Use the full URL passed in `data-image`
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

