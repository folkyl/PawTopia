@php
    $activeColor = '#5C3B28';  // Coklat (aktif)
    $inactiveColor = '#F4A261'; // Orange (nonaktif)
@endphp

<nav style="display: flex; justify-content: space-between; align-items: center; padding: 20px; font-family: 'Poppins', sans-serif;">
    <!-- Logo -->
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('images/logo.svg') }}" alt="Pawtopia Logo" style="height: 30px; margin-right: 10px;">
    </div>

    <!-- Menu -->
    <ul style="list-style: none; display: flex; gap: 25px; margin: 0;">
        <li>
            <a href="{{ url('/') }}"
               style="text-decoration: none; font-weight: {{ Request::is('/') ? '700' : '500' }}; 
                      color: {{ Request::is('/') ? $activeColor : $inactiveColor }};">
                Home
            </a>
        </li>
        <li>
            <a href="{{ url('/booking') }}"
               style="text-decoration: none; font-weight: {{ Request::is('booking') ? '700' : '500' }}; 
                      color: {{ Request::is('booking') ? $activeColor : $inactiveColor }};">
                Booking
            </a>
        </li>
        <li>
            <a href="{{ url('/shop') }}"
               style="text-decoration: none; font-weight: {{ Request::is('shop') ? '700' : '500' }}; 
                      color: {{ Request::is('shop') ? $activeColor : $inactiveColor }};">
                Our Catalogue
            </a>
        </li>
        <li>
            <a href="{{ url('/contact') }}"
               style="text-decoration: none; font-weight: {{ Request::is('contact') ? '700' : '500' }}; 
                      color: {{ Request::is('contact') ? $activeColor : $inactiveColor }};">
                Contact
            </a>
        </li>
        <li>
            <a href="{{ url('/register') }}"
               style="text-decoration: none; font-weight: {{ Request::is('register') ? '700' : '500' }}; 
                      color: {{ Request::is('register') ? $activeColor : $inactiveColor }};">
                Register
            </a>
        </li>
        
    </ul>
</nav>
