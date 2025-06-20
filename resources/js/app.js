import './bootstrap';

import.meta.glob([
    '../images/**'
]);

document.addEventListener("DOMContentLoaded", () => {
    const selectedSeatIds = [];
    const selectedSeatsInput = document.getElementById('selectedSeatsInput');
    const selectedSeatsInputFinal = document.getElementById('selectedSeatsInputFinal');
    const selectedSeatList = document.getElementById('selectedSeatList');
    const totalPriceSpan = document.getElementById('totalPriceDisplay');
    const totalPriceInput = document.getElementById('totalPriceInput');
    const quantityInput = document.getElementById('quantityInput');
    const quantityDisplay = document.getElementById('quantityDisplay');
    const seats = document.querySelectorAll(".seat");
    const paymentSelect = document.getElementById('payment_method');
    const paymentInput = document.getElementById('paymentInput');

    paymentSelect.addEventListener('change', function () {
        paymentInput.value = this.value;
    });

    seats.forEach(seat => {
        seat.addEventListener("click", () => {
            if (seat.dataset.booked === "true") return;

            const seatId = seat.dataset.seatId;
            const price = parseInt(seat.dataset.seatPrice || "0", 10);
            const seatNumber = seat.dataset.seatNumber;
            const index = selectedSeatIds.findIndex(item => item.id === seatId);

            if (index === -1) {
                seat.classList.add("bg-white/10", "text-white");
                selectedSeatIds.push({ id: seatId, price, number: seatNumber });
            } else {
                seat.classList.remove("bg-white/10", "text-white");
                selectedSeatIds.splice(index, 1);
            }

            const seatIdsOnly = selectedSeatIds.map(item => item.id);
            const seatNumbersOnly = selectedSeatIds.map(item => item.number);
            const quantity = selectedSeatIds.length;
            const total = selectedSeatIds.reduce((sum, item) => sum + item.price, 0);

            selectedSeatsInput.value = seatIdsOnly.join(",");
            selectedSeatsInputFinal.value = seatIdsOnly.join(",");
            selectedSeatList.textContent = seatNumbersOnly.join(", ");
            totalPriceSpan.textContent = total;
            totalPriceInput.value = total;
            quantityInput.value = quantity;

            if (quantityDisplay) {
                quantityDisplay.textContent = quantity;
            }
        });
    });
});

//  JavaScript to auto-calculate end time 

document.getElementById('start-time').addEventListener('change', function () {
    const startTime = this.value;
    if (startTime) {
        const [hours, minutes] = startTime.split(':').map(Number);
        let endHour = hours + 3;
        let endMin = minutes;

        if (endHour >= 24) endHour -= 24;

        const formattedEnd = `${String(endHour).padStart(2, '0')}:${String(endMin).padStart(2, '0')}`;
        document.getElementById('end-time').value = formattedEnd;
    }
});
