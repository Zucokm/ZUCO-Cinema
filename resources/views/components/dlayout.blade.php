@php
    $user = auth('admin')->user()
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZUCO Cinema</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" bg-black text-white flex flex-col min-h-screen font-hanken-grotesk">
    
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10 relative">
            <!-- Logo -->
            <div>
                <a href="/dashboard">
                    <img class="w-32" src="{{ Vite::asset('resources/images/zuco-logo.png') }}" alt="">
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6 font-bold">
                <a href="/movies">Movies</a>
                <a href="/places">Places</a>
                <a href="/schedules">Schedules</a>
                <a href="/seattypes">Seat Types</a>
                <a href="#">Record</a>
            </div>


            <div class="hidden md:block space-x-2">
                @auth
               <div class="hidden md:flex justify-center items-center space-x-2">
                    <a class=" inline-block" href="aregister">For New Staff /</a>

                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="block text-white cursor-pointer text-center hover:text-pink-600"
                        type="button">
                        Hi, {{ $user->name }}
                    </button>
                </div>

                <div id="default-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Profile</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex text-black flex-col justify-around px-5">
                                <h1>Name: {{$user->name}}</h1>
                                <h1>Email: {{$user->email}}</h1>
                                <form method="POST" action="{{ route('adminprofile.update') }}" class="p-4 md:p-5 space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required>
                                    </div>

                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required>
                                    </div>

                                    <div class="flex justify-end space-x-2 border-t border-gray-200 pt-4 dark:border-gray-600">
                                        <button type="submit"
                                            class="py-2.5 px-5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Update</button>
                                        
                                    </div>
                                </form>
                            </div>
                            

                            <div class="flex items-center p-4 justify-between md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <div class="flex items-center">
                                    <form method="POST" action="/alogout">
                                        @csrf
                                        @method('DELETE')

                                        <button class=" py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700">Log Out</button>
                                    </form>
                                    <button data-modal-hide="default-modal" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700">
                                        Close
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('adminprofile.delete') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800 cursor-pointer font-semibold">
                                        Delete My Account
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
                
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div id="mobileMenu" class="absolute top-full left-0 w-full bg-gray-900 text-white font-bold p-4 space-y-2 hidden md:hidden z-50">
                <a href="/movies" class="block">Movies</a>
                <a href="/places" class="block">Places</a>
                 <a href="/schedules" class="block">Schedules</a>
                <a href="/seattypes" class=" block">Seat Types</a>
                <a href="#" class="block">Contact Us</a>
                <a href="#" class="block">About Us</a>
                <hr>
                @auth('admin')

                    <a class=" inline-block" href="aregister">For New Staff</a>
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="block text-white cursor-pointer text-center hover:text-pink-600"
                        type="button">
                        Hi, {{ $user->name }}
                    </button>
                @endauth

            </div>
        </nav>

        @if (request()->is('movies'))
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left px-4 md:px-16 py-3 border-b border-white/10 space-y-4 md:space-y-0">
                <h1 class="text-3xl md:text-4xl">Movies</h1>
                <div class="flex flex-wrap justify-center md:justify-end gap-2">
                    <a href="/movies/create"
                    class="bg-white/10 p-3 rounded-xl hover:bg-white hover:text-black transition-all duration-300">
                        Create Movies
                    </a>
                </div>
            </div>
        @endif

        @if (request()->is('places'))
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left px-4 md:px-16 py-3 border-b border-white/10 space-y-4 md:space-y-0">
                <h1 class="text-3xl md:text-4xl">Places</h1>
                <div class="flex flex-wrap justify-center md:justify-end gap-2">
                    <a href="/places/create"
                    class="bg-white/10 p-3 rounded-xl hover:bg-white hover:text-black transition-all duration-300">
                        Create Places
                    </a>
                </div>
            </div>
        @endif

        

    


        <main >
            {{ $slot }}
        </main>

        
    </div>
    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>