<?php
session_start();
include 'db.php'; 

$errors = [];
$success_message = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    // Get inputs
    $name = trim($_POST["name"] ?? "");
    $location = trim($_POST["location"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";

    // Validation
    if($name === "") $errors[] = "Name is required.";
    if($location === "") $errors[] = "Location is required.";
    if(strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if($password !== $confirm) $errors[] = "Passwords do not match.";

    // If valid
    if(empty($errors)){
        // Default type
        $type = "client";

      
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO users (name, type, location, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $type, $location,$password);

        if($stmt->execute()){
            $success_message = "Account created successfully.";

            // Auto login
            $_SESSION['user'] = [
                "id" => $stmt->insert_id,
                "name" => $name,
                "type" => "client",
                "location" => $location
            ];

            header("Location: index.php");
            exit;

        } else {
            $errors[] = "Database error, try again.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="signup-container">
    <div class="signup-box">
        <h1>Create Account</h1>

        <!-- Show errors -->
        <?php if(!empty($errors)): ?>
            <div class="error-box">
                <?php foreach($errors as $e): ?>
                    <p><?= $e ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Success -->
        <?php if($success_message): ?>
            <div class="success-box"><?= $success_message ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" required>

            <label>Location</label>
            <input type="text" name="location" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

</body>
</html>
