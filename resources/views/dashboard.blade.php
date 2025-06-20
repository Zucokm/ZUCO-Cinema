<x-dlayout>
    <x-mother>
        <div class="flex flex-col space-y-10 lg:sapce-y-0 lg:flex-row p-0 h-200 lg:h-120 space-x-10 m-0 ">
            <div class=" w-full lg:w-4/6 py-8 sm:py-4  flex rounded-2xl lg:flex-col justify-around  h-full bg-white/5">
                <div class=" flex flex-col lg:flex-row space-y-10 lg:space-y-0 lg:space-x-12 mx-auto">
                    <a href="/movies">
                        <x-total>
                            <x-slot:name>Movies</x-slot:name>
                            <i class="fa-solid fa-video text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">{{$totalMovies}}</h1>
                        </x-total>
                    </a>
                    
                    <a href="#">
                        <x-total>
                            <x-slot:name>Users</x-slot:name>
                            <i class="fa-solid fa-users text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">{{$totalUsers}}</h1>
                        </x-total>
                    </a>
                    
                    <a href="">
                        <x-total>
                            <x-slot:name>Bookings</x-slot:name>
                            <i class="fa-regular fa-bookmark text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">{{$totalBookings}}</h1>
                        </x-total>
                    </a>
                    
                </div>
                <div class=" flex flex-col lg:flex-row space-y-10 lg:space-y-0 lg:space-x-12 mx-auto">
                    <a href="">
                        <x-total>
                            <x-slot:name>Schedules</x-slot:name>
                            <i class="fa-solid fa-calendar-days text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">{{$totalSchedules}}</h1>
                        </x-total>
                    </a>
                    
                    <a href="">
                        <x-total>
                            <x-slot:name>Complaints</x-slot:name>
                            <i class="fa-solid fa-comments text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">20</h1>
                        </x-total>
                    </a>
                    
                    <a href="">
                        <x-total>
                            <x-slot:name>Admins</x-slot:name>
                            <i class="fa-solid fa-user-tie text-3xl sm:text-6xl"></i>
                            <h1 class=" text-xl sm:text-5xl text-center">{{$totalAdmins}}</h1>
                        </x-total>
                    </a>
                    
                </div>   
            </div>
            <div class=" w-full lg:w-2/6 scrollbar-hide::-webkit-scrollbar scrollbar-hide overflow-scroll h-full rounded-2xl flex flex-col bg-white/5 px-10 py-8">
                <h1 class="mb-2 ">Booking percentages</h1>
                <hr class=" text-white/10">
                <div class=" flex-col flex space-y-5">
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    <x-percentages></x-percentages>
                    
                </div>
                
            </div>
        </div>
    </x-mother>
</x-dlayout>

