<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HealthLink - Your Health, Our Priority</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        @keyframes slideLeft {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-left {
            animation: slideLeft 0.5s ease-out;
        }

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        /* Responsive styles */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .hero-content {
                text-align: center;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .container {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1025px) {
            .container {
                max-width: 1280px;
                margin: 0 auto;
            }
        }

    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6'
                        , secondary: '#10B981'
                    , }
                    , screens: {
                        'xs': '375px'
                        , 'sm': '640px'
                        , 'md': '768px'
                        , 'lg': '1024px'
                        , 'xl': '1280px'
                        , '2xl': '1536px'
                    , }
                }
            , }
        , }

    </script>
</head>

<body class="min-h-screen flex flex-col font-inter bg-gray-50">
    <!-- Sliding Announcement Banner -->
    <div id="announcement-banner" class="bg-gradient-to-r from-primary to-secondary text-white py-2 sm:py-3 px-4 text-center text-xs sm:text-sm font-medium overflow-hidden">
        <p class="animate-slide-left">
            COVID-19 Update: We're here to help. Learn more about our safety measures.
        </p>
    </div>

    <!-- Navbar -->
    <nav class="bg-white shadow-lg py-3 sm:py-4 px-4 sm:px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <h1 class="text-xl sm:text-2xl font-bold text-primary">HealthLink</h1>
            </div>
            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-4 lg:space-x-6">
                <a href="#" class="text-gray-600 hover:text-primary transition-colors">Home</a>
                <a href="#hospitals" class="text-gray-600 hover:text-primary transition-colors">Hospitals</a>
                {{-- <a href="#" class="text-gray-600 hover:text-primary transition-colors">Services</a> --}}
                <a href="#contact" class="text-gray-600 hover:text-primary transition-colors">Contact</a>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2 text-primary hover:text-primary-dark transition-colors">Login</a>
                <a href="{{ route('register') }}" class="px-4 sm:px-6 py-2 bg-primary text-white rounded-full hover:bg-primary-dark transition-colors shadow-md hover:shadow-lg">
                    Register
                </a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Navigation Panel -->
        <div id="mobile-menu" class="md:hidden hidden mt-4">
            <a href="#" class="block px-4 py-2 text-gray-600 hover:text-primary transition-colors">Home</a>
            <a href="#hospitals" class="block px-4 py-2 text-gray-600 hover:text-primary transition-colors">Hospitals</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:text-primary transition-colors">Services</a>
            <a href="#contact" class="block px-4 py-2 text-gray-600 hover:text-primary transition-colors">Contact</a>
            <div class="flex justify-around mt-4">
                <a href="{{ route('login') }}" class="px-4 py-2 text-primary hover:text-primary-dark transition-colors">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-white rounded-full hover:bg-primary-dark transition-colors shadow-md hover:shadow-lg">
                    Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative flex-grow flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 sm:py-24 px-4 sm:px-6 overflow-hidden">
        <!-- Background Image with Dark Overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1538108149393-fbbd81895907')] bg-cover bg-center">
            </div>
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-8">
            <!-- Text Content -->
            <div class="max-w-2xl text-center lg:text-left">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 sm:mb-8 leading-tight">
                    HealthLink
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl mb-8 sm:mb-10 opacity-90">
                    Find and connect with the best hospitals and healthcare providers near you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('login') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-white text-blue-600 rounded-full text-base sm:text-lg font-semibold hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center justify-center">
                        Find Hospitals
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="px-6 sm:px-8 py-3 sm:py-4 bg-transparent border-2 border-white text-white rounded-full text-base sm:text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all inline-flex items-center justify-center">
                        Book Appointment
                    </a>
                </div>
            </div>

            <!-- Hero Announcement Card -->
            <div class="w-full max-w-md animate-slide-left">
                <div class="bg-white/95 backdrop-blur-sm p-4 sm:p-6 rounded-2xl shadow-xl border border-white/20">
                    <div class="flex items-center space-x-3 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 sm:h-6 w-5 sm:w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <h4 class="text-primary font-semibold">Latest Updates</h4>
                    </div>
                    <div id="hero-announcement" class="text-gray-700 transition-opacity duration-300">
                        <p class="text-sm sm:text-base font-medium">
                            COVID-19 Update: We're here to help. Learn more about our safety measures.
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xs sm:text-sm text-gray-500" id="announcement-counter">1/3</span>
                        <div class="flex space-x-2">
                            <button onclick="prevAnnouncement()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button onclick="nextAnnouncement()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hospital Section -->
    {{-- <section id="hospitals" class="py-12 sm:py-20 px-4 sm:px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-8 sm:mb-16">Featured Hospitals</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($hospitals as $hospital)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                    <img src="{{ asset('storage/' . $hospital->logo) }}" alt="{{ $hospital->name }}" class="w-full h-48 object-cover">

    <div class="p-4 sm:p-6">
        <h3 class="text-xl sm:text-2xl font-semibold mb-2">{{ $hospital->name }}</h3>
        <p class="text-gray-600 mb-4">
            {{ $hospital->description ?? 'No description available.' }}
        </p>
    </div>
    </div>
    @endforeach
    </div>
    </div>
    </section> --}}




    <section id="hospitals" class="py-16 sm:py-24 px-4 sm:px-6 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-teal-500 mb-4">Featured Hospitals</h2>
                <p class="text-gray-600 text-lg">Find the perfect healthcare facility for your needs</p>
            </div>

            <!-- Filter Dropdown -->
            <div class="mb-12">
                <div class="flex flex-col items-center space-y-4">
                    <form method="GET" action="{{ route('home') }}" class="w-full max-w-md">
                        <div class="relative">
                            <select name="organization_type" onchange="this.form.submit()" class="w-full appearance-none bg-white pl-4 pr-12 py-3 rounded shadow-md border border-gray-100 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all text-gray-700 text-sm font-medium">
                                <option value="All" {{ request('organization_type') == 'All' ? 'selected' : '' }}>All Facilities</option>
                                <option value="Public Hospital" {{ request('organization_type') == 'Public Hospital' ? 'selected' : '' }}>Public Hospital</option>
                                <option value="Private Hospital" {{ request('organization_type') == 'Private Hospital' ? 'selected' : '' }}>Private Hospital</option>
                                <option value="Public Clinic" {{ request('organization_type') == 'Public Clinic' ? 'selected' : '' }}>Public Clinic</option>
                                <option value="Private Clinic" {{ request('organization_type') == 'Private Clinic' ? 'selected' : '' }}>Private Clinic</option>
                                <option value="Mixture" {{ request('organization_type') == 'Mixture' ? 'selected' : '' }}>Mixture</option>
                            </select>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </form>
                    <div class="text-sm text-gray-600">
                        Found {{ $hospitals->count() }} {{ Str::plural('health facility', $hospitals->count()) }}
                        @if(request('organization_type') && request('organization_type') != 'All')
                        in {{ request('organization_type') }} category
                        @endif
                    </div>
                </div>
            </div>

            <!-- Display Filtered Hospitals -->
            <div id="hospitals-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 transition-all duration-500 ease-in-out">
                @foreach($hospitals->take(3) as $hospital)
                <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hospital-card opacity-0 transform translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards {{ $loop->index * 0.2 }}s">
                    <div class="relative h-56 overflow-hidden">
                        @if($hospital->logo)
                        <img src="{{ asset('storage/' . $hospital->logo) }}" alt="{{ $hospital->name }}" class="w-full h-full object-contain bg-white p-2 transform group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="px-3 py-1 bg-white/90 rounded-full text-sm font-medium text-gray-700">
                                {{ $hospital->organization_type ?? 'N/A.' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $hospital->name ?? 'N/A.' }}
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ $hospital->description ?? 'Health Facility Information' }}
                        </p>
                        <div class="flex flex-col space-y-3">
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $hospital->province ?? 'No province available.' }}, {{ $hospital->district ?? 'No district available.' }}
                            </div>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $hospital->phone ?? 'No phone available.' }}
                            </div>
                            <div class="flex items-center justify-end">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load More / Show Less Button -->
            @if($hospitals->count() > 3)
            <div class="text-center mt-8">
                <button id="toggleButton" onclick="toggleHospitals()" class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    Load More
                </button>
            </div>
            @endif

            <!-- No Results Message -->
            @if($hospitals->isEmpty())
            <div class="text-center py-12 opacity-0 transform translate-y-4" style="animation: fadeInUp 0.6s ease-out forwards">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-500 text-lg">No hospitals found for this category.</p>
                <button onclick="window.location.href='{{ route('home') }}'" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    View All Hospitals
                </button>
            </div>
            @endif
        </div>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

        </style>
    </section>

    <script>
        let showingAll = false;
        const hospitals = @json($hospitals);

        function toggleHospitals() {
            const grid = document.getElementById('hospitals-grid');
            const button = document.getElementById('toggleButton');

            if (!showingAll) {
                // Show all hospitals
                grid.innerHTML = ''; // Clear existing content
                hospitals.forEach(hospital => {
                    grid.innerHTML += createHospitalCard(hospital);
                });
                button.textContent = 'Show Less';
            } else {
                // Show only first 3 hospitals
                grid.innerHTML = ''; // Clear existing content
                hospitals.slice(0, 3).forEach(hospital => {
                    grid.innerHTML += createHospitalCard(hospital);
                });
                button.textContent = 'Load More';
            }

            showingAll = !showingAll;
        }

        function createHospitalCard(hospital) {
            return `
                <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hospital-card">
                    <div class="relative h-56 overflow-hidden">
                        ${hospital.logo
                            ? `<img src="/storage/${hospital.logo}" alt="${hospital.name}" class="w-full h-full object-contain bg-white p-2 transform group-hover:scale-110 transition-transform duration-500">`
                            : `<div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>`
                        }
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="px-3 py-1 bg-white/90 rounded-full text-sm font-medium text-gray-700">
                                ${hospital.organization_type || 'N/A.'}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            ${hospital.name || 'N/A.'}
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            ${hospital.description || 'No description available.'}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location ${hospital.province || 'No description available.'}
                            </div>
                            <a href="/login" class="text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }

    </script>



    <!-- Feature Cards -->
    <section class="py-12 sm:py-20 px-4 sm:px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 sm:h-12 w-10 sm:w-12 text-primary mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4">Find Hospitals</h3>
                <p class="text-gray-600">
                    Locate the nearest hospitals and healthcare facilities in your area with ease.
                </p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 sm:h-12 w-10 sm:w-12 text-primary mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4">Book Appointments</h3>
                <p class="text-gray-600">
                    Schedule appointments with doctors and specialists hassle-free, anytime.
                </p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-xl transition-transform duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 sm:h-12 w-10 sm:w-12 text-primary mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4">Trusted Healthcare</h3>
                <p class="text-gray-600">
                    Access a network of verified and trusted healthcare professionals for quality care.
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 sm:py-20 px-4 sm:px-6 bg-white">
        <h3 class="text-2xl sm:text-3xl font-bold text-center mb-8 sm:mb-16">What Our Users Say</h3>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12">
            <div class="bg-gray-50 p-6 sm:p-8 rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <div class="flex items-center mb-6">
                    <img src="https://i.pravatar.cc/60?img=1" alt="Sarah Johnson" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mr-4 border-4 border-white shadow-lg">
                    <div>
                        <p class="font-semibold text-base sm:text-lg">Sarah Johnson</p>
                        <p class="text-gray-500">Patient</p>
                    </div>
                </div>
                <p class="text-gray-800 text-base sm:text-lg italic">
                    "HealthLink made it so easy to find a specialist in my area. I booked an appointment in minutes!"
                </p>
            </div>
            <div class="bg-gray-50 p-6 sm:p-8 rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <div class="flex items-center mb-6">
                    <img src="https://i.pravatar.cc/60?img=2" alt="Michael Chen" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full mr-4 border-4 border-white shadow-lg">
                    <div>
                        <p class="font-semibold text-base sm:text-lg">Michael Chen</p>
                        <p class="text-gray-500">Patient</p>
                    </div>
                </div>
                <p class="text-gray-800 text-base sm:text-lg italic">
                    "The video consultation feature is a game-changer. I got expert medical advice from the comfort of
                    my home."
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 sm:py-20 px-4 sm:px-6 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            <h3 class="text-2xl sm:text-3xl font-bold text-center mb-8 sm:mb-12">Your Feedback is Important to Us</h3>
            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6 bg-white p-6 sm:p-8 rounded-2xl shadow-lg">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"></textarea>
                </div>
                <div>
                    <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-lg hover:bg-primary-dark transition-colors shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-transform duration-200">
                        Send Feedback
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 sm:py-16 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12">
            <div class="col-span-1 sm:col-span-2 lg:col-span-2">
                <div class="flex items-center space-x-2 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    <h4 class="text-2xl font-bold">HealthLink</h4>
                </div>
                <p class="text-gray-400 mb-6">
                    Your trusted partner in healthcare, making quality medical services accessible to everyone.
                </p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                    <li><a href="#hospitals" class="text-gray-400 hover:text-white transition-colors">Hospitals</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Services</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-6">Connect With Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-400 hover:text-white hover:bg-primary transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-400 hover:text-white hover:bg-primary transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 p-3 rounded-full text-gray-400 hover:text-white hover:bg-primary transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400">&copy; 2025 HealthLink. All rights reserved.</p>
        </div>
    </footer>
    {{--
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Sliding announcement banner
        const announcements = [
            "COVID-19 Update: We're here to help. Learn more about our safety measures."
            , "New Feature: Book video consultations with our specialists!"
            , "HealthLink now available in 50+ cities across the country!"
        ];
        let currentAnnouncement = 0;
        const announcementElement = document.getElementById('announcement-banner').querySelector('p');

        setInterval(() => {
            currentAnnouncement = (currentAnnouncement + 1) % announcements.length;
            announcementElement.textContent = announcements[currentAnnouncement];
        }, 5000);

        // New Hero Section Announcement
        const heroAnnouncements = [
            "COVID-19 Update: We're here to help. Learn more about our safety measures."
            , "New Feature: Book video consultations with our specialists!"
            , "HealthLink now available in 50+ cities across the country!"
        ];
        let currentHeroAnnouncement = 0;
        const heroAnnouncementElement = document.getElementById('hero-announcement').querySelector('p');
        const counterElement = document.getElementById('announcement-counter');

        function updateHeroAnnouncement() {
            heroAnnouncementElement.classList.remove('opacity-100');
            heroAnnouncementElement.classList.add('opacity-0');

            setTimeout(() => {
                heroAnnouncementElement.textContent = heroAnnouncements[currentHeroAnnouncement];
                counterElement.textContent = `${currentHeroAnnouncement + 1}/${heroAnnouncements.length}`;
                heroAnnouncementElement.classList.remove('opacity-0');
                heroAnnouncementElement.classList.add('opacity-100');
            }, 300);
        }

        function nextAnnouncement() {
            currentHeroAnnouncement = (currentHeroAnnouncement + 1) % heroAnnouncements.length;
            updateHeroAnnouncement();
        }

        function prevAnnouncement() {
            currentHeroAnnouncement = (currentHeroAnnouncement - 1 + heroAnnouncements.length) % heroAnnouncements.length;
            updateHeroAnnouncement();
        }

        // Auto-rotate hero announcements every 5 seconds
        setInterval(nextAnnouncement, 5000);

    </script> --}}


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mobile menu toggle
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            });

            // Fetch announcements from the Laravel backend
            fetch('/announcements')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        document.getElementById('announcement-banner').style.display = 'none'; // Hide banner if no announcements
                        return;
                    }

                    // Extract announcements
                    let announcements = data.map(item => item.content);
                    let currentAnnouncement = 0;
                    const announcementElement = document.getElementById('announcement-banner').querySelector('p');

                    // Function to update banner announcements
                    function updateAnnouncement() {
                        announcementElement.textContent = announcements[currentAnnouncement];
                        currentAnnouncement = (currentAnnouncement + 1) % announcements.length;
                    }

                    // Initial display and auto-rotate every 5 seconds
                    updateAnnouncement();
                    setInterval(updateAnnouncement, 5000);

                    // Hero Section Announcements
                    let heroAnnouncements = data.map(item => item.content);
                    let currentHeroAnnouncement = 0;
                    const heroAnnouncementElement = document.getElementById('hero-announcement').querySelector('p');
                    const counterElement = document.getElementById('announcement-counter');

                    // Function to update hero announcements
                    function updateHeroAnnouncement() {
                        heroAnnouncementElement.classList.remove('opacity-100');
                        heroAnnouncementElement.classList.add('opacity-0');

                        setTimeout(() => {
                            heroAnnouncementElement.textContent = heroAnnouncements[currentHeroAnnouncement];
                            counterElement.textContent = `${currentHeroAnnouncement + 1}/${heroAnnouncements.length}`;
                            heroAnnouncementElement.classList.remove('opacity-0');
                            heroAnnouncementElement.classList.add('opacity-100');
                        }, 300);
                    }

                    function nextAnnouncement() {
                        currentHeroAnnouncement = (currentHeroAnnouncement + 1) % heroAnnouncements.length;
                        updateHeroAnnouncement();
                    }

                    function prevAnnouncement() {
                        currentHeroAnnouncement = (currentHeroAnnouncement - 1 + heroAnnouncements.length) % heroAnnouncements.length;
                        updateHeroAnnouncement();
                    }

                    // Auto-rotate hero announcements every 5 seconds
                    updateHeroAnnouncement();
                    setInterval(nextAnnouncement, 5000);
                })
                .catch(error => console.error("Error fetching announcements:", error));
        });

    </script>




</body>

</html>
