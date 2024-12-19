@extends('layouts.master')

@section('content')
<br>
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">
                <!-- Profile Picture Card -->
                <div class="lg:col-span-4">
                    <!-- User Profile Card -->
                    <div class="card shadow-md">
                        <div class="card-body text-center">
                            <div class="relative inline-block rounded-full shadow-md size-28 bg-slate-100 profile-user">
                                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/images/avatar-10.png') }}" alt="Profile Image" class="object-cover border-0 rounded-full img-thumbnail user-profile-image">

                            </div>
                            <h5 class="mt-4">{{ $user->name }}</h5>
                            <p class="text-slate-500 dark:text-zink-200">{{ $user->role->name ?? 'Role not set' }}</p>
                            <p class="text-slate-500 dark:text-zink-200">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Change Password Card -->
                    <div class="card shadow-md mt-5">
                        <div class="card-body">
                            <h5 class="text-center">Change Password</h5>
                            <form action="{{ route('user.profile.update.password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="current_password" class="block text-sm font-medium">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-input w-full" placeholder="Enter current password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="block text-sm font-medium">New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-input w-full" placeholder="Enter new password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-input w-full" placeholder="Confirm new password" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- User Information Card -->
                <div class="lg:col-span-8">
                    <div class="card shadow-md">
                        <div class="card-body">
                            <h5 class="mb-3">User Information</h5>
                            <ul class="divide-y divide-slate-200 dark:divide-zink-500">
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Name</span>
                                    <span>{{ $user->name }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Email</span>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Role</span>
                                    <span>{{ $user->role->name ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Hospital</span>
                                    <span>{{ $user->hospital->name ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Insurance</span>
                                    <span>{{ $user->insurance->name ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">District</span>
                                    <span>{{ $user->district ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Sector</span>
                                    <span>{{ $user->sector ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Cell</span>
                                    <span>{{ $user->cell ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Province</span>
                                    <span>{{ $user->province ?? 'Not provided' }}</span>
                                </li>
                                <li class="py-2 flex justify-between">
                                    <span class="text-slate-500 dark:text-zink-200">Country</span>
                                    <span>{{ $user->country ?? 'Not provided' }}</span>
                                </li>
                            </ul>
                            <div class="mt-4 text-right">
                                <a href="#editProfileModal" data-modal-target="editProfileModal" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
    <div class="w-full max-w-sm bg-white shadow-lg rounded-md">
        <div class="p-3 border-b">
            <h5 class="text-lg font-semibold">Edit Profile</h5>
        </div>
        <div class="p-3">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input w-full">
                </div>
                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input w-full">
                </div>

                @if(auth()->user()->role && auth()->user()->role->name === 'SuperAdmin')
                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium">Role</label>
                    <select name="role_id" id="role" class="form-input w-full">
                        <option value="" disabled>Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="hospital" class="block text-sm font-medium">Hospital</label>
                    <select name="hospital_id" id="hospital" class="form-input w-full">
                        <option value="" disabled>Select Hospital</option>
                        @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" {{ $hospital->id == $user->hospital_id ? 'selected' : '' }}>
                            {{ $hospital->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                @endif

                @if(auth()->user()->role && auth()->user()->role->name === 'Admin')
                <div class="mb-3">
                    <label for="hospital" class="block text-sm font-medium">Hospital</label>
                    <select name="hospital_id" id="hospital" class="form-input w-full">
                        <option value="" disabled>Select Hospital</option>
                        @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" {{ $hospital->id == $user->hospital_id ? 'selected' : '' }}>
                            {{ $hospital->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="mb-3">
                    <label for="insurance" class="block text-sm font-medium">Insurance</label>
                    <select name="insurance_id" id="insurance" class="form-input w-full">
                        <option value="" disabled>Select Insurance</option>
                        @foreach ($insuranceProviders as $provider)
                        <option value="{{ $provider->id }}" {{ $provider->id == $user->insurance_id ? 'selected' : '' }}>
                            {{ $provider->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- District -->
                <div class="mb-3">
                    <label for="district" class="block text-sm font-medium">District</label>
                    <input type="text" name="district" id="district" value="{{ $user->district ?? '' }}" class="form-input w-full" placeholder="Enter district">
                </div>

                <!-- Sector -->
                <div class="mb-3">
                    <label for="sector" class="block text-sm font-medium">Sector</label>
                    <input type="text" name="sector" id="sector" value="{{ $user->sector ?? '' }}" class="form-input w-full" placeholder="Enter sector">
                </div>

                <!-- Cell -->
                <div class="mb-3">
                    <label for="cell" class="block text-sm font-medium">Cell</label>
                    <input type="text" name="cell" id="cell" value="{{ $user->cell ?? '' }}" class="form-input w-full" placeholder="Enter cell">
                </div>

                <!-- Province -->
                <div class="mb-3">
                    <label for="province" class="block text-sm font-medium">Province</label>
                    <input type="text" name="province" id="province" value="{{ $user->province ?? '' }}" class="form-input w-full" placeholder="Enter province">
                </div>

                <!-- Country -->
                <div class="mb-3">
                    <label for="country" class="block text-sm font-medium">Country</label>
                    <input type="text" name="country" id="country" value="{{ $user->country ?? '' }}" class="form-input w-full" placeholder="Enter country">
                </div>

                <!-- Profile Picture -->
                <div class="mb-3">
                    <label for="image" class="block text-sm font-medium">Profile Picture</label>
                    <input type="file" name="image" id="image" class="form-input w-full">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="reset" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
