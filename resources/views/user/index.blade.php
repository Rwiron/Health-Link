@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center">
                <div class="grow">
                    <h5 class="text-16">User Management</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal">
                    <li>
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        User Management
                    </li>
                </ul>
            </div>

            <div class="card" id="userTable">
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <h6 class="text-15 grow">Users ({{ $users->count() }})</h6>
                        <div class="shrink-0">
                            <a href="#!" data-modal-target="addUserModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add User</span>
                            </a>
                        </div>
                    </div>

                    <div class="-mx-5 overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr class="bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Profile</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Name</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Hospital</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Insurance</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Role</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Email</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Account Created at</th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="px-3.5 py-2.5">
                                        @if ($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="h-10 w-10 rounded-full shadow-md">
                                        @else
                                        <span class="text-slate-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5">{{ $user->name }}</td>
                                    <td class="px-3.5 py-2.5">
                                        {{ $user->hospital ? $user->hospital->name : 'Not Available' }}
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        {{ $user->insurance->name ?? 'No Insurance' }}
                                    </td>

                                    <td class="px-3.5 py-2.5">{{ $user->role->name ?? 'N/A' }}</td>
                                    <td class="px-3.5 py-2.5">{{ $user->email }}</td>
                                    <td class="px-3.5 py-2.5">{{ $user->created_at }}</td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="flex gap-3">
                                            <a href="#!" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role-id="{{ $user->role_id }}" data-hospital-id="{{ $user->hospital_id }}" data-insurance-id="{{ $user->insurance_id }}" data-image="{{ $user->image }}" data-modal-target="editUserModal" class="edit-user-btn text-blue-500">
                                                <i data-lucide="pencil" class="size-4"></i>
                                            </a>

                                            <a href="#!" data-id="{{ $user->id }}" data-modal-target="deleteUserModal" class="delete-user-btn text-red-500">
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

            <!-- Add User Modal -->
            <div id="addUserModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Add User</h5>
                        <button data-modal-close="addUserModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="create-user-form">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="userName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="userName" name="name" class="form-input" placeholder="Enter user name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="userEmail" class="inline-block mb-2 text-base font-medium">Email</label>
                                    <input type="email" id="userEmail" name="email" class="form-input" placeholder="Enter email" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="userRole" class="inline-block mb-2 text-base font-medium">Role</label>
                                    <select id="userRole" name="role_id" class="form-input">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="hospital_id" class="inline-block mb-2 text-base font-medium">Select Hospital</label>
                                    <select id="hospital_id" name="hospital_id" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                        <option value="" disabled selected>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="editInsuranceId" class="inline-block mb-2 text-base font-medium">Insurance Provider</label>
                                    <select id="editInsuranceId" name="insurance_id" class="form-input">
                                        <option value="" selected>No Insurance</option>
                                        @foreach ($insuranceProviders as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="xl:col-span-12">
                                    <label for="userPassword" class="inline-block mb-2 text-base font-medium">Password</label>
                                    <input type="password" id="userPassword" name="password" class="form-input" placeholder="Enter password" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="userProfileImage" class="inline-block mb-2 text-base font-medium">Profile Image</label>
                                    <input type="file" id="userProfileImage" name="image" class="form-input">
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="addUserModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add User Modal -->

            <!-- Edit User Modal -->
            <div id="editUserModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Edit User</h5>
                        <button data-modal-close="editUserModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <form id="edit-user-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" id="editUserId">
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-12">
                                <div class="xl:col-span-12">
                                    <label for="editUserName" class="inline-block mb-2 text-base font-medium">Name</label>
                                    <input type="text" id="editUserName" name="name" class="form-input" placeholder="User name" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editUserEmail" class="inline-block mb-2 text-base font-medium">Email</label>
                                    <input type="email" id="editUserEmail" name="email" class="form-input" placeholder="User email" required>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editUserRole" class="inline-block mb-2 text-base font-medium">Role</label>
                                    <select id="editUserRole" name="role_id" class="form-input">
                                        <option value="" disabled>Select Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="xl:col-span-12">
                                    <label for="editHospitalId" class="inline-block mb-2 text-base font-medium">Hospital</label>
                                    <select id="editHospitalId" name="hospital_id" class="form-input">
                                        <option value="" disabled>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="editInsuranceId" class="inline-block mb-2 text-base font-medium">Insurance Provider</label>
                                    <select id="editInsuranceId" name="insurance_id" class="form-input">
                                        <option value="" selected>No Insurance</option>
                                        @foreach ($insuranceProviders as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="xl:col-span-12">
                                    <label for="editUserImage" class="inline-block mb-2 text-base font-medium">Profile Image</label>
                                    <input type="file" id="editUserImage" name="image" class="form-input">
                                    <img id="currentImage" src="" alt="Current Image" class="mt-2 h-16 rounded-md shadow-md">
                                </div>
                            </div>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="editUserModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Delete User Modal -->
            <div id="deleteUserModal" modal-center="" class="fixed hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
                <div class="w-screen md:w-[25rem] bg-white shadow rounded-md dark:bg-zink-600">
                    <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                        <h5 class="text-16">Delete User</h5>
                        <button data-modal-close="deleteUserModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                    <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                        <p class="text-slate-500">Are you sure you want to delete this user?</p>
                        <form id="delete-user-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteUserId">
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="reset" data-modal-close="deleteUserModal" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                                <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Other modals follow the same pattern -->
        </div>
    </div>
</div>


<script>
    // Edit User Modal
    document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editUserModal');

            // Fetch data attributes
            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const role = this.dataset.roleId;
            const hospital = this.dataset.hospitalId;
            const insurance = this.dataset.insuranceId;
            const image = this.dataset.image;

            // Populate modal fields
            document.getElementById('editUserId').value = id;
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            document.getElementById('editUserRole').value = role;
            document.getElementById('editHospitalId').value = hospital;
            document.getElementById('editInsuranceId').value = insurance;

            // Handle image preview
            const imagePreview = document.getElementById('currentImage');
            if (image) {
                imagePreview.src = `/storage/${image}`; // Adjust path if necessary
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
            }

            // Set the form action dynamically
            document.getElementById('edit-user-form').action = `/user/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });





    // Delete User Modal
    document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('deleteUserModal');
            const id = this.dataset.id;

            // Set the form action dynamically
            document.getElementById('delete-user-form').action = `/user/${id}`;

            // Show the modal
            modal.classList.remove('hidden');
        });
    });

</script>



@endsection
