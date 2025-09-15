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
    <!-- Booking Schedule -->
    <div class="section">
        <div class="section-title"><img src="{{ asset('images/Schedule.svg') }}" alt="">Booking Schedule</div>
        <div class="form-group">
    <div class="form-field">
        <label>Start Date</label>
        <input type="date" id="startDate" readonly>
    </div>

    <div class="form-field">
        <label>End Date</label>
        <input type="date" id="endDate" readonly>
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
        <div class="pet-list">
            <div class="pet-item">
                <input type="checkbox" id="pet1">
                <label for="pet1">Buddy (Golden Retriever)</label>
            </div>
            <div class="pet-item">
                <input type="checkbox" id="pet2">
                <label for="pet2">Kitty (Persia)</label>
            </div>
        </div>
    </div>

    <!-- Special Notes -->
    <div class="section">
        <div class="section-title"><img src="{{ asset('images/Edit.svg') }}" alt="">Special Notes</div>
        <div class="form-group">
            <textarea placeholder="Pet Special Instructions: Allergies/Health Issues" rows="5"></textarea>
        </div>
    </div>

    <!-- Cost Estimation -->
    <div class="cost">
        <div class="cost-title">Cost Estimation</div>
        <strong>Base Rate: Rp. 50,000/day</strong>
        Final cost will be calculated based on duration and selected additional services
    </div>

    <!-- Submit Button -->
    <button class="submit-btn" onclick="openModal()">Submit Booking</button>
    <div class="note">Our team will contact you within 24 hours for confirmation</div>
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
    function openModal(){
        const dropOff = document.querySelector('input[name="dropOff"]:checked').value;
      const pickUp = document.querySelector('input[name="pickUp"]:checked').value;
      document.getElementById("confirmDropOff").textContent = dropOff;
      document.getElementById("confirmPickUp").textContent = pickUp;

        document.getElementById("bookingModal").style.display = "flex";
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
