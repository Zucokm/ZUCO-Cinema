<x-layout>
    <x-mother>
        <h1 class="text-2xl mb-5">
            {{ $schedule->movie->name }} <br>
            {{ $schedule->show_date }} → {{ $schedule->start }} →
            {{ $schedule->cinema->place->township }} ({{ $schedule->cinema->place->place }}) →
            {{ $schedule->cinema->name }}
        </h1>
        <hr class="mb-4">

        <div class="overflow-x-auto scrollbar-thin">
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <input type="hidden" name="selected_seats" id="selectedSeatsInput">

            @foreach ($seats as $seatTypeId => $seatGroup)
                @php
                    $seatType = \App\Models\SeatType::find($seatTypeId);
                    $price = $seatType?->price ?? 0;
                    $typeName = $seatType?->name ?? 'Unknown';
                @endphp

                <div class="mb-1">
                    <h2 class=" font-semibold mb-4 px-2">
                        Seat Type: {{ $typeName }} / {{ $price }} MKS.
                    </h2>

                    <div class="space-x-1 px-2 grid min-w-150 grid-cols-10">
                        @foreach ($seatGroup as $seat)
                            @php
                                $isBooked = in_array($seat->id, $bookSeats);
                            @endphp

                            <div
                                class="seat min-w-[50px] rounded-xl shadow-md overflow-hidden transform transition duration-300 border mb-2 text-center text-sm p-1
                                    {{ $isBooked ? 'bg-red-200 text-gray-500 cursor-not-allowed border-gray-300' : 'bg-white text-gray-800 cursor-pointer hover:scale-105 hover:bg-white/50 border-gray-200' }}"
                                data-seat-id="{{ $seat->id }}"
                                data-seat-price="{{ $price }}"
                                data-seat-number="{{ $seat->seat_number }}" 
                                title="{{ $isBooked ? 'Already Booked' : '' }}"
                                {{ $isBooked ? 'data-booked=true' : '' }}
                            >
                                {{ $seat->seat_number }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @guest
            <a href="/login" class="border p-3 rounded-xl hover:bg-pink-500 transition-all duration-300">Login for booking</a>
        @endguest

        <!-- Modal toggle -->
        @auth
        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="block text-white mb-3 cursor-pointer bg-white/20 border focus:ring-1 focus:outline-none hover:bg-green-500 transition-all duration-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-auto w-30 sm:w-40 md:w-50 hover:text-black"
            type="button">
            Continue
        </button>

        <!-- Main modal and form -->
        
        <form id="seatForm" action="/booking" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <input type="hidden" name="selected_seats" id="selectedSeatsInputFinal">
            <input type="hidden" name="price" id="totalPriceInput" value="0">
            <input type="hidden" name="quantity" id="quantityInput" value="0">
            <input type="hidden" name="payment" id="paymentInput" value="">
            <input type="hidden" name="booking_date" value="{{ now()->format('Y-m-d') }}">
            

            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Confirm Booking</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex justify-around">
                            <div class="p-4 md:p-5 space-y-4 text-black mt-3">
                                <p><strong>Movie:</strong> {{ $schedule->movie->name }}</p>
                                <p><strong>Date:</strong> {{ $schedule->show_date }}</p>
                                <p><strong>Time:</strong> {{ $schedule->start }}</p>
                                <p><strong>Cinema:</strong> {{ $schedule->cinema->name }}</p>
                                <p><strong>Selected Seats:</strong> <span id="selectedSeatList" class="font-semibold text-blue-700"></span></p>
                                <p><strong>Total Price:</strong> <span id="totalPriceDisplay" class="font-semibold text-red-600">0</span> MKS</p>
                                <p><strong>Quantity:</strong> <span id="quantityDisplay" class="font-semibold text-green-700">0</span></p>
                                
                                <div>
                                    <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                                    <select id="payment_method" name="payment_method"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        <option selected disabled>Choose a payment method</option>
                                        <option value="KBZ Pay">KBZ Pay</option>
                                        <option value="CB Pay">CB Pay</option>
                                        <option value="Wave Pay">Wave Pay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-30 sm:w-50">
                                <img class="w-full rounded-2xl" src="http://picsum.photos/seed/{{ rand(0, 10000) }}/200/300" alt="Movie">
                            </div>
                        </div>

                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-black hover:bg-pink-500 transition-all duration-300 hover:text-black cursor-pointer ease-in font-medium rounded-lg text-sm px-5 py-2.5">
                                Book
                            </button>
                            <button data-modal-hide="default-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700">
                                Decline
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endauth
        
    </x-mother>
</x-layout>

