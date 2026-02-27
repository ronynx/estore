<?php
// setup.php - One-time setup for eStore

$host = "localhost";
$username = "root";
$password = "";
$database = "estore";

$conn = mysqli_connect($host, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}
echo "Database '$database' created or already exists.<br>";

mysqli_select_db($conn, $database);

$table_check = "SHOW TABLES LIKE 'users'";
$result = mysqli_query($conn, $table_check);
if (mysqli_num_rows($result) > 0) {
    die("Setup has already been executed. Delete this file only if you want to reset the database.");
}

$sql_users = "
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    term TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";
mysqli_query($conn, $sql_users) or die("Error creating users table: " . mysqli_error($conn));
echo "Table 'users' created successfully.<br>";


$sql_admins = "
CREATE TABLE admins (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";
mysqli_query($conn, $sql_admins) or die("Error creating admins table: " . mysqli_error($conn));
echo "Table 'admins' created successfully.<br>";


$default_admin_password = password_hash("admin123", PASSWORD_DEFAULT);
$sql_default_admin = "
INSERT INTO admins (username, password, email)
SELECT 'admin', '$default_admin_password', 'admin@example.com'
WHERE NOT EXISTS (SELECT 1 FROM admins WHERE username='admin')
";
mysqli_query($conn, $sql_default_admin);
echo "Default admin user created (username: admin, password: admin123).<br>";


$sql_products = "
CREATE TABLE products (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";
mysqli_query($conn, $sql_products) or die("Error creating products table: " . mysqli_error($conn));
echo "Table 'products' created successfully.<br>";

$products = [
    ['name' => 'Wireless Mouse', 'description' => 'Ergonomic wireless mouse with USB receiver.', 'price' => 15.99, 'image' => 'assets/images/products/mouse.jpg'],
    ['name' => 'Gaming Keyboard', 'description' => 'Mechanical keyboard with RGB backlight.', 'price' => 49.99, 'image' => 'assets/images/products/keyboard.jpg'],
    ['name' => 'HD Monitor', 'description' => '24-inch full HD LED monitor.', 'price' => 129.99, 'image' => 'assets/images/products/monitor.jpg'],
    ['name' => 'USB-C Charger', 'description' => 'Fast charging USB-C adapter.', 'price' => 19.99, 'image' => 'assets/images/products/charger.jpg'],
    ['name' => 'Bluetooth Headphones', 'description' => 'Noise-cancelling over-ear headphones.', 'price' => 59.99, 'image' => 'assets/images/products/headphones.jpg'],
    ['name' => 'External Hard Drive', 'description' => '1TB USB 3.0 portable external hard drive.', 'price' => 74.99, 'image' => 'assets/images/products/harddrive.jpg'],
    ['name' => 'Webcam HD', 'description' => '1080p HD webcam with built-in microphone.', 'price' => 39.99, 'image' => 'assets/images/products/webcam.jpg'],
    ['name' => 'Laptop Stand', 'description' => 'Adjustable aluminum laptop stand for desk.', 'price' => 29.99, 'image' => 'assets/images/products/laptopstand.jpg']
];

foreach ($products as $p) {
    $name  = mysqli_real_escape_string($conn, $p['name']);
    $desc  = mysqli_real_escape_string($conn, $p['description']);
    $price = $p['price'];
    $img   = mysqli_real_escape_string($conn, $p['image']);

    $insert_sql = "INSERT INTO products (name, description, price, image)
                   SELECT '$name', '$desc', '$price', '$img'
                   WHERE NOT EXISTS (SELECT 1 FROM products WHERE name='$name')";
    mysqli_query($conn, $insert_sql);
}

echo "Sample products inserted successfully.<br>";

mysqli_close($conn);

echo "<br><br><a href='index.php' style='padding:10px 20px; background-color:#007bff; color:#fff; text-decoration:none; border-radius:5px;'>Go to Home Page</a>";

// Delete this setup file for security
if (file_exists(__FILE__)) {
    unlink(__FILE__);
    echo "<br><br>Setup completed. This file has been deleted automatically for security.";
}
?>
