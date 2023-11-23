

<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}

// Access the user ID from the session
$user_id = $_SESSION['user_id'];

// Rest of your code...

// Display the user ID
echo "User ID: $user_id";

$connect=mysqli_connect("localhost","root","","machinetest");




// Set security headers
header("X-Content-Type-Options: nosniff"); // Prevent content-type sniffing
header("X-Frame-Options: DENY"); // Prevent clickjacking
header("Content-Security-Policy: default-src 'self'"); // Define a Content Security Policy
header("Referrer-Policy: no-referrer"); // Reduce referrer leakage

// Check user authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}

// File upload handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $user_id = $_SESSION['user_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $targetDir = "uploads/";
    $allowedExtensions = ["jpg", "png", "pdf", "docx"];
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    $filename=$_FILES['file']['name'];


   
    // File type validation
    $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        // Log suspicious upload
        $logStmt =  mysqli_query($connect,"INSERT INTO logs  VALUES ('','$user_id','$ip_address','$filename',NOW(),1)");
       
        $status = "Rejected - Invalid file type";
        $logStmt->execute();
        exit("Invalid file type. Allowed types: jpg, png, pdf, docx");
    }

    // File size limit
    if ($_FILES["file"]["size"] > $maxFileSize) {
        // Log suspicious upload
        $logStmt =  mysqli_query($connect,"INSERT INTO logs VALUES('','$user_id','$ip_address','$filename',NOW(), 1)");
      
        $status = "Rejected - File size exceeded";
        
        exit("File size exceeded. Maximum size: 5MB");
    }

    // Sanitize and generate a unique filename
    $sanitizedFilename = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9_.-]/", "_", $_FILES["file"]["name"]);
    $targetFile = $targetDir . $sanitizedFilename;

    // Move the uploaded file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) 
    {
        // Record the upload in the database
        $uploadStmt =  mysqli_query($connect,"INSERT INTO fileupload VALUES('','$user_id','$filename',NOW())") ;
        
       
        // Log the upload action
        $logStmt =  mysqli_query($connect,"INSERT INTO logs VALUES('','$user_id','$ip_address','$filename',NOW(), 1)");
       
        $status = "Accepted";
       
        echo "File uploaded successfully.";
    } else {
        // Log suspicious upload
        $logStmt =  mysqli_query($connect,"INSERT INTO logs VALUES('','$user_id','$ip_address','$filename',NOW(), '1')");
       
        $status = "Rejected - Failed to move file";
        $logStmt->execute();
        echo "Error uploading the file.";
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure File Upload</title>
</head>
<body>

<h2>File Upload Form</h2>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Select File:</label>
    <input type="file" name="file" id="file" accept=".jpg, .png, .pdf, .docx" required>
    <br>
    <input type="submit" name= value="Upload File">
</form>

</body>
</html>


