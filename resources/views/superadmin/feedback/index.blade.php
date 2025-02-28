@extends('layouts.master')

@section('content')
<div class="relative min-h-screen bg-gray-50 dark:bg-slate-900">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white">Client Feedback & Responses</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-2">Manage client questions and respond to them in a structured way.</p>
        </div>

        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800/30 dark:text-green-400 border border-green-200 dark:border-green-800">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white dark:bg-slate-800 shadow-xl rounded-xl overflow-hidden border border-gray-100 dark:border-slate-700">
            <div class="p-8">
                <div class="space-y-6">
                    @foreach($feedbacks as $feedback)
                    <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-xl border border-gray-200 dark:border-slate-600 hover:shadow-md transition duration-200">
                        <!-- User Feedback -->
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $feedback->name }}</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $feedback->created_at->diffForHumans() }}</span>
                            </div>
                            <form action="{{ route('superadmin.feedback.destroy', $feedback->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition duration-200" onclick="return confirm('Are you sure?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-4">{{ $feedback->message }}</p>

                        <!-- Replies Section -->
                        <div class="mt-4 pl-6 border-l-4 border-indigo-300 dark:border-indigo-500 space-y-3">
                            @foreach($feedback->replies as $reply)
                            <div class="bg-white dark:bg-slate-800 p-3 rounded-lg shadow-sm">
                                <p class="text-base {{ $reply->sender === 'admin' ? 'text-indigo-600 dark:text-indigo-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                    <strong>{{ $reply->sender === 'admin' ? 'Admin' : 'User' }}:</strong> {{ $reply->message }}
                                </p>
                            </div>
                            @endforeach
                        </div>

                        <!-- Reply Button -->
                        <div class="mt-4">
                            @if(!$feedback->replies->count())
                            <button onclick="openReplyModal({{ $feedback }})" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-blue-500 text-sm font-medium rounded-md hover:bg-blue-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                Reply
                            </button>
                            @else
                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-400 rounded-lg text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Replied
                            </span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 hidden bg-gray-900/75 backdrop-blur-sm flex justify-center items-center z-50">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-2xl p-8 w-full max-w-2xl mx-4 animate-fade-in-up">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Reply to Feedback</h2>
        <div class="mb-6 bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg">
            <p class="text-slate-700 dark:text-slate-300 mb-2"><strong>From:</strong> <span id="replyName"></span> (<span id="replyEmail"></span>)</p>
            <p class="text-slate-700 dark:text-slate-300"><strong>Message:</strong> <span id="replyMessage"></span></p>
        </div>
        <form id="replyForm" action="" method="POST">
            @csrf
            <textarea name="message" class="w-full p-4 border border-gray-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent" rows="4" required placeholder="Type your response here..."></textarea>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeReplyModal()" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-gray-700 dark:text-gray-300 rounded-lg transition duration-200">Cancel</button>
                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-blue-500 text-sm font-medium rounded-md hover:bg-blue-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">Send Reply</button>

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
