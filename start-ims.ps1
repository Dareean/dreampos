# IMS Quick Start Script
# Run this script to start XAMPP services and open the application

Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  Inventory Management System (IMS)  " -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

# Check if XAMPP is installed
if (!(Test-Path "C:\xampp\xampp-control.exe")) {
    Write-Host "ERROR: XAMPP not found at C:\xampp\" -ForegroundColor Red
    Write-Host "Please install XAMPP first." -ForegroundColor Yellow
    Read-Host "Press Enter to exit"
    exit
}

# Check if Apache is running
$apacheRunning = Get-Process -Name "httpd" -ErrorAction SilentlyContinue
$mysqlRunning = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue

if (!$apacheRunning -or !$mysqlRunning) {
    Write-Host "Starting XAMPP services..." -ForegroundColor Yellow
    
    # Start Apache
    if (!$apacheRunning) {
        Write-Host "Starting Apache..." -ForegroundColor Yellow
        Start-Process "C:\xampp\apache_start.bat" -WindowStyle Hidden
        Start-Sleep -Seconds 2
    }
    
    # Start MySQL
    if (!$mysqlRunning) {
        Write-Host "Starting MySQL..." -ForegroundColor Yellow
        Start-Process "C:\xampp\mysql_start.bat" -WindowStyle Hidden
        Start-Sleep -Seconds 3
    }
    
    Write-Host "Waiting for services to start..." -ForegroundColor Yellow
    Start-Sleep -Seconds 3
}

# Check status again
$apacheRunning = Get-Process -Name "httpd" -ErrorAction SilentlyContinue
$mysqlRunning = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue

Write-Host ""
Write-Host "Service Status:" -ForegroundColor Cyan
Write-Host "  Apache: " -NoNewline
if ($apacheRunning) {
    Write-Host "RUNNING" -ForegroundColor Green
} else {
    Write-Host "NOT RUNNING" -ForegroundColor Red
    Write-Host "  Please start Apache manually from XAMPP Control Panel" -ForegroundColor Yellow
}

Write-Host "  MySQL:  " -NoNewline
if ($mysqlRunning) {
    Write-Host "RUNNING" -ForegroundColor Green
} else {
    Write-Host "NOT RUNNING" -ForegroundColor Red
    Write-Host "  Please start MySQL manually from XAMPP Control Panel" -ForegroundColor Yellow
}

Write-Host ""

# Open application if services are running
if ($apacheRunning -and $mysqlRunning) {
    Write-Host "Opening IMS application..." -ForegroundColor Green
    Start-Sleep -Seconds 2
    Start-Process "http://localhost/ims/login.php"
    
    Write-Host ""
    Write-Host "Available URLs:" -ForegroundColor Cyan
    Write-Host "  Login:        http://localhost/ims/login.php" -ForegroundColor White
    Write-Host "  Admin Panel:  http://localhost/ims/admin/" -ForegroundColor White
    Write-Host "  User Panel:   http://localhost/ims/users/" -ForegroundColor White
    Write-Host "  phpMyAdmin:   http://localhost/phpmyadmin" -ForegroundColor White
} else {
    Write-Host "Cannot open application - services not running" -ForegroundColor Red
    Write-Host "Please start services from XAMPP Control Panel" -ForegroundColor Yellow
    
    $response = Read-Host "Open XAMPP Control Panel? (Y/N)"
    if ($response -eq "Y" -or $response -eq "y") {
        Start-Process "C:\xampp\xampp-control.exe"
    }
}

Write-Host ""
Write-Host "======================================" -ForegroundColor Cyan
