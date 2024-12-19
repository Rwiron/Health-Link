@extends('layouts.child')
@section('title', 'Login - StarCode')

@section('content')

    <div
        class="relative flex flex-col w-full overflow-hidden xl:flex-row to-custom-800 bg-gradient-to-r from-custom-900 dark:to-custom-900 dark:from-custom-950">

        <!-- Branding Tools Section (Now on Left) -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-10 grow py-14">
            <div>
                <a href="#!"><img src="assets/images/logo-light.png" alt="" class="block mx-auto mb-14 h-7"></a>
                <img src="assets/images/auth-modern.png" alt=""
                    class="block object-cover mx-auto shadow-lg md:max-w-md rounded-xl shadow-custom-800">
                <div class="mt-10 text-center">
                    <h3 class="mb-3 capitalize text-custom-50">Tools for crafting your business's brand identity</h3>
                    <p class="max-w-2xl text-custom-300 text-16">Unlock the potential of our versatile branding tools,
                        designed to empower your business in shaping a distinctive and impactful brand. Elevate your
                        business's image and leave a lasting impression with our comprehensive branding solutions.</p>
                </div>
            </div>
        </div>

        <!-- Login Form Section (Now on Right) -->
        <div
            class="min-h-[calc(100vh_-_theme('spacing.4')_*_2)] mx-3 lg:w-[40rem] shrink-0 px-10 py-14 flex items-center justify-center m-4 bg-white rounded z-10 relative dark:bg-zink-700 dark:text-zink-100 md:mx-auto xl:mx-4">
            <div class="flex flex-col w-full h-full">

            </div>
        </div>

    </div>
@endsection
