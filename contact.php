<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="contact.css?v=1.0">
</head>
<body>
<header>
        <div class="logo">
            <img src="images/logo1.jpg" alt="Logo">
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php"><i class=""></i> Home</a></li>
                <li><a href="about.php"><i class=""></i> About</a></li>
                <li><a href="avilable_blood.php"><i class=""></i> Donor</a></li>
                <li><a href="contact.php"><i class=""></i> Contact</a></li>
                <!-- User icon or login/logout link based on session status -->
                <li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <!-- Display user's initial in a styled div -->
                        <a href="logout.php" class="fas fa-user-alt"></a>
                    <?php else: ?>
                        <a href="login.php" class="">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>
    <div class="video-container">
        <div class="video-wrapper">
            <video autoplay muted loop id="bg-video">
                <source src="images/blood-vedio.mp4" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
        </div>
    <div class="contact-container">
        <div class="contact-info">
            <div class="info-item">
                <img src="images/home.jpg" alt="Address Icon">
                <div>
                    <strong>Address</strong>
                    <p>4671 Sugar Camp Road,<br>Owatonna, Minnesota, 55060</p>
                </div>
            </div>
            <div class="info-item">
                <img src="images/phone.jpg" alt="Phone Icon">
                <div>
                    <strong>Phone</strong>
                    <p>9345678210</p>
                </div>
            </div>
            <div class="info-item">
                <img src="images/email.jpg" alt="Email Icon">
                <div>
                    <strong>Email</strong>
                    <p>Blood@email.com</p>
                </div>
            </div>
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <p>Please enter all the information correctly to contact us..</p>
            <form>
                <input type="text" placeholder="Full Name" required>
                <input type="email" placeholder="Email" required>
                <textarea placeholder="Type your Message..." required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
   
</div> <div class="footer">
    &copy; 2024 Blood Donation Website | All rights reserved.
</div>

</body>
</html>
