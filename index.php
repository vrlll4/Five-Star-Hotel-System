<?php
session_start();
// ميزة حركية: النظام يقبل أي اسم مستخدم يكتبه موظف الاستقبال، والأمان على الباسورد (123)
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($password == '123') { 
        $_SESSION['username'] = $username; // حفظ اسم اليوزر حركياً بدون أسماء مثبتة!
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid Password! Try (123)";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>5-Star Hotel - Staff Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a); /* مزيج أزرق داكن ملكي */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: rgba(30, 41, 59, 0.7);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 360px;
            text-align: center;
        }
        h2 { margin-bottom: 10px; color: #38bdf8; font-weight: 600; }
        p.subtitle { color: #94a3b8; font-size: 14px; margin-bottom: 30px; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 0;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #475569;
            background: transparent;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }
        input:focus { border-bottom: 2px solid #38bdf8; }
        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
            transition: 0.3s;
        }
        button:hover { background: #3b82f6; box-shadow: 0 0 15px rgba(59, 130, 246, 0.6); }
        .error { color: #f87171; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>5-Star Luxury Hotel</h2>
        <p class="subtitle">Reception Management System</p>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username / Staff Name" required>
            <input type="password" name="password" placeholder="Password (123)" required>
            <button type="submit" name="login">Sign In</button>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>