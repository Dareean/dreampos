# Deployment Checklist untuk IMS

Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  IMS Deployment Checklist           " -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

$issues = @()
$warnings = @()
$success = @()

# Check 1: Database file exists
Write-Host "Checking database file..." -NoNewline
if (Test-Path "Database\ims.sql") {
    Write-Host " OK" -ForegroundColor Green
    $success += "Database file found"
} else {
    Write-Host " FAIL" -ForegroundColor Red
    $issues += "Database file not found"
}

# Check 2: Configuration files
Write-Host "Checking configuration files..." -NoNewline
if (Test-Path "initialize.php") {
    Write-Host " OK" -ForegroundColor Green
    $success += "Configuration files exist"
    
    # Check if using localhost
    $initContent = Get-Content "initialize.php" -Raw
    if ($initContent -match "localhost") {
        Write-Host "  WARNING: Still using localhost in initialize.php" -ForegroundColor Yellow
        $warnings += "Update database host in initialize.php for production"
    }
    if ($initContent -match "http://localhost/ims/") {
        Write-Host "  WARNING: base_url still set to localhost" -ForegroundColor Yellow
        $warnings += "Update base_url in initialize.php to your production domain"
    }
} else {
    Write-Host " FAIL" -ForegroundColor Red
    $issues += "initialize.php not found"
}

# Check 3: Vendor dependencies
Write-Host "Checking dependencies..." -NoNewline
if (Test-Path "vendor\autoload.php") {
    Write-Host " OK" -ForegroundColor Green
    $success += "Composer dependencies installed"
} else {
    Write-Host " WARNING" -ForegroundColor Yellow
    $warnings += "Run 'composer install' before deployment"
}

# Check 4: Upload directories exist
Write-Host "Checking upload directories..." -NoNewline
$uploadDirs = @(
    "assets\img\brand"
)
$uploadOK = $true
foreach ($dir in $uploadDirs) {
    if (!(Test-Path $dir)) {
        $uploadOK = $false
        $issues += "Directory missing: $dir"
    }
}
if ($uploadOK) {
    Write-Host " OK" -ForegroundColor Green
    $success += "Upload directories exist"
} else {
    Write-Host " FAIL" -ForegroundColor Red
}

# Check 5: .htaccess file
Write-Host "Checking .htaccess..." -NoNewline
if (Test-Path ".htaccess") {
    Write-Host " OK" -ForegroundColor Green
    $success += ".htaccess file exists"
    
    $htaccess = Get-Content ".htaccess" -Raw
    if ($htaccess -match "RewriteBase /ims/") {
        Write-Host "  INFO: RewriteBase set to /ims/ (update for production)" -ForegroundColor Cyan
        $warnings += "Update RewriteBase in .htaccess if deploying to root"
    }
} else {
    Write-Host " WARNING" -ForegroundColor Yellow
    $warnings += ".htaccess not found - URL rewriting may not work"
}

# Check 6: Sensitive files
Write-Host "Checking for sensitive files..." -NoNewline
$sensitiveFiles = @(
    ".env",
    "config.local.php",
    ".htpasswd"
)
$foundSensitive = @()
foreach ($file in $sensitiveFiles) {
    if (Test-Path $file) {
        $foundSensitive += $file
    }
}
if ($foundSensitive.Count -eq 0) {
    Write-Host " OK" -ForegroundColor Green
} else {
    Write-Host " WARNING" -ForegroundColor Yellow
    foreach ($file in $foundSensitive) {
        Write-Host "  Found: $file (make sure to add to .gitignore)" -ForegroundColor Yellow
    }
}

# Check 7: .gitignore
Write-Host "Checking .gitignore..." -NoNewline
if (Test-Path ".gitignore") {
    Write-Host " OK" -ForegroundColor Green
    $success += ".gitignore exists"
} else {
    Write-Host " WARNING" -ForegroundColor Yellow
    $warnings += ".gitignore not found - sensitive data might be committed"
}

# Check 8: Test files
Write-Host "Checking for test files..." -NoNewline
$testFiles = @(
    "testmd.php",
    "admin\test-ajax.html"
)
$foundTest = @()
foreach ($file in $testFiles) {
    if (Test-Path $file) {
        $foundTest += $file
    }
}
if ($foundTest.Count -gt 0) {
    Write-Host " WARNING" -ForegroundColor Yellow
    foreach ($file in $foundTest) {
        Write-Host "  Found: $file (consider removing for production)" -ForegroundColor Yellow
    }
    $warnings += "Remove test files before production deployment"
} else {
    Write-Host " OK" -ForegroundColor Green
}

Write-Host ""
Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  Summary" -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan

Write-Host ""
Write-Host "Successes: $($success.Count)" -ForegroundColor Green
foreach ($item in $success) {
    Write-Host "  [OK] $item" -ForegroundColor Green
}

if ($warnings.Count -gt 0) {
    Write-Host ""
    Write-Host "Warnings: $($warnings.Count)" -ForegroundColor Yellow
    foreach ($item in $warnings) {
        Write-Host "  [WARN] $item" -ForegroundColor Yellow
    }
}

if ($issues.Count -gt 0) {
    Write-Host ""
    Write-Host "Issues: $($issues.Count)" -ForegroundColor Red
    foreach ($item in $issues) {
        Write-Host "  [FAIL] $item" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  Pre-Deployment Checklist" -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

$checklist = @(
    "Update base_url in initialize.php",
    "Update database credentials in initialize.php",
    "Export fresh database from phpMyAdmin",
    "Test all features locally",
    "Remove test files",
    "Update .htaccess RewriteBase if needed",
    "Create .env file with production values",
    "Set display_errors to Off in production",
    "Enable HTTPS force in .htaccess",
    "Change all default passwords",
    "Setup file permissions properly",
    "Configure PHPMailer with production SMTP",
    "Test database connection",
    "Backup everything before deploy"
)

foreach ($item in $checklist) {
    Write-Host "  [ ] $item" -ForegroundColor White
}

Write-Host ""
Write-Host "Next Steps:" -ForegroundColor Cyan
Write-Host "  1. Fix all ISSUES (red)" -ForegroundColor White
Write-Host "  2. Address WARNINGS (yellow)" -ForegroundColor White
Write-Host "  3. Complete checklist items above" -ForegroundColor White
Write-Host "  4. Read DEPLOYMENT_GUIDE.md for detailed instructions" -ForegroundColor White
Write-Host "  5. Choose your deployment platform" -ForegroundColor White
Write-Host "  6. Deploy!" -ForegroundColor White
Write-Host ""

Write-Host "======================================" -ForegroundColor Cyan
