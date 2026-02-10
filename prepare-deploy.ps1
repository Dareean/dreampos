# Prepare Deployment Package
# This script creates a clean copy of the project ready for deployment

param(
    [string]$OutputPath = "..\ims-deploy"
)

Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  IMS Deployment Package Creator     " -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""

$sourcePath = Get-Location

# Files and folders to exclude
$excludeItems = @(
    ".git",
    ".vscode",
    ".idea",
    "*.log",
    "*.bak",
    "*.tmp",
    ".env",
    ".env.local",
    "check-deploy.ps1",
    "prepare-deploy.ps1",
    "start-ims.ps1",
    "DEPLOYMENT_GUIDE.md",
    "SETUP_GUIDE.md",
    "QUICK_REFERENCE.md"
)

Write-Host "Source: $sourcePath" -ForegroundColor White
Write-Host "Output: $OutputPath" -ForegroundColor White
Write-Host ""

# Create output directory
if (Test-Path $OutputPath) {
    Write-Host "Output directory exists. Delete it? (Y/N)" -ForegroundColor Yellow
    $response = Read-Host
    if ($response -eq "Y" -or $response -eq "y") {
        Remove-Item $OutputPath -Recurse -Force
        Write-Host "Deleted existing directory" -ForegroundColor Green
    } else {
        Write-Host "Aborted" -ForegroundColor Red
        exit
    }
}

Write-Host "Creating deployment package..." -ForegroundColor Cyan

# Create directory
New-Item -ItemType Directory -Path $OutputPath -Force | Out-Null

# Copy files
Write-Host "Copying files..." -ForegroundColor Yellow
$filesToCopy = Get-ChildItem -Path $sourcePath -Recurse -File | Where-Object {
    $file = $_
    $exclude = $false
    
    foreach ($pattern in $excludeItems) {
        if ($file.Name -like $pattern -or $file.FullName -like "*$pattern*") {
            $exclude = $true
            break
        }
    }
    
    return -not $exclude
}

$totalFiles = $filesToCopy.Count
$currentFile = 0

foreach ($file in $filesToCopy) {
    $currentFile++
    $percent = [math]::Round(($currentFile / $totalFiles) * 100)
    
    $relativePath = $file.FullName.Substring($sourcePath.Path.Length + 1)
    $targetPath = Join-Path $OutputPath $relativePath
    $targetDir = Split-Path $targetPath -Parent
    
    if (!(Test-Path $targetDir)) {
        New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
    }
    
    Copy-Item $file.FullName -Destination $targetPath -Force
    
    Write-Progress -Activity "Copying files" -Status "$currentFile of $totalFiles" -PercentComplete $percent
}

Write-Progress -Activity "Copying files" -Completed

Write-Host "✓ Copied $totalFiles files" -ForegroundColor Green

# Create production .htaccess
Write-Host "Preparing production .htaccess..." -ForegroundColor Yellow
if (Test-Path "$sourcePath\.htaccess.production") {
    Copy-Item "$sourcePath\.htaccess.production" -Destination "$OutputPath\.htaccess" -Force
    Write-Host "✓ Production .htaccess created" -ForegroundColor Green
}

# Create .env.example
Write-Host "Copying .env.example..." -ForegroundColor Yellow
if (Test-Path "$sourcePath\.env.example") {
    Copy-Item "$sourcePath\.env.example" -Destination "$OutputPath\.env.example" -Force
    Write-Host "✓ .env.example included" -ForegroundColor Green
}

# Create deployment instructions
Write-Host "Creating deployment instructions..." -ForegroundColor Yellow
$instructions = @"
# Deployment Instructions

## Files Prepared
This package contains a clean copy of your IMS application ready for deployment.

## Before Uploading:

1. Update 'initialize.php':
   - Change base_url to your domain
   - Update database credentials

2. Update '.htaccess':
   - Change RewriteBase to / (if deploying to root)
   - Uncomment HTTPS redirect lines (if you have SSL)

3. Create '.env' file from '.env.example' with your production values

## Upload Steps:

### Via FTP:
1. Connect to your hosting FTP
2. Upload all files to public_html/ (or your web root)
3. Set folder permissions: 755 for assets/img/

### Via cPanel:
1. Zip this folder
2. Upload ZIP to cPanel File Manager
3. Extract in public_html/
4. Set permissions

## After Upload:

1. Create MySQL database in cPanel
2. Import Database/ims.sql via phpMyAdmin
3. Test: https://yourdomain.com/login.php

## Security:
- Change all default passwords
- Test all features
- Enable HTTPS
- Monitor error logs

Created: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
"@

$instructions | Out-File -FilePath "$OutputPath\DEPLOY_README.txt" -Encoding UTF8
Write-Host "✓ Instructions created" -ForegroundColor Green

# Calculate package size
$size = (Get-ChildItem $OutputPath -Recurse | Measure-Object -Property Length -Sum).Sum
$sizeMB = [math]::Round($size / 1MB, 2)

Write-Host ""
Write-Host "======================================" -ForegroundColor Cyan
Write-Host "  Package Created Successfully!       " -ForegroundColor Green
Write-Host "======================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Location: $OutputPath" -ForegroundColor White
Write-Host "Size: $sizeMB MB" -ForegroundColor White
Write-Host "Files: $totalFiles" -ForegroundColor White
Write-Host ""

Write-Host "Next Steps:" -ForegroundColor Cyan
Write-Host "  1. Edit initialize.php in the deployment package" -ForegroundColor White
Write-Host "  2. Review .htaccess settings" -ForegroundColor White
Write-Host "  3. Create .env file from .env.example" -ForegroundColor White
Write-Host "  4. Read DEPLOY_README.txt" -ForegroundColor White
Write-Host "  5. Upload to your hosting" -ForegroundColor White
Write-Host ""

$response = Read-Host "Open deployment folder? (Y/N)"
if ($response -eq "Y" -or $response -eq "y") {
    Start-Process explorer.exe $OutputPath
}

Write-Host ""
Write-Host "Done! 🚀" -ForegroundColor Green
