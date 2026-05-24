# 🏨 5-Star Luxury Hotel Management System (Five_Star_Hotel)

Welcome to the official documentation for the 5-Star Hotel System. This guide explains how the project was built from scratch and how to run it.
مرحباً بك في الدليل الرسمي لفندق الـ 5 نجوم. هذا الملف يشرح خطوة بخطوة كيف بنينا المشروع من الصفر.

---

## 📁 Phase 1: Folder & Files Setup (تأسيس المجلد والبيانات)
1. **Create Project Folder:** We went to `C:\xampp\htdocs\` and created a new folder named `Five_Star_Hotel`.
2. **Move Excel Files:** We copied the data files (`room.csv` and `guestdetails.csv`) and pasted them inside our new folder.

---

## 💻 Phase 2: Creating the Pages in VS Code (كتابة الأكواد)
We opened the folder in VS Code and created 3 separate PHP files:

1. **`index.php` (Staff Login Page):**
   - Designed with a Royal Blue theme for eye comfort.
   - Accepts any username dynamically and checks if the password is `123`.

2. **`welcome.php` (Success Welcome Page):**
   - Uses PHP Sessions to remember the receptionist's name.
   - Displays a dynamic welcome message: "Welcome, [Username]!".

3. **`booking.php` (Offers & Live Reservation Container):**
   - Connected directly to our MySQL database (`hotel1_db`).
   - Displays premium room cards with real luxury images.
   - Contains the live booking form that sends registration details straight to the server tables.

---

## 🗄️ Phase 3: Database Connection (قاعدة البيانات والسيرفر)
1. Opened XAMPP Control Panel and started Apache & MySQL.
2. Imported `room.csv` and `guestdetails.csv` into `hotel1_db` inside phpMyAdmin.
3. Linked `booking.php` code to the active database to fetch live rooms directory.

---

## 🚀 Phase 4: Uploading to GitHub (أوامر الرفع للسحاب)
To upload this clean package to GitHub, open the VS Code Terminal and run these commands:

```bash
git init
git add .
git commit -m "Initial commit: Completed dynamic 5-star hotel system with clean architecture"
git branch -M main
git remote add origin [https://github.com/YOUR_USERNAME/Five-Star-Hotel-System.git](https://github.com/YOUR_USERNAME/Five-Star-Hotel-System.git)
git push -u origin main