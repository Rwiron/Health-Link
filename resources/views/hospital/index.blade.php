@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">Hospital Management</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Hospital Management
                    </li>
                </ul>
            </div>

            <div class="card" id="hospitalTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Hospitals ({{ $hospitals->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addHospitalModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Hospital</span>
                            </a>
                        </div>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Logo</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Name</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Address</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Phone</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Organization Type</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Created at</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hospitals as $hospital)
                                <tr>
                                    <td class="px-3.5 py-2.5">
                                        @if ($hospital->logo)
                                        <img src="{{ asset('storage/' . $hospital->logo) }}" alt="Hospital Logo" class="h-10 w-10 rounded-full shadow-md">
                                        @else
                                        <span class="text-slate-400">No Logo</span>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5">{{ $hospital->name }}</td>
                                    <td class="px-3.5 py-2.5">{{ $hospital->address }}</td>
                                    <td class="px-3.5 py-2.5">{{ $hospital->phone }}</td>
                                    <td class="px-3.5 py-2.5">{{ $hospital->organization_type }}</td>
                                    <td class="px-3.5 py-2.5">{{ $hospital->created_at }}</td>

                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-3">
                                            <a href="#!" data-id="{{ $hospital->id }}" data-name="{{ $hospital->name }}" data-address="{{ $hospital->address }}" data-phone="{{ $hospital->phone }}" data-organization-type="{{ $hospital->organization_type }}" data-logo="{{ $hospital->logo }}" data-latitude="{{ $hospital->latitude }}" data-longitude="{{ $hospital->longitude }}" data-modal-target="editHospitalModal" class="edit-hospital-btn">
                                                Edit
                                            </a>


                                            <a href="#!" data-id="{{ $hospital->id }}" data-modal-target="deleteHospitalModal" class="delete-hospital-btn">
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

            <div id="addHospitalModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add Hospital</h5>
                        <button data-modal-close="addHospitalModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('hospital.store') }}" method="POST" enctype="multipart/form-data" id="create-hospital-form">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="hospitalName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="hospitalName" name="name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" placeholder="Enter hospital name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="hospitalAddress" class="inline-block mb-2 text-base font-medium">Address</label>
                                    <textarea id="hospitalAddress" name="address" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" placeholder="Enter address"></textarea>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="hospitalPhone" class="inline-block mb-2 text-base font-medium">Phone</label>
                                    <input type="text" id="hospitalPhone" name="phone" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="organizationType" class="inline-block mb-2 text-base font-medium">Organization Type</label>
                                <select id="organizationType" name="organization_type" class="form-input">
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                    <option value="Mixture">Mixture</option>
                                </select>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="hospitalLogo" class="inline-block mb-2 text-base font-medium">Logo</label>
                                <input type="file" id="hospitalLogo" name="logo" class="form-input">
                            </div>

                            <!-- Map Frame -->
                            <div class="xl:col-span-12">
                                <label for="locationPickerMap" class="inline-block mb-2 text-base font-medium">Pick Location</label>
                                <div class="rounded border border-slate-200 dark:border-zink-500 overflow-hidden">
                                    <div id="locationPickerMap" style="height: 300px; border: none;"></div>
                                </div>
                                <small class="text-slate-500">Drag the marker or click on the map to pick a location.</small>
                            </div>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="addHospitalModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Add Hospital</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div id="editHospitalModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Edit Hospital</h5>
                        <button data-modal-close="editHospitalModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form id="edit-hospital-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" id="editHospitalId">
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="editHospitalName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="editHospitalName" name="name" class="form-input" placeholder="Hospital name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editHospitalAddress" class="inline-block mb-2 text-base font-medium">Address</label>
                                    <textarea id="editHospitalAddress" name="address" class="form-input" placeholder="Hospital address"></textarea>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editHospitalPhone" class="inline-block mb-2 text-base font-medium">Phone</label>
                                    <input type="text" id="editHospitalPhone" name="phone" class="form-input" placeholder="Phone number">
                                </div>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="editOrganizationType" class="inline-block mb-2 text-base font-medium">Organization Type</label>
                                <select id="editOrganizationType" name="organization_type" class="form-input">
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                    <option value="Mixture">Mixture</option>
                                </select>
                            </div>
                            <div class="xl:col-span-12">
                                <label for="editHospitalLogo" class="inline-block mb-2 text-base font-medium">Logo</label>
                                <input type="file" id="editHospitalLogo" name="logo" class="form-input">
                                <img id="currentLogo" src="" alt="Current Logo" class="mt-2 h-16 rounded-md shadow-md">
                            </div>

                            <!-- Map Frame -->
                            <div class="xl:col-span-12">
                                <label for="editLocationPickerMap" class="inline-block mb-2 text-base font-medium">Pick Location</label>
                                <div class="rounded border border-slate-200 dark:border-zink-500 overflow-hidden">
                                    <div id="editLocationPickerMap" style="height: 300px; border: none;"></div>
                                </div>
                                <small class="text-slate-500">Drag the marker or click on the map to pick a location.</small>
                            </div>
                            <input type="hidden" id="editLatitude" name="latitude">
                            <input type="hidden" id="editLongitude" name="longitude">

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="editHospitalModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>







            <!-- Delete Hospital Modal -->
            <div id="deleteHospitalModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Delete Hospital</h5>
                        <button data-modal-close="deleteHospitalModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <p class="text-slate-500">Are you sure you want to delete this hospital?</p>
                        <form id="delete-hospital-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteHospitalId">
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="deleteHospitalModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    // Add Modal Logic
    document.querySelector('[data-modal-target="addHospitalModal"]').addEventListener('click', () => {
        document.getElementById('addHospitalModal').classList.remove('hidden');
    });

    document.querySelectorAll('.edit-hospital-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editHospitalModal');

            // Fetch data attributes
            const id = this.dataset.id;
            const name = this.dataset.name;
            const address = this.dataset.address;
            const phone = this.dataset.phone;
            const organizationType = this.dataset.organizationType;
            const logo = this.dataset.logo;
            const location = this.dataset.location;

            // Populate modal fields
            document.getElementById('editHospitalId').value = id;
            document.getElementById('editHospitalName').value = name;
            document.getElementById('editHospitalAddress').value = address;
            document.getElementById('editHospitalPhone').value = phone;
            document.getElementById('editOrganizationType').value = organizationType;
            document.getElementById('editHospitalLocation').value = location;

            // Handle logo
            const logoPreview = document.getElementById('currentLogo');
            if (logo) {
                logoPreview.src = `/storage/${logo}`; // Assuming logos are stored in the `public/storage` directory
                logoPreview.classList.remove('hidden');
            } else {
                logoPreview.src = '';
                logoPreview.classList.add('hidden');
            }

            // Set the form action dynamically
            document.getElementById('edit-hospital-form').action = `/hospital/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

    // Delete Hospital Modal
    document.querySelectorAll('.delete-hospital-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteHospitalModal');
            document.getElementById('deleteHospitalId').value = this.dataset.id;
            document.getElementById('delete-hospital-form').action = `/hospital/${this.dataset.id}`;
            modal.classList.remove('hidden');
        });
    });

</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Center map on Kigali
        const kigaliLat = -1.9441;
        const kigaliLng = 30.0619;
        const map = L.map('locationPickerMap').setView([kigaliLat, kigaliLng], 12); // Zoom level 12 for city view

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a draggable marker at the center
        const marker = L.marker([kigaliLat, kigaliLng], {
            draggable: true
        }).addTo(map);

        // Update latitude and longitude inputs on marker drag end
        marker.on('dragend', function(e) {
            const lat = marker.getLatLng().lat.toFixed(8);
            const lng = marker.getLatLng().lng.toFixed(8);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Update marker and inputs on map click
        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(8);
            const lng = e.latlng.lng.toFixed(8);
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    });

</script>




<script>
    function initializeEditMap(lat, lng) {
        // If latitude and longitude are not provided, default to Kigali
        const defaultLat = lat || -1.9441;
        const defaultLng = lng || 30.0619;
        const zoomLevel = lat && lng ? 15 : 12;

        // Initialize the map
        const map = L.map('editLocationPickerMap').setView([defaultLat, defaultLng], zoomLevel);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Add a draggable marker at the specified location
        const marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        // Update latitude and longitude inputs on marker drag end
        marker.on('dragend', function(e) {
            const lat = marker.getLatLng().lat.toFixed(8);
            const lng = marker.getLatLng().lng.toFixed(8);
            document.getElementById('editLatitude').value = lat;
            document.getElementById('editLongitude').value = lng;
        });

        // Update marker and inputs on map click
        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(8);
            const lng = e.latlng.lng.toFixed(8);
            marker.setLatLng(e.latlng);
            document.getElementById('editLatitude').value = lat;
            document.getElementById('editLongitude').value = lng;
        });

        // Set initial values for latitude and longitude inputs
        document.getElementById('editLatitude').value = defaultLat.toFixed(8);
        document.getElementById('editLongitude').value = defaultLng.toFixed(8);
    }

    // Edit Hospital Modal Logic
    document.querySelectorAll('.edit-hospital-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editHospitalModal');

            // Fetch data attributes
            const id = this.dataset.id;
            const name = this.dataset.name;
            const address = this.dataset.address;
            const phone = this.dataset.phone;
            const organizationType = this.dataset.organizationType;
            const logo = this.dataset.logo;
            const latitude = this.dataset.latitude ? parseFloat(this.dataset.latitude) : null;
            const longitude = this.dataset.longitude ? parseFloat(this.dataset.longitude) : null;

            // Populate modal fields
            document.getElementById('editHospitalId').value = id;
            document.getElementById('editHospitalName').value = name;
            document.getElementById('editHospitalAddress').value = address;
            document.getElementById('editHospitalPhone').value = phone;
            document.getElementById('editOrganizationType').value = organizationType;

            // Handle logo display
            const logoPreview = document.getElementById('currentLogo');
            if (logo) {
                logoPreview.src = `/storage/${logo}`; // Adjust the path if necessary
                logoPreview.classList.remove('hidden');
            } else {
                logoPreview.src = '';
                logoPreview.classList.add('hidden');
            }

            // Initialize the map
            setTimeout(() => { // Delay to ensure the modal is rendered
                initializeEditMap(latitude, longitude);
            }, 300);

            // Set the form action dynamically
            document.getElementById('edit-hospital-form').action = `/hospital/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

</script>




@endsection
