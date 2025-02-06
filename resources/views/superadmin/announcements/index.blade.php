@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Manage Announcements</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Announcements
                </li>
            </ul>
            <button onclick="openCreateModal()" class="btn bg-custom-500 text-white border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                + Add Announcement
            </button>
        </div>

        {{-- @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @endif --}}

        <div class="card">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left bg-slate-100 dark:bg-zink-600">
                                <th class="px-6 py-3 text-sm font-semibold text-slate-800 dark:text-zink-50">Title</th>
                                <th class="px-6 py-3 text-sm font-semibold text-slate-800 dark:text-zink-50">Content</th>
                                <th class="px-6 py-3 text-sm font-semibold text-slate-800 dark:text-zink-50">Status</th>
                                <th class="px-6 py-3 text-sm font-semibold text-center text-slate-800 dark:text-zink-50">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                            @foreach($announcements as $announcement)
                            <tr class="border-b border-slate-200 dark:border-zink-500">
                                <td class="px-6 py-3 text-slate-700 dark:text-zink-100">{{ $announcement->title }}</td>
                                <td class="px-6 py-3 text-slate-700 dark:text-zink-100">{{ Str::limit($announcement->content, 50) }}</td>
                                <td class="px-6 py-3 text-slate-700 dark:text-zink-100">{{ $announcement->is_active ? 'Active' : 'Inactive' }}</td>
                                <td class="px-6 py-3 text-center">
                                    <button onclick="openEditModal({{ $announcement }})" class="p-2 text-custom-500 hover:text-custom-600 hover:bg-custom-50 dark:hover:bg-custom-500/10 rounded-lg transition-all duration-150">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal({{ $announcement->id }})" class="p-2 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all duration-150">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($announcements->isEmpty())
                    <p class="text-center text-slate-500 dark:text-zink-200 py-3">No announcements available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Create Announcement Modal -->
        <div id="createModal" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">

            <div class="bg-white dark:bg-zink-600 p-6 rounded-lg shadow-lg w-1/2">
                <h2 class="text-xl font-bold mb-4 text-slate-800 dark:text-zink-50">Create Announcement</h2>
                <form action="{{ route('superadmin.announcements.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block font-medium text-slate-700 dark:text-zink-100">Title</label>
                        <input type="text" name="title" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-slate-700 dark:text-zink-100">Content</label>
                        <textarea name="content" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-slate-700 dark:text-zink-100">Start Date</label>
                        <input type="date" name="start_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800">
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-slate-700 dark:text-zink-100">End Date</label>
                        <input type="date" name="end_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800">
                    </div>
                    <div class="mb-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked class="form-checkbox text-custom-500">
                            <span class="ml-2 text-slate-700 dark:text-zink-100">Active</span>
                        </label>
                    </div>
                    <button type="submit" class="btn bg-custom-500 text-white border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Save</button>
                    <button type="button" onclick="closeCreateModal()" class="ml-2 text-slate-500 dark:text-zink-200">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Edit Announcement Modal -->
        <div id="editModal" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="bg-white dark:bg-zink-600 p-6 rounded-lg shadow-lg w-1/2">
                <h2 class="text-xl font-bold mb-4 text-slate-800 dark:text-zink-50">Edit Announcement</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block font-medium text-slate-700 dark:text-zink-100">Title</label>
                            <input type="text" id="editTitle" name="title" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                        </div>
                        <div class="mb-3">
                            <label class="block font-medium text-slate-700 dark:text-zink-100">Start Date</label>
                            <input type="date" id="editStartDate" name="start_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800">
                        </div>
                        <div class="mb-3">
                            <label class="block font-medium text-slate-700 dark:text-zink-100">Content</label>
                            <textarea id="editContent" name="content" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="block font-medium text-slate-700 dark:text-zink-100">End Date</label>
                            <input type="date" id="editEndDate" name="end_date" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="editIsActive" name="is_active" value="1" class="form-checkbox text-custom-500">
                            <span class="ml-2 text-slate-700 dark:text-zink-100">Active</span>
                        </label>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="submit" class="btn bg-custom-500 text-white border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                        <button type="button" onclick="closeEditModal()" class="text-slate-500 dark:text-zink-200">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Announcement Modal -->
        <div id="deleteModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
                <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                    <h5 class="text-16">Delete Announcement</h5>
                    <button onclick="closeDeleteModal()" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-600 dark:text-slate-300">
                        Are you sure you want to delete this announcement? This action cannot be undone.
                    </p>
                    <form id="deleteForm" method="POST" class="flex justify-end gap-2 mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="closeDeleteModal()" class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100">Cancel</button>
                        <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openCreateModal() {
                document.getElementById('createModal').classList.remove('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openEditModal(announcement) {
                document.getElementById('editId').value = announcement.id;
                document.getElementById('editTitle').value = announcement.title;
                document.getElementById('editContent').value = announcement.content;
                document.getElementById('editStartDate').value = announcement.start_date;
                document.getElementById('editEndDate').value = announcement.end_date;
                document.getElementById('editIsActive').checked = announcement.is_active == 1;

                // Set the correct form action URL dynamically
                document.getElementById('editForm').action = `/superadmin/announcements/${announcement.id}`;

                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function openDeleteModal(id) {
                document.getElementById('deleteForm').action = `/superadmin/announcements/${id}`;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

        </script>
    </div>
</div>
@endsection
