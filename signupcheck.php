<?php 
include "db_conn.php"; 
session_start();

if (isset($_POST['submit'])) {

    function validate($data) {
        return htmlspecialchars(trim($data));
    }

    $fname = validate($_POST['Fname']);
    $lname = validate($_POST['Lname']);
    $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL);
    $pass = validate($_POST['Password']);
    $confpass = validate($_POST['confpwd']);
    $status = "True"; 

    if (!$email) {
        header("Location: signup.php?error=Invalid email format");
        exit();
    }

    if (empty($fname)) {
        header("Location: signup.php?error=First Name is required");
        exit();
    } 
    if (empty($lname)) {
        header("Location: signup.php?error=Last Name is required");
        exit();
    }
    if (empty($pass)) {
        header("Location: signup.php?error=Password is required");
        exit();
    } 
    if (strlen($pass) <= 4) {
        header("Location: signup.php?error=Password is too short");
        exit();
    } 
    if (empty($confpass)) {
        header("Location: signup.php?error=Confirm Your Password");
        exit();
    } 
    if ($pass !== $confpass) {
        header("Location: signup.php?error=The confirmation password does not match");
        exit();
    }

    // Hachage avec MD5 (⚠️ Peu sécurisé)
    $securedpass = md5($pass);

    // Vérification de l'existence de l'email
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        header("Location: signup.php?error=Try another email");
        exit();
    } else {
        // Inscription avec requête préparée
        $stmt = $conn->prepare("INSERT INTO users (Email, Fname, Lname, Password, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $fname, $lname, $securedpass, $status);

        if ($stmt->execute()) {
            // Connexion automatique après inscription
            $_SESSION['Email'] = $email;
            $_SESSION['Fname'] = $fname;
            $_SESSION['Lname'] = $lname;

            header("Location: index.php"); // Redirige directement vers l'accueil
            exit();
        } else {
            header("Location: signup.php?error=Database error, please try again");
            exit();
        }
    }
} else {
    header("Location: signup.php?error=Database error, please try again");
    exit();
}  
?>
