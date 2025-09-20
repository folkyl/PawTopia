@include ('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pet Daycare Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
        /* ===== GLOBAL STYLES ===== */
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

        /* ===== HERO SECTION ===== */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: linear-gradient(to right, #fbe1c3, #fff);
        }

        .hero-text {
            max-width: 60%;
            text-align: center;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 50px;
            font-weight: 750;
            color: #8A6552;
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
            color: #8A6552;
            font-weight: 400;
        }

        .hero-image img {
            display: block;
            max-height: 180px;
        }

        /* ===== FORM SECTIONS ===== */
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
            border: 1px solid #8A6552;
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
            resize: none;
            box-sizing: border-box;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #ddd;
        }

        /* ===== COST ESTIMATION ===== */
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
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .cost strong {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
        }

        /* ===== BUTTONS ===== */
        .submit-btn {
            display: block;
            margin: 20px auto 10px;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            background: #E07A5F;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .note {
            text-align: center;
            font-size: 12px;
            color: #8A6552;
        }
        /* ===== MODAL STYLES ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
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
            color: #8A6552;
            margin-bottom: 25px;
        }

        /* ===== BOOKING INFO GRID ===== */
        .booking-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 20px;
            margin-bottom: 20px;
            justify-items: center;
        }

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
            color: #8A6552;
        }

        .info-card .subtitle i {
            font-size: 12px;
            color: #8A6552;
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
    <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        <input type="hidden" name="service_type" value="boarding">
    <!-- Booking Schedule -->
    <div class="section">
        <div class="section-title"><img src="{{ asset('images/Schedule.svg') }}" alt="">Booking Schedule</div>
        <div class="form-group">
            <div class="form-field">
                <label>Booking Date</label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>

            <div class="form-field">
                <label>Time</label>
                <input type="time" id="booking_time" name="booking_time" required>
            </div>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Drop-off Time">
            <input type="text" placeholder="Pick-up Time">
        </div>
        
    </div>

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
        <div class="form-group">
            <div class="form-field">
                <label>Pet Name</label>
                <input type="text" name="pet_name" placeholder="e.g., Max" required>
            </div>
            <div class="form-field">
                <label>Pet Type</label>
                <select name="pet_type" required style="padding:8px; border: 1px solid #9C6F4B; border-radius: 6px; font-size: 14px;">
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="bird">Bird</option>
                    <option value="rabbit">Rabbit</option>
                    <option value="other">Other</option>
                </select>
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
        <strong>Base Rate: Rp. 50,000/day</strong>
        Final cost will be calculated based on duration and selected additional services
    </div>

    <!-- Submit Button -->
    <button type="submit" class="submit-btn">Submit Booking</button>
    <div class="note">Our team will contact you within 24 hours for confirmation</div>
</form>
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
                <div class="subtitle" id="ownerName">-</div>
            </div> 
            <div class="info-card">
                <div class="title">Pet Details</div>
                <div class="subtitle" id="petDetails">-</div>
            </div> 
            <div class="info-card">
                <div class="title">Service Date</div>
                <div class="subtitle" id="servicePeriod">-</div> 
            </div>
            <div class="info-card"> 
                <div class="title">Contact</div>
                <div class="subtitle" id="ownerContact">-</div>
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
    // Make current logged-in member available to JS (name, phone)
    const currentMember = @json(optional(auth('member')->user())->only(['name','phone']));

    // Intercept form submit to send as AJAX and show success modal instantly
    (function(){
      const form = document.querySelector('form[action="{{ route('booking.store') }}"]');
      if (!form) return;
      form.addEventListener('submit', async function(e){
        e.preventDefault();
        const fd = new FormData(form);
        const payload = {
          service_type: fd.get('service_type'),
          pet_name: fd.get('pet_name'),
          pet_type: fd.get('pet_type'),
          booking_date: fd.get('booking_date'),
          booking_time: fd.get('booking_time'),
          notes: fd.get('notes') || null,
        };

        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        try {
          const res = await fetch("{{ route('booking.store') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrf || '',
              'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
          });

          // If not logged in, Laravel may redirect (res.redirected) or return 401/json
          if (res.redirected) {
            window.location.href = res.url;
            return;
          }
          if (!res.ok) {
            const data = await res.json().catch(()=>({ message: 'Failed to submit booking'}));
            alert(data.message || 'Failed to submit booking');
            return;
          }

          // Success -> show success modal with freshly entered data
          await res.json();
          openModal(payload);
          form.reset();
        } catch (err) {
          alert('Network error. Please try again.');
        }
      });
    })();

    function capitalize(s){ return (s||'').charAt(0).toUpperCase() + (s||'').slice(1); }

    function formatDate(dateStr){
        try {
            const d = new Date(dateStr);
            return d.toLocaleDateString('id-ID', { day:'2-digit', month:'2-digit', year:'numeric' });
        } catch { return dateStr; }
    }

    function openModal(payload){
        const dropOff = document.querySelector('input[name="dropOff"]:checked')?.value || '-';
        const pickUp = document.querySelector('input[name="pickUp"]:checked')?.value || '-';

        document.getElementById('confirmDropOff').textContent = dropOff;
        document.getElementById('confirmPickUp').textContent = pickUp;

        // Fill dynamic info
        document.getElementById('ownerName').textContent = currentMember?.name || '-';
        document.getElementById('ownerContact').textContent = currentMember?.phone || '-';
        const petTypeText = capitalize(payload?.pet_type);
        document.getElementById('petDetails').innerHTML = `${payload?.pet_name || '-'} <br><i>(${petTypeText || '-'})</i>`;
        const serviceText = `${formatDate(payload?.booking_date)} ${payload?.booking_time || ''}`.trim();
        document.getElementById('servicePeriod').textContent = serviceText || '-';

        document.getElementById('bookingModal').style.display = 'flex';
    }
    function closeModal(){
        document.getElementById("bookingModal").style.display = "none";
    }
    window.onclick = function(e){
        if(e.target == document.getElementById("bookingModal")){
            closeModal();
        }
    }
</script>
@include ('layouts.footer')

</body>
</html>
