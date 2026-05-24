<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - 5-Star Hotel</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #020617; /* أزرق ملكي داكن جداً ومريح للعين */
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .welcome-container {
            background: #0f172a;
            padding: 50px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
            border: 1px solid #1e293b;
            max-width: 500px;
        }
        h1 { color: #cbd5e1; font-size: 30px; font-weight: 500; }
        span { color: #38bdf8; font-weight: 700; } /* ترحيب باسم اليوزر الحركي */
        p { font-size: 16px; margin: 25px 0; color: #94a3b8; line-height: 1.6; }
        .btn-booking {
            display: inline-block;
            padding: 14px 35px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-booking:hover { background: #3b82f6; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</h1>
        <p>You have logged in successfully to the 5-Star Hotel dashboard. To manage room reservations, please click the button below:</p>
        <a href="booking.php" class="btn-booking">Click Here to Book</a>
    </div>
</body>
</html>