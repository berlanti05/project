<?php
session_start();
include 'db.php';

$error = "";

// === Login  ===
if (isset($_POST["login"])) {

    $id = $_POST["id"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if($password === $row['password']){

            $_SESSION["user_id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["type"] = $row['type'];
            $_SESSION["location"] = $row['location'];

            if($row['type'] === "admin"){
                header("Location: index.php");
                exit();
            } else {
                // location
                if(empty($row['location'])){
                    header("Location: complete_profile.php");
                    exit();
                } else {
                    header("Location: product.php");
                    exit();
                }
            }

        } else {
            $error = "Incorrect password";
        }

    } else {
        $error = "User ID not found";
    }
}

// === Google Login ===
require_once 'vendor/autoload.php';

$client = new Google\Client();
$client->setClientId("676894993162-ks57mgarg5adoukcjdfk7k5gk35mv3ek.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/mywebsite/google-callback.php");
$client->addScope("email");
$client->addScope("profile");

$google_login_url = $client->createAuthUrl();
?>

<link rel="stylesheet" href="login.css">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

<h1>LOG IN</h1>

<form action="" method="POST" class="login-form">
    <input type="text" name="id" placeholder="Enter ID" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <label class="error"><?php echo $error; ?></label>
    <button type="submit" name="login">GO</button>

    <a href="<?= $google_login_url ?>" class="google-btn">
        <img src="google.png" alt="google">
        Login with Google
    </a>
</form>

<p class="signup-text">
    Don't have an account? 
    <a href="signup.php" class="signup-btn">Sign Up</a>
</p>

<?php include 'footer.php'; ?>
