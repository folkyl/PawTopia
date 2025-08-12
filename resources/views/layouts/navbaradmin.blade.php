<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawtopia Sidebar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            width: 250px;
            background: #fff;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }
        .logo img {
            height: 30px;
            margin-right: 10px;
        }
        .logo span {
            font-weight: 700;
            font-size: 20px;
        }
        .logo .paw {
            color: #F28C48;
        }
        .logo .topia {
            color: #4B2E2B;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        ul li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            color: #4B2E2B;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        ul li a i {
            margin-right: 10px;
            transition: transform 0.3s ease;
        }
        ul li a:hover {
            background: #FFE5CC;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
            transform: translateX(5px);
        }
        ul li a:hover i {
            transform: rotate(8deg) scale(1.1);
            color: #F28C48;
        }
        ul li a.active {
            background: #FDD8A8;
            color: #5C3B28;
            font-weight: 600;
            box-shadow: inset 3px 0 0 #F28C48;
        }
        button.logout {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            background: transparent;
            border: none;
            color: #ff1900ff;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            text-align: left;
            margin-top: 130px;
            font-size: 16px;
            transition: background 0.3s, color 0.3s, transform 0.2s;
        }
        button.logout i {
            margin-right: 10px;
            font-size: 18px;
            transition: transform 0.3s ease;
        }
        button.logout:hover {
            background: #FFE5CC;
            color: #d10000;
            transform: scale(1.04);
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }
        button.logout:hover i {
            transform: rotate(-8deg) scale(1.1);
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="Pawtopia Logo">
        </div>

        <!-- Menu -->
        <ul>
            <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Manage Product</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Customer</a></li>
            <li><a href="#"><i class="fas fa-edit"></i> Manage Booking</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Daycare Schedule</a></li>
            <li><a href="#"><i class="fas fa-comment"></i> Customer Testimonial</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><button class="logout"><i class="fas fa-sign-out-alt"></i> Logout</button></li>
        </ul>
    </aside>

</body>
</html>
