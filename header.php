<?php 
    session_start(); // Initialiser la session si elle n'est pas déjà démarrée
    include "db_conn.php";
    
    // Vérifier si la connexion à la base de données est établie avant d'exécuter la requête
    if ($conn) {
        $sqlread = "SELECT DISTINCT category FROM products";
        $result_details = $conn->query($sqlread);
    } else {
        $result_details = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="CSS/headerstyle.css">
    <link rel="stylesheet" href="CSS/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "300px";
            document.getElementById("mySidepanel").style.height = "100%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="topbar-items">
                <div class="text-item1">
                    <span class="text1">Garden Boutique</span>
                </div>
                <div class="text-item2">
                    <span class="text2">Discounts for orders over LKR 10,000</span>
                </div>
                <div class="FAQs">
                    <span><a href="#">FAQs</a></span>
                </div>
                <div class="account">
                    <?php if (isset($_SESSION['Email'], $_SESSION['Fname'], $_SESSION['Lname'])) {
                        echo '<a href="account.php" class="username">' . htmlspecialchars($_SESSION['Fname'] . " " . $_SESSION['Lname']) . '</a> 
                        <div class="dropdown">
                            <a href="#" class="dropbtn">My Account</a>
                            <div class="dropdown-content">
                                <a href="shopping_cart.php">My Cart</a>
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>';
                    } elseif (isset($_SESSION['admin_email'], $_SESSION['admin_fname'], $_SESSION['admin_lname'])) {
                        echo '<a href="#" class="admin-info">' . htmlspecialchars($_SESSION['admin_fname'] . " " . $_SESSION['admin_lname']) . '</a>
                        <div class="dropdown">
                            <a href="#" class="dropbtn">My Account</a>
                            <div class="dropdown-content">
                                <a href="adminpanel.php?category=profile">Admin Panel</a>
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>';
                    } else {
                        echo '<a href="sign_in.php" class="login-btn">Login</a>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="navi-bar-container">
            <div class="navi-bar-items">
                <div class="categories">
                    <div id="mySidepanel" class="sidepanel">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        <h2>Beauty Garden</h2>
                        <?php if ($result_details && $result_details->num_rows > 0) { 
                            while ($row = $result_details->fetch_assoc()) { ?>
                                <a href="categories.php?category=<?php echo urlencode($row['category']); ?>">
                                    <?php echo htmlspecialchars($row['category']); ?>
                                </a>
                        <?php } 
                        } else { ?>
                            <p>No categories available</p>
                        <?php } ?>
                    </div>
                    <button class="openbtn" onclick="openNav()">☰ Categories</button>
                </div>
                <div class="name">
                    <a href="index.php"><img src="Images/logoNew.jpg" alt="Logo" height="50" width="170"></a>
                </div>
                <div class="search">
                    <form action="search_action.php" method="GET">
                        <input type="text" name="search" placeholder="🔍 Search" required>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="login">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="social">
                    <a href="#"><img src="images/facebook.png" alt="Facebook" height="20" width="20"></a>
                    <a href="#"><img src="images/instagram.png" alt="Instagram" height="20" width="20"></a>
                </div>
            </div>
        </div>
    </header>
</body>
</html>