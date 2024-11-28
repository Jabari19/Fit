<?php
include 'config.php';
session_start();

// Check if already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect logged-in users to their respective page
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the query to check if the email exists in the database
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // If user exists, verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user info in session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role'];  // Store the user's role

        // Redirect based on role
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        } else {
            header("Location: index.php"); // Redirect to user homepage
        }
        exit;
    } else {
        // Error message for incorrect credentials
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Fitness Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            justify-content: flex-start;
        }

        /* Login Container Styles */
        .login-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            margin-bottom: 15px;
        }

        input:focus {
            border-color: #4CAF50;
        }

        button {
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #388E3C;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .register-link {
            text-align: center;
            font-size: 14px;
        }

        .register-link a {
            color: #4CAF50;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Main Content Styles */
        .main-content {
            width: 100%;
            max-width: 900px;
            padding: 20px;
            margin-top: 80px;
            position: absolute;
            left: 5%;
            /* Move to the left */
        }

        /* Testimonials Section (Marquee) */
        .testimonials {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .testimonials-wrapper {
            display: flex;
            animation: marquee 40s linear infinite;
            /* Slower speed */
        }

        .testimonial {
            white-space: nowrap;
            font-size: 16px;
            color: #555;
            padding-right: 50px;
            /* Space between testimonials */
        }

        .testimonial span {
            font-weight: bold;
            color: #4CAF50;
        }

        /* Marquee Animation */
        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .feature-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .feature {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .feature p {
            font-size: 16px;
            color: #555;
        }

        .feature span {
            font-weight: bold;
            color: #4CAF50;
        }

        /* Feature Title Style */
        .feature-section h4 {
            text-align: center;
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                max-width: 90%;
                padding: 25px;
            }

            h1 {
                font-size: 22px;
                margin-bottom: 20px;
            }

            .register-link {
                font-size: 12px;
            }

            .main-content {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Login Section -->
    <div class="login-container">
        <h1>Login to Fitness Tracker</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>

        <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
    </div>

    <!-- Main Content (Features Section) -->
    <div class="main-content">
        <!-- Features Section -->
        <div class="feature-section">
            <header>
                <h1 tyle="font-size: 3em;">FITNESS TRACKER</h1>
            </header>
            <h4>App Features</h4>
            <div class="feature">
                <p>"Log your workouts and see your progress in real-time with comprehensive tracking and analytics."</p>
                <span>Workout Tracker</span>
            </div>
            <div class="feature">
                <p>"Set personalized fitness goals and get insights on how to achieve them."</p>
                <span>Goal Setting</span>
            </div>
            <div class="feature">
                <p>"Monitor your nutrition intake with detailed meal logging and calorie tracking."</p>
                <span>Nutrition Log</span>
            </div>
            <div class="feature">
                <p>"Track your sleep patterns and understand how it affects your fitness journey."</p>
                <span>Sleep Tracking</span>
            </div>
            <div class="feature">
                <p>"Stay motivated with daily reminders and workout suggestions based on your progress."</p>
                <span>Motivational Reminders</span>
            </div>
            <div class="feature">
                <p>"Get a detailed report of your progress and improvements over time."</p>
                <span>Progress Reports</span>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials">
        <div class="testimonials-wrapper">
            <div class="testimonial">
                <p>"This app has completely transformed my fitness journey. I feel motivated to push harder every day!"
                </p>
                <span>- Emma, Fitness Enthusiast</span>
            </div>
            <div class="testimonial">
                <p>"A great tool for tracking progress. The goal setting feature really helped me stay on track."</p>
                <span>- John, Athlete</span>
            </div>
            <div class="testimonial">
                <p>"I love how easy it is to log my workouts and meals. The app is simple and effective."</p>
                <span>- Sarah, Busy Professional</span>
            </div>
        </div>
    </div>

</body>

</html>