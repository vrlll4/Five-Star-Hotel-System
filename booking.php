<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// الاتصال بقاعدة بياناتك الذكية hotel1_db
$conn = new mysqli("localhost", "root", "", "hotel1_db");
if ($conn->connect_error) { die("Database Connection failed: " . $conn->connect_error); }

$message = "";
if (isset($_POST['book_room'])) {
    $guest_name = $_POST['guest_name'];
    $room_no = $_POST['room_no'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $num_guests = $_POST['num_guests'];
    $guest_id = "G" . rand(100, 999);

    // إضافة النزيل أولاً لـ guestdetails
    $sql_guest = "INSERT INTO guestdetails (GuestID, GuestName, PhoneNumber, CheckInDate, CheckOutDate, Guests) 
                  VALUES ('$guest_id', '$guest_name', '0555555555', '$check_in', '$check_out', $num_guests)";
    
    if ($conn->query($sql_guest) === TRUE) {
        // إضافة الحجز في جدول bookings
        $sql_booking = "INSERT INTO bookings (GuestID, RoomNo, CheckInDate, CheckOutDate, NumOfGuests) 
                        VALUES ('$guest_id', '$room_no', '$check_in', '$check_out', $num_guests)";
        
        if ($conn->query($sql_booking) === TRUE) {
            $message = "<div class='alert success'>🎉 Reservation Confirmed Successfully for Room $room_no!</div>";
        } else {
            $message = "<div class='alert error'>❌ Error: Room is already booked for this date! (Double Booking Prevented)</div>";
        }
    } else {
        $message = "<div class='alert error'>❌ Connection Database Error.</div>";
    }
}

// جلب الغرف الحقيقية المعروضة
$rooms_result = $conn->query("SELECT * FROM room");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Offers & Reservations - 5-Star Hotel</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #020617; color: #f8fafc; margin: 0; padding: 20px; }
        .header { text-align: center; padding: 30px; background: #0f172a; border-radius: 12px; margin-bottom: 30px; border: 1px solid #1e293b; }
        .header h1 { color: #38bdf8; margin: 0; font-size: 28px; }
        .header h3 { color: #94a3b8; font-weight: 400; font-size: 16px; margin-top: 5px; }
        .offers-title { font-size: 22px; color: #38bdf8; border-bottom: 2px solid #1e293b; padding-bottom: 10px; margin-bottom: 20px; font-weight: 600; }
        .rooms-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .room-card { background: #0f172a; border-radius: 12px; overflow: hidden; border: 1px solid #1e293b; transition: 0.3s; }
        .room-card:hover { transform: translateY(-5px); border-color: #38bdf8; }
        .room-card img { width: 100%; height: 180px; object-fit: cover; }
        .room-info { padding: 15px; }
        .room-info h4 { margin: 0 0 10px 0; color: #f1f5f9; font-size: 18px; }
        .room-info p { margin: 5px 0; color: #94a3b8; font-size: 14px; }
        .price { color: #38bdf8; font-weight: bold; font-size: 16px; margin-top: 10px; }
        .booking-container { background: #0f172a; padding: 30px; border-radius: 12px; max-width: 600px; margin: 0 auto; border: 1px solid #1e293b; }
        .booking-container h3 { color: #38bdf8; margin-top: 0; text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #94a3b8; font-size: 14px; }
        .form-group input, .form-group select { width: 100%; padding: 11px; background: #020617; border: 1px solid #1e293b; border-radius: 6px; color: #fff; font-size: 14px; box-sizing: border-box; }
        .form-group input:focus, .form-group select:focus { border-color: #38bdf8; outline: none; }
        .btn-submit { width: 100%; padding: 12px; background: #2563eb; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { background: #3b82f6; }
        .alert { padding: 15px; border-radius: 6px; max-width: 600px; margin: 0 auto 20px auto; text-align: center; font-weight: 500; }
        .success { background: rgba(22, 163, 74, 0.2); color: #4ade80; border: 1px solid #16a34a; }
        .error { background: rgba(220, 38, 38, 0.2); color: #f87171; border: 1px solid #dc2626; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h1>
        <h3>5-Star Exclusive Luxury Suite Management</h3>
    </div>

    <?php echo $message; ?>

    <div class="offers-title">Luxury Rooms & Suites Directory</div>
    <div class="rooms-grid">
        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500" alt="Deluxe Room">
            <div class="room-info">
                <h4>Deluxe Single Suite</h4>
                <p>Capacity: 1 Guest</p>
                <p>Features: King Bed, Ocean View, High-Speed Wi-Fi.</p>
                <div class="price">350 USD / Night</div>
            </div>
        </div>
        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=500" alt="Executive Room">
            <div class="room-info">
                <h4>Executive Double Suite</h4>
                <p>Capacity: 2 Guests</p>
                <p>Features: Double Beds, Mini-Bar, Luxury Marble Bath.</p>
                <div class="price">550 USD / Night</div>
            </div>
        </div>
        <div class="room-card">
            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=500" alt="Presidential Suite">
            <div class="room-info">
                <h4>Presidential Royal Suite</h4>
                <p>Capacity: 4 Guests</p>
                <p>Features: Private Jacuzzi, 24/7 Butler Service, Panoramic Lounge.</p>
                <div class="price">1200 USD / Night</div>
            </div>
        </div>
    </div>

    <div class="booking-container">
        <h3>5-Star Room Reservation Form</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label>Guest Full Name</label>
                <input type="text" name="guest_name" placeholder="Enter full guest name" required>
            </div>
            <div class="form-group">
                <label>Assign Room</label>
                <select name="room_no" required>
                    <option value="">-- Select Room from Live Database --</option>
                    <?php 
                    if($rooms_result && $rooms_result->num_rows > 0){
                        while($row = $rooms_result->fetch_assoc()) {
                            echo "<option value='".$row['RoomNo']."'>Room ".$row['RoomNo']." - ".$row['RoomType']." (".$row['PricePerNight']." SAR)</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Total Number of Guests</label>
                <input type="number" name="num_guests" min="1" max="4" required>
            </div>
            <div class="form-group">
                <label>Check-In Date</label>
                <input type="date" name="check_in" required>
            </div>
            <div class="form-group">
                <label>Check-Out Date</label>
                <input type="date" name="check_out" required>
            </div>
            <button type="submit" name="book_room" class="btn-submit">Confirm 5-Star Booking</button>
        </form>
    </div>

</body>
</html>