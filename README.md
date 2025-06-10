**Important Note on the Password:** As requested, I have included the specified admin password. However, I have also added a strong security warning and instructions for the **recommended, secure method** using the `create_admin.php` script. This is standard practice for public repositories.

---
(Copy everything below this line into your `README.md` file)

# ShopWave - Modern PHP E-commerce Platform

![ShopWave Screenshot](screenshot.png)
*(Note: Please replace `screenshot.png` with an actual screenshot of your project's homepage)*

ShopWave is a complete, modern, and animated e-commerce website built from the ground up using PHP and a MySQL database. It features a beautiful, responsive front-end for customers and a secure, comprehensive back-end admin panel for store management. The primary payment method implemented is Cash on Delivery (COD).

## ✨ Key Features

*   **Modern Front-End:**
    *   Responsive design for mobile and desktop.
    *   Interactive 3D tilt animations on product cards.
    *   Subtle fade-in-on-scroll effects.
    *   Dynamic homepage slider managed from the admin panel.
*   **Complete Shopping Cart:**
    *   PHP session-based cart.
    *   Add, update quantities, and remove items.
*   **Secure Admin Panel:**
    *   Protected login with `password_hash()` for secure password storage.
    *   Dashboard with at-a-glance store statistics.
    *   **Full CRUD** (Create, Read, Update, Delete) functionality for products.
    *   Complete order management system crucial for COD.
*   **Dynamic Site Management:**
    *   Change site settings like currency symbol, hero text, and footer content directly from the admin panel without touching the code.
*   **Cash on Delivery (COD) System:**
    *   A seamless checkout process designed for COD.
    *   Admins can track and update order statuses from `Pending` to `Delivered`.

## 🛠️ Tech Stack

*   **Back-End:** PHP
*   **Database:** MySQL / MariaDB
*   **Front-End:** HTML5, CSS3, JavaScript
*   **Animations:** [Vanilla-Tilt.js](https://micku7zu.github.io/vanilla-tilt.js/) for the 3D effect.

## 🚀 Setup and Installation

Follow these steps to get the project running on your local machine.

### 1. Prerequisites

You need a local server environment that supports PHP and MySQL. We recommend **XAMPP**:
*   [Download and Install XAMPP](https://www.apachefriends.org/index.html)

### 2. Clone the Repository

Open your terminal or command prompt and clone this repository into your XAMPP `htdocs` folder:
```bash
git clone https://github.com/debarjunmaharaj/ShopWave.git
```
*(Replace `your-username` with your actual GitHub username)*

Alternatively, you can download the ZIP file and extract it into the `htdocs` folder (e.g., `C:\xampp\htdocs\ShopWave`).

### 3. Database Setup

1.  **Start XAMPP:** Open the XAMPP Control Panel and start the **Apache** and **MySQL** services.
2.  **Open phpMyAdmin:** Click the "Admin" button next to MySQL to open phpMyAdmin in your browser.
3.  **Create a Database:**
    *   Click **"New"** on the left sidebar.
    *   Enter the database name as `ecommerce_db`.
    *   Click **Create**.
4.  **Import the SQL File:**
    *   Select the `ecommerce_db` database you just created.
    *   Go to the **"Import"** tab.
    *   Click **"Choose File"** and select the `database.sql` file located in the root of this project.
    *   Click **Go** at the bottom of the page. This will create all the necessary tables and default settings.

### 4. Admin User Setup

You have two options to create your admin user. The first is quick for local testing, but the second is highly recommended for security.

#### Option A: Quick & Easy (For Local Testing)

The database is pre-configured with the following admin credentials as requested:

*   **Username:** `admin`
*   **Password:** `netfieadmin1234`

> 🚨 **SECURITY WARNING** 🚨
>
> This method is **highly insecure** for a live server. The password for this user is stored in the `create_admin.php` file in plain text. **Do not use this method for production.** Please use Option B for a secure setup.

#### Option B: Secure Method (Recommended)

1.  **Edit the script:** Open the `create_admin.php` file in your code editor.
2.  **Change the password:** Find the line `$admin_password = 'netfieadmin1234';` and change the password to a new, strong password of your choice.
3.  **Run the script:** Open your browser and navigate to `http://localhost/ShopWave/create_admin.php`.
4.  **DELETE THE SCRIPT:** After you see the success message, **you must delete the `create_admin.php` file from your project folder.**

### 5. Run the Application

You are all set!

*   **Website Homepage:** [http://localhost/ShopWave/](http://localhost/ShopWave/)
*   **Admin Login Page:** [http://localhost/ShopWave/admin/login.php](http://localhost/ShopWave/admin/login.php)

## 🗂️ Admin Panel Functionality

The admin panel is the heart of your store management.

*   **Dashboard:** View key metrics like pending orders and total revenue.
*   **Products:** Add new products with images, edit existing ones, or delete them.
*   **Orders:** View all customer orders, see their details, and update the order status (e.g., from `Pending` to `Shipped`).
*   **Slider:** Upload and manage the images that appear in the homepage slider.
*   **Settings:** Update your site's currency, homepage text, and footer content without needing to edit code.

## ©️ Copyright and License

This project was created by and is copyrighted to **Debarun Chakraborty**.

The code is licensed under the MIT License. See the `LICENSE` file for more details.

```text
Copyright (c) 2025 Debarun Chakraborty

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction...
```

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/debarjunmaharaj/ShopWave/issues).
