<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - HealthLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f6f8fd 0%, #ffffff 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-5%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

    </style>
</head>
<body class="min-h-screen flex bg-gray-50">
    <!-- Left Section -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#1E40AF] to-[#1E3A8A] text-white flex-col items-center justify-center p-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI3NjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IHgxPSIwIiB5MT0iMCIgeDI9IjEiIHkyPSIxIiBpZD0iZyI+PHN0b3Agc3RvcC1jb2xvcj0iIzMzMyIgc3RvcC1vcGFjaXR5PSIwLjEiIG9mZnNldD0iMCUiLz48c3RvcCBzdG9wLWNvbG9yPSIjMzMzIiBzdG9wLW9wYWNpdHk9IjAuMSIgb2Zmc2V0PSIxMDAlIi8+PC9saW5lYXJHcmFkaWVudD48L2RlZnM+PHBhdGggZD0iTTAgMGgxNDQwdjc2MEgweiIgZmlsbD0idXJsKCNnKSIvPjwvc3ZnPg==')] opacity-10"></div>
        <img src="assets/images/Logoicons.png" alt="" class="w-24 h-24 mb-8 animate__animated animate__fadeIn">
        <h1 class="text-5xl font-bold mb-6 animate__animated animate__fadeInUp">Create Account</h1>
        <p class="text-xl text-gray-300 text-center animate__animated animate__fadeInUp animate__delay-1s">
            Join HealthLink and start your journey with us
        </p>
    </div>

    <!-- Right Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <!-- Modern floating back button with animation - now fixed position -->
        <a href="{{ url('/') }}" class="fixed top-8 left-8 group z-50">
            <div class="p-3 rounded-xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-bounce-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
        </a>

        <div class="w-full max-w-md glass-effect p-10 rounded-2xl animate__animated animate__fadeIn">
            <h2 class="text-4xl font-bold mb-3 text-gray-800">Sign Up</h2>
            <p class="text-gray-500 mb-8 text-lg">Create your account to get started</p>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <div class="relative">
                        <input type="text" id="name" name="name" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#3B82F6] bg-gray-50" placeholder="Full Name" required>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="email" id="email" name="email" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#3B82F6] bg-gray-50" placeholder="Email" required>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#3B82F6] bg-gray-50" placeholder="Password" required>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#3B82F6] bg-gray-50" placeholder="Confirm Password" required>
                    </div>
                </div>

                <button type="submit" class="btn-gradient w-full text-white py-4 px-6 rounded-xl text-lg font-semibold">
                    Sign Up
                </button>

                <div class="text-center mt-8">
                    <p class="text-gray-600 text-lg">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-[#3B82F6] hover:text-[#2563EB] transition-colors">
                            Sign In
                        </a>
                    </p>
                    <p class="text-gray-600 mt-3">
                        <a href="{{ url('/') }}" class="font-semibold text-[#3B82F6] hover:text-[#2563EB] transition-colors">
                            Go back
                        </a>
                        to website
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
