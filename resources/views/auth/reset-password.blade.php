<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - HealthLink</title>
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
            box-shadow: 0 4px 20px rgba(145, 129, 250, 0.15);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #9181FA 0%, #7B6CF6 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(145, 129, 250, 0.3);
        }

    </style>
</head>
<body class="min-h-screen flex bg-gray-50">
    <!-- Left Section -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#484276] to-[#2d2847] text-white flex-col items-center justify-center p-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQ0MCIgaGVpZ2h0PSI3NjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IHgxPSIwIiB5MT0iMCIgeDI9IjEiIHkyPSIxIiBpZD0iZyI+PHN0b3Agc3RvcC1jb2xvcj0iIzMzMyIgc3RvcC1vcGFjaXR5PSIwLjEiIG9mZnNldD0iMCUiLz48c3RvcCBzdG9wLWNvbG9yPSIjMzMzIiBzdG9wLW9wYWNpdHk9IjAuMSIgb2Zmc2V0PSIxMDAlIi8+PC9saW5lYXJHcmFkaWVudD48L2RlZnM+PHBhdGggZD0iTTAgMGgxNDQwdjc2MEgweiIgZmlsbD0idXJsKCNnKSIvPjwvc3ZnPg==')] opacity-10"></div>
        <img src="{{ asset('assets/images/Logoicons.png') }}" alt="" class="w-24 h-24 mb-8 animate__animated animate__fadeIn">
        <h1 class="text-5xl font-bold mb-6 animate__animated animate__fadeInUp">Reset Password</h1>
        <p class="text-xl text-gray-300 text-center animate__animated animate__fadeInUp animate__delay-1s">
            Create a new password for your account
        </p>
    </div>

    <!-- Right Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md glass-effect p-10 rounded-2xl animate__animated animate__fadeIn">
            <h2 class="text-4xl font-bold mb-3 text-gray-800">Reset Password</h2>
            <p class="text-gray-500 mb-8 text-lg">Enter your new password below</p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <div class="relative">
                        <input type="email" id="email" name="email" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#9181FA] bg-gray-50" placeholder="Email" required>
                        @error('email')
                        <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#9181FA] bg-gray-50" placeholder="New Password" required>
                        @error('password')
                        <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field w-full px-5 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#9181FA] bg-gray-50" placeholder="Confirm Password" required>
                    </div>
                </div>

                <button type="submit" class="btn-gradient w-full text-white py-4 px-6 rounded-xl text-lg font-semibold">
                    Reset Password
                </button>

                <div class="text-center mt-8">
                    <p class="text-gray-600">
                        <a href="{{ route('login') }}" class="font-semibold text-[#9181FA] hover:text-[#7B6CF6] transition-colors">
                            Back to Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
