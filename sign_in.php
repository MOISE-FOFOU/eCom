<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/signinstyle.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .signin-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 900px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Left Side (Form) */
        .col1 {
            flex: 1;
            padding: 40px;
            min-width: 300px;
        }

        .signin-items {
            text-align: center;
        }

        .signin-items h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .para1 {
            color: #555;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .signin_google {
            display: block;
            padding: 10px;
            background-color: #db4437;
            color: white;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .signin_google:hover {
            background-color: #c1351d;
        }

        form {
            text-align: left;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .remember {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .forgotpwd a {
            color: #007bff;
            text-decoration: none;
        }

        #login {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        #login:hover {
            background-color: #218838;
        }

        .signup_btn {
            display: block;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .signup_btn:hover {
            background-color: #0056b3;
        }

        /* Right Side (Images) */
        .image-container {
            flex: 1;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            min-width: 300px;
        }

        .image-container img {
            width: 80%;
            max-width: 200px;
            margin: 10px;
        }

        .para3 {
            font-size: 16px;
            color: #555;
            text-align: center;
            margin-top: 10px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .signin-container {
                flex-direction: column;
            }

            .image-container img {
                width: 50%;
            }
        }
    </style>
</head>
<body>

    <div class="signin-container">
        <!-- Left Side -->
        <div class="col1">
            <div class="signin-items">
                <h2>Log In</h2>
                <p class="para1">See your growth and get consulting support!</p>
                <a href="#" class="signin_google">Sign In With Google</a>
                <p class="para1">OR Sign in with Your Email</p>

                <form action="signin_check.php" method="POST">
                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <label for="email">Email*</label>
                    <input type="text" name="email" class="form-control" required>

                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" class="form-control" required>

                    <div class="remember">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                        <span class="forgotpwd"><a href="#">Forgot your Password?</a></span>
                    </div>

                    <input type="submit" name="submit" value="Log In" id="login">
                </form>

                <p style="text-align: center;">OR</p>

                <a href="signup.php" class="signup_btn">Sign Up For Free</a>
            </div>
        </div>

        <!-- Right Side -->
        <div class="image-container">
            <img src="Images/download (1).png" alt="Image 1">
            <img src="Images/download.png" alt="Image 2">
            <img src="Images/download2.png" alt="Image 3">
            <p class="para3">Get Your products and make your fashion</p>
        </div>
    </div>

</body>
</html>
