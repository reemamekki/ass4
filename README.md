# News System 

##  About
A simple News Management System built with **PHP** and **MySQL**.  
The system allows users to manage news and categories through a dashboard.

---

##  Installation

1. **Copy the project folder** to your local server directory:
   - **XAMPP:** `C:\xampp\htdocs\NewsSystem`

2. **Database setup:**
   - Open **phpMyAdmin** by going to: `http://localhost/phpmyadmin/`
   - **Import**the SQL file  `news_system.sql`
     
---

##  Usage
Open your browser and go to: http://localhost/NewsSystem/

> Start your experience by opening `registerUi.php` to create a new account, then log in to access the dashboard.

---

##  Structure
Echo-NewsSystem/
│── addCategoryLogic.php       # Handles adding new categories
│── AddCategoryUi.php          # Form for adding categories
│── addNewsLogic.php           # Handles adding news items
│── AddNewsUi.php              # Form for adding news
│── connectionOnDatabase.php   # Database connection setup
│── dashboardUi.php            # Main dashboard page
│── deletedNews.php            # Logic for deleting news
│── deletedNewsUi.php          # View deleted news
│── editNewsLogic.php          # Logic for editing news
│── editNewsUi.php             # Form for editing news
│── loginLogic.php             # Handles user login
│── loginUi.php                # Login form
│── registerLogic.php          # Handles user registration
│── registerUi.php             # Registration form
│── restoreNews.php            # Logic to restore deleted news
│── viewCategories.php         # View all categories
│── viewNews.php               # View all news
│── uploads/                   # Folder containing uploaded images
news_system.sql                # Database file for quick import


