@php
    $user = auth()->user()
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZUCO Cinema</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class=" bg-black text-white flex flex-col  min-h-screen  font-hanken-grotesk">

    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10 relative">
            <div>
                <a href="/">
                    <img class="w-32" src="{{ Vite::asset('resources/images/zuco-logo.png') }}" alt="">
                </a>
            </div>

            <div class="hidden md:flex space-x-6 font-bold">
                <a href="/cusmovies">Movies</a>
                <a href="/cusplaces">Cinemas</a>
                <a href="#">Contact Us</a>
                <a href="#">About Us</a>
            </div>

            @guest
                <div class="hidden md:block space-x-2">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
            @endguest

            @auth
               <div class="hidden md:flex justify-center items-center space-x-2">
                    <a href="/bookings" class="ml-2">Bookings</a>

                    {{-- Desktop Button to Open Profile Modal --}}
                    <button data-modal-target="profile-modal" data-modal-toggle="profile-modal" {{-- MODIFIED ID HERE --}}
                        class="block text-white cursor-pointer text-center hover:text-pink-600"
                        type="button">
                        Hi, {{ $user->name }}
                    </button>
                </div>

                {{-- Profile Modal Definition --}}
                <div id="profile-modal" tabindex="-1" aria-hidden="true" {{-- MODIFIED ID HERE --}}
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Profile</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="profile-modal"> {{-- MODIFIED ID HERE --}}
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex text-black flex-col justify-around px-5">
                                <h1>Name: {{$user->name}}</h1>
                                <h1>Email: {{$user->email}}</h1>
                                <form method="POST" action="{{ route('profile.update') }}" class="p-4 md:p-5 space-y-4">
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
                                    <form method="POST" action="/logout">
                                        @csrf
                                        @method('DELETE')

                                        <button class=" py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700">Log Out</button>
                                    </form>
                                    <button data-modal-hide="profile-modal" type="button" {{-- MODIFIED ID HERE --}}
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700">
                                        Close
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
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


            <div class="md:hidden">
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>

            <div id="mobileMenu" class="absolute top-full left-0 w-full bg-gray-900 text-white font-bold p-4 space-y-2 hidden md:hidden z-50">
                <a href="/cusmovies" class="block">Movies</a>
                <a href="/cusplaces" class="block">Cinemas</a>
                <a href="#" class="block">Contact Us</a>
                <a href="#" class="block">About Us</a>
                <hr>
                @guest
                    <a href="/login" class=" block">Login</a>
                    <a href="/register">Register</a>
                @endguest
                @auth
                    <a href="/bookings">Bookings</a>
                    {{-- Mobile Button to Open Profile Modal --}}
                    <button data-modal-target="profile-modal" data-modal-toggle="profile-modal" {{-- MODIFIED ID HERE --}}
                        class="block text-white cursor-pointer text-center hover:text-pink-600"
                        type="button">
                        Hi, {{ $user->name }}
                    </button>
                @endauth

            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>