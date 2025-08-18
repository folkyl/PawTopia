<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pawtopia Calendar</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #5a3b2e;
    }

    /* Hero Section */
.hero {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 40px 60px;
    background: linear-gradient(to right, #f6b4a2, #f6dbb2);
    height: 250px;
    gap: 40px;
}

.hero img {
    position: absolute;
    left: 30px;
    bottom: 0; /* benar-benar nempel bawah hero */
    height: 300px; /* samakan tinggi hero agar pas */
    object-fit: contain;
     display: block;
}

.hero-text {
    color: #5b402e;
    text-align: center;
    flex: 1;
    margin-left: 450px; /* jarak dari gambar */
}

.hero-text h1 {
    font-weight: 600;
    font-size: 40px;
    margin-bottom: 5px; /* kecilkan biar sejajar sama paragraf */
    line-height: 1.2; /* rapatin sedikit */
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.hero-text h1::after {
    content: "🐾";
    font-size: 30px;
}

.hero-text p {
    font-weight: 400;
    font-size: 14px;
    color: #5b402e;
    max-width: 420px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    margin-top: 40px;
    padding-bottom: 5px;
    border-bottom: 3px solid #F6A892;
    display: block;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}


@media (max-width: 768px) {
    h2 {
        margin-top: 25px; /* Lebih dekat di layar kecil */
    }
}

    /* Calendar Container */
    .calendar-container {
        display: flex;
        justify-content: center;
        margin: 40px 0;
    }
    .calendar-box {
        background: #fcd8b6;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        width: 320px;
    }
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 15px;
    }
    .calendar-header button {
        background: #f8a07d;
        border: none;
        color: white;
        padding: 5px 10px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 14px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        color: white;
        background-color: #f47b60;
        padding: 5px;
        border-radius: 5px;
    }
    td {
        height: 45px;
        text-align: center;
        cursor: pointer;
        border-radius: 5px;
        position: relative;
    }
    td:hover {
        background-color: rgba(244, 123, 96, 0.2);
    }
    td.selected {
        background-color: #f47b60;
        color: white;
    }
    td.full-book {
        cursor: not-allowed;
        color: #aaa;
    }
    td.full-book::after {
        content: "🐾";
        position: absolute;
        bottom: 2px;
        right: 2px;
        font-size: 14px;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 300px;
    }
    .modal-content h2 {
        font-size: 16px;
        margin-bottom: 20px;
    }
    .modal-content button {
        background: #d23c5a;
        border: none;
        color: #F6A892;
        padding: 8px 20px;
        border-radius: 20px;
        cursor: pointer;
    }

    /* Why Choose Section */
    .why-choose {
        text-align: center;
        padding: 40px 20px;
        background-color: #f9f9f9;
    }
    .why-choose h2 {
        font-size: 25px;
        margin-bottom: 20px;
    }
    .why-choose span {
        color: #F6A892;
    }
 .features-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .feature-card {
        background-color: #fff;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.05);
        text-align: left;
    }

    .feature-icon img {
    width: 40px;  /* atur sesuai kebutuhan */
    height: auto; /* supaya proporsinya tetap terjaga */
}


    .feature-title {
        font-weight: 600;
        font-size: 18px;
        color: #674337;
    }

    .feature-text {
        font-weight: 400;
        font-size: 14px;
        color: #9C6F4B;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .features-container {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

@include('layouts.navbar')

<!-- Hero Section -->
<section class="hero">
        <div class="hero-content">
            <img src="{{ asset('images/pets.png') }}" alt="Pets">
            <div class="hero-text">
                <h1>Schedule Your Pet’s Day</h1>
                <p>Book the perfect daycare experience for your furry friend with our easy online scheduling system</p>
            </div>
        </div>
    </section>

    <h2 class="section-title">Calendar</h2>

<!-- Calendar -->
<div class="calendar-container">
    <div class="calendar-box">
        <div class="calendar-header">
            <span>July 2025</span>
            <div>
                <button id="prevMonthBtn" aria-label="Previous month">&lt;</button>
                <button id="nextMonthBtn" aria-label="Next month">&gt;</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th>
                    <th>Thu</th><th>Fri</th><th>Sat</th>
                </tr>
            </thead>
            <tbody id="calendar-body"></tbody>
        </table>
    </div>
</div>

<!-- Why Choose Pawtopia -->
<div class="why-choose">
    <h2 class="section-title">Why Choose <span>Paw</span>topia ?</h2>
    <div class="features-container">
    <div class="feature-card">
        <div class="feature-icon">
    <img src="{{ asset('images/Heart with dog paw.svg') }}" alt="Professional Care Icon">
</div>
        <div class="feature-title">Professional Care</div>
        <div class="feature-text">Our trained staff provides professional care and attention to your beloved pets throughout the day</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
    <img src="{{ asset('images/Schedule.svg') }}" alt="Flexible Scheduling Icon">
</div>
        <div class="feature-title">Flexible Scheduling</div>
        <div class="feature-text">Book appointments easily with our online system. Choose from various time slots that fit your schedule</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
    <img src="{{ asset('images/Tennis Ball.svg') }}" alt="Fun Activities Icon">
</div>
        <div class="feature-title">Fun Activities</div>
        <div class="feature-text">Your pets will enjoy various activities, games, and social interaction with other friendly pets</div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
    <img src="{{ asset('images/In Transit.svg') }}" alt="Pet Shuttle Icon">
</div>
        <div class="feature-title">Pet Shuttle</div>
        <div class="feature-text">Pet pick-up and drop-off available for your convenience — safe, easy, and on time!</div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal" id="booking-modal">
    <div class="modal-content">
        <h2>Book Your Appointment Now!</h2>
        <button onclick="window.location.href='{{ route('booking') }}'">Book</button>
    </div>
</div>

@include('layouts.footer')

<script>
    const calendarBody = document.getElementById('calendar-body');
const monthYearLabel = document.querySelector('.calendar-header span');

let currentMonth = 6; // Juli (0 = Januari)
let currentYear = 2025;
let selecting = false;
let selectedDays = [];

// Contoh data full booked (format: "YYYY-MM-DD")
const fullBookedDates = [
    "2025-07-10", "2025-07-14", "2025-07-16", "2025-07-30",
    "2025-08-02", "2025-08-05", "2025-08-22", "2025-08-27"
];

function generateCalendar(month, year) {
    calendarBody.innerHTML = "";

    const firstDay = new Date(year, month, 1).getDay(); // 0 = Minggu
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    monthYearLabel.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

    let day = 1;
    for (let i = 0; i < 6; i++) {
        let row = document.createElement('tr');

        for (let j = 0; j < 7; j++) {
            let cell = document.createElement('td');

            if (i === 0 && j < firstDay) {
                cell.innerHTML = '';
            } else if (day <= daysInMonth) {
                cell.innerHTML = day;

                let dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                if (fullBookedDates.includes(dateString)) {
                    cell.classList.add('full-book');
                } else {
                    cell.addEventListener('mousedown', () => {
                        selecting = true;
                        selectedDays = [];
                        selectDay(cell);
                    });
                    cell.addEventListener('mouseover', () => {
                        if (selecting) selectDay(cell);
                    });
                    cell.addEventListener('mouseup', () => {
                        selecting = false;
                        if (selectedDays.length) {
                            document.getElementById('booking-modal').style.display = 'flex';
                        }
                    });
                }

                day++;
            }

            row.appendChild(cell);
        }

        calendarBody.appendChild(row);
    }
}

function selectDay(cell) {
    let dayNum = parseInt(cell.innerText);
    if (!cell.classList.contains('full-book') && !isNaN(dayNum)) {
        cell.classList.add('selected');
        if (!selectedDays.includes(dayNum)) {
            selectedDays.push(dayNum);
        }
    }
}

function closeModal() {
    document.getElementById('booking-modal').style.display = 'none';
    document.querySelectorAll('td.selected').forEach(td => td.classList.remove('selected'));
    selectedDays = [];
}

// Tombol Prev / Next
document.getElementById('prevMonthBtn').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
});

document.getElementById('nextMonthBtn').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
});

document.addEventListener('mouseup', () => selecting = false);

// Inisialisasi awal
generateCalendar(currentMonth, currentYear);
</script>

</body>
</html>
