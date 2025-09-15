@include ('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pet Daycare Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #674337;
    }
    .container {
        max-width: 700px;
        margin: auto;
        padding: 20px;
    }
    /* Header */
    .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background: linear-gradient(to right, #fbe1c3, #fff);
    }

    .hero-text {
  max-width: 60%;
  text-align: center;   /* ✅ ini yang bikin teks center */
  margin: 0 auto;       /* ✅ supaya benar-benar ke tengah */
}

    .hero-title {
      font-size: 50px;
      font-weight: 750;
      color: #9C6F4B;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .hero-title img {
      width: 20px;
    }

    .hero-subtitle {
      margin-top: 8px;
      font-size: 20px;
      color: #9C6F4B;
      font-weight: 400;
    }

    .hero-image img { 
      display: block;  
      max-height: 180px;
    }

    /* Section */
    .section {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #f0e6e2;
        border-radius: 10px;
    }
    .section-title {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .section-title img {
        width: 30px;
        height: auto;
        margin-right: 8px;
    }
    .form-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

.form-field {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-field label {
    margin-bottom: 5px;
    font-weight: 500;
    font-size: 14px;
    color: #674337;
}

.form-field input {
    padding: 8px;
    border: 1px solid #9C6F4B;
    border-radius: 6px;
    font-size: 14px;
}

    .form-group input {
        flex: 1;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-family: inherit;
        font-size: 14px;
    }

    .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    resize: none; /* Biar user tidak bisa drag ukuran */
    box-sizing: border-box;
}
.form-group textarea:focus {
    outline: none;
    border-color: #ddd;
}

    /* Cost Estimation */
    .cost {
        margin-top: 20px;
        text-align: center;
        padding: 20px;
        background: #FFE0B5;
        border-radius: 12px;
        font-size: 14px;
    }
    .cost-title {
    display: flex;
    justify-content: center; /* center horizontal */
    align-items: center;      /* center vertical */
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 15px;
}
    .cost strong {
        font-size: 16px;
        display: block;
        margin-bottom: 5px;
    }

    /* Button */
    .submit-btn {
        display: block;
        margin: 20px auto 10px;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        background: #CA2E55;
        color: #F6A892;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
    }

    .note {
        text-align: center;
        font-size: 12px;
        color: #9C6F4B;
    }
/* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        max-width: 700px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        margin: 20px;
        box-sizing: border-box;
    }

    .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 18px;
        color: #999;
    }

    .modal-content img {
        height: 60px;
        margin-bottom: 15px;
    }

    .modal-title {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .modal-desc {
        font-size: 14px;
        color: #9C6F4B;
        margin-bottom: 25px;
    }

    /* Booking Info Grid */
    .booking-info { 
        display: grid; 
        grid-template-columns: repeat(2, 1fr); 
        gap: 15px 20px;
        margin-bottom: 20px; 
        justify-items: center;
    }

    /* Info Card */
    .info-card { 
        background: #fff; 
        border-radius: 10px;
        padding: 12px 16px;
        box-shadow: 2px 2px 0px #f4a28c;
        border: 1px solid #eee;
        width: 100%;
        max-width: 200px;
        text-align: center;
        box-sizing: border-box;
    }

    .info-card .title { 
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .info-card .subtitle { 
        font-size: 14px;
        font-weight: 400;
        color: #9C6F4B;
    }

    .info-card .subtitle i {
        font-size: 12px;
        color: #9C6F4B;
    }

   
</style>
</head>
<body>

<!-- Header -->
    <section class="hero">
    <div class="hero-text">
      <div class="hero-title">
        Pet Daycare Booking 
        <span>🐾</span>
      </div>
      <div class="hero-subtitle">The best place for your beloved pets</div>
    </div>
    <div class="hero-image">
      <img src="{{ asset('images/cute.png') }}" alt="cat and dog">
    </div>
  </section>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

<<<<<<< HEAD
    <!-- Delivery Options -->
<div class="section">
  <div class="section-title">
    <img src="{{ asset('images/In Transit.svg') }}" alt=""> Delivery Options
  </div>
  <div class="form-group">
    <div class="form-field">
      <label>Drop-off (Start of boarding)</label>
      <label><input type="radio" name="dropOff" value="Owner Drop-off" checked> Brought by Owner</label><br>
      <label><input type="radio" name="dropOff" value="Daycare Pickup"> Picked up by Daycare</label>
    </div>
    <div class="form-field">
      <label>Pick-up (End of boarding)</label>
      <label><input type="radio" name="pickUp" value="Owner Pickup" checked> Picked up by Owner</label><br>
      <label><input type="radio" name="pickUp" value="Daycare Delivery"> Delivered by Daycare</label>
    </div>
  </div>
</div>

    <!-- Pet Information -->
    <div class="section">
        <div class="section-title"><img src="{{ asset('images/Pets.svg') }}" alt="">Pet Information</div>
        <div class="pet-list">
            <div class="pet-item">
                <input type="checkbox" id="pet1">
                <label for="pet1">Buddy (Golden Retriever)</label>
            </div>
            <div class="pet-item">
                <input type="checkbox" id="pet2">
                <label for="pet2">Kitty (Persia)</label>
=======
    @if($errors->any())
        <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth('member')
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <!-- Service Type -->
        <div class="section">
            <div class="section-title"><img src="{{ asset('images/Schedule.svg') }}" alt="">Service Type</div>
            <div class="form-group">
                <div class="form-field">
                    <label>Service Type</label>
                    <select name="service_type" required>
                        <option value="">Select Service</option>
                        <option value="grooming">Grooming - Rp 150,000</option>
                        <option value="boarding">Boarding - Rp 200,000</option>
                        <option value="veterinary">Veterinary - Rp 300,000</option>
                        <option value="training">Training - Rp 250,000</option>
                    </select>
                </div>
>>>>>>> 59fd9f095b61ea572bae8457fe2f26dcffe6af06
            </div>
        </div>

        <!-- Pet Information -->
        <div class="section">
            <div class="section-title"><img src="{{ asset('images/Pets.svg') }}" alt="">Pet Information</div>
            <div class="form-group">
                <div class="form-field">
                    <label>Pet Name</label>
                    <input type="text" name="pet_name" placeholder="Enter pet name" required>
                </div>
                <div class="form-field">
                    <label>Pet Type</label>
                    <select name="pet_type" required>
                        <option value="">Select Pet Type</option>
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="bird">Bird</option>
                        <option value="rabbit">Rabbit</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Booking Schedule -->
        <div class="section">
            <div class="section-title"><img src="{{ asset('images/Schedule.svg') }}" alt="">Booking Schedule</div>
            <div class="form-group">
                <div class="form-field">
                    <label>Booking Date</label>
                    <input type="date" name="booking_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                </div>
                <div class="form-field">
                    <label>Booking Time</label>
                    <input type="time" name="booking_time" required>
                </div>
            </div>
        </div>

        <!-- Special Notes -->
        <div class="section">
            <div class="section-title"><img src="{{ asset('images/Edit.svg') }}" alt="">Special Notes</div>
            <div class="form-group">
                <textarea name="notes" placeholder="Pet Special Instructions: Allergies/Health Issues" rows="5"></textarea>
            </div>
        </div>

        <!-- Cost Estimation -->
        <div class="cost">
            <div class="cost-title">Cost Estimation</div>
            <strong id="costDisplay">Select a service to see pricing</strong>
            <div id="costDetails" style="margin-top: 10px; font-size: 12px; color: #9C6F4B;"></div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Submit Booking</button>
        <div class="note">Our team will contact you within 24 hours for confirmation</div>
    </form>
    @else
    <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 12px; margin: 20px 0;">
        <h3 style="color: #6B4F3A; margin-bottom: 15px;">Please Login First</h3>
        <p style="color: #9C6F4B; margin-bottom: 20px;">You need to be logged in to make a booking.</p>
        <a href="{{ route('register.page') }}" style="display: inline-block; padding: 12px 24px; background: #E57300; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Login / Register</a>
    </div>
    @endauth
</div>
<!-- Modal -->
<div class="modal" id="bookingModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">×</span>
        <img src="{{ asset('images/confirm.svg') }}" alt="confirm">
        <div class="modal-title">Booking Confirmed!</div>
        <div class="modal-desc">Thank you for choosing our pet daycare service.</div>

        <div class="booking-info"> 
            <div class="info-card"> 
                <div class="title">Owner Name</div>
                <div class="subtitle">Jeremiah</div>
            </div> 
            <div class="info-card">
                <div class="title">Pet Details</div>
                <div class="subtitle">Max <br><i>(Golden Retriever)</i></div>
            </div> 
            <div class="info-card">
                <div class="title">Service Period</div>
                <div class="subtitle">Dec 25 – Dec 30, 2025</div> 
            </div>
            <div class="info-card"> 
                <div class="title">Contact</div>
                <div class="subtitle">+62 1234–5678</div>
            </div>
            <div class="info-card">
                <div class="title">Drop-off</div>
                <div class="subtitle" id="confirmDropOff">-</div>
            </div>
            <div class="info-card">
                <div class="title">Pick-up</div>
                <div class="subtitle" id="confirmPickUp">-</div>
            </div>
        </div>

       


    </div>
</div>

<script>
    // Service pricing
    const servicePrices = {
        'grooming': { price: 150000, name: 'Grooming' },
        'boarding': { price: 200000, name: 'Boarding' },
        'veterinary': { price: 300000, name: 'Veterinary' },
        'training': { price: 250000, name: 'Training' }
    };

    // Update cost display when service type changes
    document.querySelector('select[name="service_type"]').addEventListener('change', function() {
        const selectedService = this.value;
        const costDisplay = document.getElementById('costDisplay');
        const costDetails = document.getElementById('costDetails');
        
        if (selectedService && servicePrices[selectedService]) {
            const service = servicePrices[selectedService];
            costDisplay.textContent = `${service.name}: Rp ${service.price.toLocaleString('id-ID')}`;
            costDetails.textContent = 'Final cost will be confirmed after booking review';
        } else {
            costDisplay.textContent = 'Select a service to see pricing';
            costDetails.textContent = '';
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const serviceType = document.querySelector('select[name="service_type"]').value;
        const petName = document.querySelector('input[name="pet_name"]').value;
        const petType = document.querySelector('select[name="pet_type"]').value;
        const bookingDate = document.querySelector('input[name="booking_date"]').value;
        const bookingTime = document.querySelector('input[name="booking_time"]').value;
        
        if (!serviceType || !petName || !petType || !bookingDate || !bookingTime) {
            e.preventDefault();
            alert('Please fill in all required fields');
            return false;
        }
        
        // Form validation passed
    });
</script>
@include ('layouts.footer')

</body>
</html>
