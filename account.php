<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/home.css">
    <link rel="stylesheet" type="text/css" href="CSS/account.css">
    <script>
        function deleteAccount(){
            if (confirm("Do you want to delete your account?\nClick OK to proceed or Cancel to abort.")) {
                document.getElementById("delete-form").style.display = "block";
            }
        }
    </script>
</head>
<body class="bg-light">
    <header>
        <?php include "header.php" ?>
    </header>
    
    <?php
        session_start();
        $user_email = $_SESSION['Email'];
        $first_name = $_SESSION['Fname'];
        $last_name = $_SESSION['Lname'];
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img src="images/avatarpurple.png" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                <h3><?php echo htmlspecialchars($first_name . " " . $last_name); ?></h3>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow">
                <p><b>First Name:</b> <?php echo htmlspecialchars($first_name); ?></p>
                <p><b>Last Name:</b> <?php echo htmlspecialchars($last_name); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($user_email); ?></p>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="location.href='shopping_cart.php'">My Cart</button>
                    <button class="btn btn-warning" onclick="location.href='logout.php'">Log out</button>
                    <button class="btn btn-danger" onclick="deleteAccount()">Delete Account</button>
                </div>
                
                <div id="delete-form" style="display: none;" class="mt-3">
                    <form action="deleteAccount.php" method="POST">
                        <input type="password" class="form-control mb-2" name="password" placeholder="Enter your password" required>
                        <button type="submit" name="delete" class="btn btn-danger w-100">Confirm Delete</button>
                    </form>
                </div>

                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success mt-3"> <?php echo htmlspecialchars($_GET['success']); ?> </div>
                <?php } ?>
                
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger mt-3"> <?php echo htmlspecialchars($_GET['error']); ?> </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-center">
        <?php include "footer.php" ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
