<?php


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hr_system');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS " . DB_NAME);
mysqli_select_db($conn, DB_NAME);


mysqli_set_charset($conn, 'utf8mb4');


mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        role ENUM('admin', 'hr', 'viewer') DEFAULT 'viewer',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");


mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS karyawan (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nip VARCHAR(20) UNIQUE NOT NULL,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        telepon VARCHAR(20),
        jabatan VARCHAR(100),
        departemen VARCHAR(100),
        tanggal_masuk DATE,
        status ENUM('aktif', 'cuti', 'nonaktif') DEFAULT 'aktif',
        gaji DECIMAL(15,2) DEFAULT 0,
        foto VARCHAR(255) DEFAULT NULL,
        alamat TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
");


mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS departemen (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        kepala VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");


$checkAdmin = mysqli_query($conn, "SELECT id FROM users WHERE username = 'admin'");
if (mysqli_num_rows($checkAdmin) == 0) {
    $hashed = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (username, password, full_name, role) VALUES ('admin', '$hashed', 'Administrator', 'admin')");
}


$checkDept = mysqli_query($conn, "SELECT id FROM departemen");
if (mysqli_num_rows($checkDept) == 0) {
    mysqli_query($conn, "INSERT INTO departemen (nama, kepala) VALUES 
        ('Teknologi Informasi', 'Budi Santoso'),
        ('Human Resources', 'Siti Rahayu'),
        ('Keuangan', 'Ahmad Fauzi'),
        ('Marketing', 'Dewi Lestari'),
        ('Operasional', 'Rudi Hermawan')
    ");
}


$checkKaryawan = mysqli_query($conn, "SELECT id FROM karyawan");
if (mysqli_num_rows($checkKaryawan) == 0) {
    mysqli_query($conn, "INSERT INTO karyawan (nip, nama, email, telepon, jabatan, departemen, tanggal_masuk, status, gaji, alamat) VALUES 
        ('EMP001', 'Budi Santoso', 'budi@company.com', '081234567890', 'Senior Developer', 'Teknologi Informasi', '2020-03-15', 'aktif', 12000000, 'Jl. Raya Darmo No. 10, Surabaya'),
        ('EMP002', 'Siti Rahayu', 'siti@company.com', '082345678901', 'HR Manager', 'Human Resources', '2019-07-01', 'aktif', 10000000, 'Jl. Pemuda No. 55, Surabaya'),
        ('EMP003', 'Ahmad Fauzi', 'ahmad@company.com', '083456789012', 'Finance Analyst', 'Keuangan', '2021-01-10', 'aktif', 9000000, 'Jl. Basuki Rahmat No. 22, Surabaya'),
        ('EMP004', 'Dewi Lestari', 'dewi@company.com', '084567890123', 'Marketing Lead', 'Marketing', '2022-05-20', 'cuti', 8500000, 'Jl. Gubeng No. 8, Surabaya'),
        ('EMP005', 'Rudi Hermawan', 'rudi@company.com', '085678901234', 'Operations Manager', 'Operasional', '2018-11-30', 'aktif', 11000000, 'Jl. Diponegoro No. 45, Surabaya')
    ");
}
?>