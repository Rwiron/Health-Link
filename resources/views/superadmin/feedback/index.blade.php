@extends('layouts.master')

@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">

        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Client Feedback</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2">
                            <li><a href="#" class="text-sm text-slate-500 hover:text-slate-700">Dashboard</a></li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="ml-2 text-sm font-medium text-slate-700">Feedback Management</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-700">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">Message</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($feedbacks as $feedback)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">{{ $feedback->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">{{ $feedback->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <div class="max-w-xs overflow-hidden">
                                        {{ Str::limit($feedback->message, 50) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="openReplyModal({{ $feedback }})" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-blue-500 text-sm font-medium rounded-md hover:bg-blue-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                            Reply
                                        </button>
                                        <form action="{{ route('superadmin.feedback.destroy', $feedback->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-600 hover:text-red-900 focus:outline-none transition-colors duration-150" onclick="return confirm('Are you sure you want to delete this feedback?')">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-xl p-8 w-full max-w-2xl mx-4 transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Reply to Feedback</h2>
            <button onclick="closeReplyModal()" class="text-slate-400 hover:text-slate-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
            <p class="text-slate-600 dark:text-slate-300 mb-2"><span class="font-semibold">From:</span> <span id="replyName" class="text-slate-900 dark:text-white"></span> (<span id="replyEmail" class="text-blue-500"></span>)</p>
            <p class="text-slate-600 dark:text-slate-300"><span class="font-semibold">Message:</span> <span id="replyMessage" class="text-slate-900 dark:text-white"></span></p>
        </div>
        <form id="replyForm" action="" method="POST" class="space-y-4">
            @csrf
            <div>
                <textarea name="message" rows="4" class="w-full p-3 border border-slate-200 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400" required placeholder="Type your response here..."></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeReplyModal()" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-colors duration-150">
                    Cancel
                </button>
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-blue-500 text-sm font-medium rounded-md hover:bg-blue-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">

                    Send Reply
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReplyModal(feedback) {
        document.getElementById('replyName').textContent = feedback.name;
        document.getElementById('replyEmail').textContent = feedback.email;
        document.getElementById('replyMessage').textContent = feedback.message;
        document.getElementById('replyForm').action = `/superadmin/feedback/${feedback.id}/reply`;
        document.getElementById('replyModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeReplyModal() {
        document.getElementById('replyModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

</script>
@endsection
