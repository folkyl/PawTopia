<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pet Daycare Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .booking-page {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #674337;
    }
    .booking-page .container {
        max-width: 700px;
        margin: auto;
        padding: 20px;
    }
    /* Header */
    .booking-page .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background: linear-gradient(to right, #fbe1c3, #fff);
    }

    .booking-page .hero-text {
      max-width: 60%;
      text-align: center;
      margin: 0 auto;
    }

    .booking-page .hero-title {
      font-size: 50px;
      font-weight: 750;
      color: #9C6F4B;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .booking-page .hero-title img {
      width: 20px;
    }

    .booking-page .hero-subtitle {
      margin-top: 8px;
      font-size: 20px;
      color: #9C6F4B;
      font-weight: 400;
    }

    .booking-page .hero-image img { 
      display: block;  
      max-height: 180px;
    }

    /* Section */
    .booking-page .section {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #f0e6e2;
        border-radius: 10px;
    }
    .booking-page .section-title {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .booking-page .section-title img {
        width: 30px;
        height: auto;
        margin-right: 8px;
    }
    .booking-page .form-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .booking-page .form-field {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .booking-page .form-field label {
        margin-bottom: 5px;
        font-weight: 500;
        font-size: 14px;
        color: #674337;
    }

    .booking-page .form-field input {
        padding: 8px;
        border: 1px solid #9C6F4B;
        border-radius: 6px;
        font-size: 14px;
    }

    .booking-page .form-group input {
        flex: 1;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-family: inherit;
        font-size: 14px;
    }

    .booking-page .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        resize: none;
        box-sizing: border-box;
    }
    .booking-page .form-group textarea:focus {
        outline: none;
        border-color: #ddd;
    }

    /* Cost Estimation */
    .booking-page .cost {
        margin-top: 20px;
        text-align: center;
        padding: 20px;
        background: #FFE0B5;
        border-radius: 12px;
        font-size: 14px;
    }
    .booking-page .cost strong {
        font-size: 16px;
        display: block;
        margin-bottom: 5px;
    }

    /* Button */
    .booking-page .submit-btn {
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

    .booking-page .note {
        text-align: center;
        font-size: 12px;
        color: #9C6F4B;
    }

    /* Modal */
    .booking-page .modal {
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

    .booking-page .modal-content {
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        max-width: 650px;
        width: 100%;
        position: relative;
    }

    .booking-page .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 18px;
        color: #999;
    }

    .booking-page .modal-content img {
        height: 60px;
        margin-bottom: 15px;
    }

    .booking-page .modal-title {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .booking-page .modal-desc {
        font-size: 14px;
        color: #9C6F4B;
        margin-bottom: 25px;
    }

    /* Booking Info Grid */
    .booking-page .booking-info { 
        display: grid; 
        grid-template-columns: repeat(2, 1fr); 
        gap: 20px 40px;
        margin-bottom: 25px; 
        justify-items: center;
    }

    /* Info Card */
    .booking-page .info-card { 
        background: #fff; 
        border-radius: 10px;
        padding: 14px 20px;
        box-shadow: 2px 2px 0px #f4a28c;
        border: 1px solid #eee;
        width: 220px;
        text-align: center;
    }

    .booking-page .info-card .title { 
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .booking-page .info-card .subtitle { 
        font-size: 14px;
        font-weight: 400;
        color: #9C6F4B;
    }

    .booking-page .info-card .subtitle i {
        font-size: 12px;
        color: #9C6F4B;
    }

    /* Next Section */
    .booking-page .next-section {
        background: #f4a28c;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        width: calc(100% - 60px);
        margin: 0 auto;
    }

    .booking-page .next-section h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #674337;
    }

    .booking-page .next-steps {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px 20px;
        font-size: 14px;
        text-align: center;
        color: #9C6F4B;
    }

    .booking-page .next-steps p {
        margin: 0;
        text-align: center;
    }
</style>
</head>
<body>
@include('layouts.navbar')

<div class="booking-page">
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

        <!-- Health Information -->
        <div class="section">
            <div class="section-title">
                <img src="{{ asset('images/Heart with dog paw.svg') }}" alt="">Health Information
            </div>
            <div class="form-group">
                <textarea placeholder="Allergies/Health Issues" rows="3"></textarea>
                <textarea placeholder="Current Medications" rows="3"></textarea>
            </div>
        </div>

        <!-- Special Notes -->
        <div class="section">
            <div class="section-title"><img src="{{ asset('images/Edit.svg') }}" alt="">Special Notes</div>
            <div class="form-group">
                <textarea placeholder="Pet's Special Instructions" rows="5"></textarea>
            </div>
        </div>

        <!-- Cost Estimation -->
        <div class="cost">
            <strong>Base Rate: Rp. 50,000/day</strong>
            Final cost will be calculated based on duration and selected additional services
        </div>

        <!-- Submit Button -->
        <button class="submit-btn" onclick="openModal()">Submit Booking</button>
        <div class="note">Our team will contact you within 24 hours for confirmation</div>
    </div>
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
        </div>

        <div class="next-section">
            <h3>What happens next?</h3>
            <div class="next-steps">
                <p>1. Review within 2 hours</p>
                <p>2. Confirmation call in 24h</p>
                <p>3. Email preparation guide</p>
                <p>4. Payment on drop-off</p>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    function openModal(){
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
</body>
</html>
