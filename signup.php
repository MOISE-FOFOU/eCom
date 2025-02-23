<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .signup-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<main>
    <div class="container">
        <div class="signup-container">
            <h1 class="text-center">Sign Up</h1>
            <h2 class="text-center">Welcome to Beauty Garden</h2>
            <p class="text-center">See your growth and get consulting support!</p>
            <hr>
            <form name="signup" action="signupcheck.php" method="POST">
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success"> <?php echo $_GET['success']; ?> </div>
                <?php } ?>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger"> <?php echo $_GET['error']; ?> </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Fname">First Name*</label>
                            <input type="text" name="Fname" id="fname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Lname">Last Name*</label>
                            <input type="text" name="Lname" id="lname" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Email">Email*</label>
                    <input type="email" name="Email" id="email" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="Password">Password*</label>
                    <input type="password" name="Password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confpwd">Confirm Password*</label>
                    <input type="password" name="confpwd" id="confpwd" class="form-control" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
                    <a href="index.php" class="btn btn-secondary">Back To Home</a>
                </div>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="sign_in.php">Sign In</a></p>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
