<?php
    $servername = "localhost";
    $username = "admin";
    $password = ".YfP3orpdLop.xUw";
    $db_name = "exam_system";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }

    if(isset($_POST['submit'])) {
        session_start();
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = md5($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo("Invalid email format");
            exit;
          }

        // Prepare SQL statement to prevent SQL injection
        $sql = "(SELECT name, email, password FROM students WHERE email = '$email' AND password = '$password') 
            UNION 
            (SELECT name, email, password FROM instructors WHERE email = '$email' AND password = '$password')";
        $result = $conn ->query($sql);

        if($result -> num_rows > 0) {
            $row = $result -> fetch_assoc();

            // Verify password
            if($password === $row['password']) {
                $_SESSION['email'] = filter_var($row['email'], FILTER_SANITIZE_EMAIL);
                $_SESSION['password'] = $row['password'];
                $_SESSION['name'] = $row['name'];

                // Check if user is an instructor
                $stmt_instructor = $conn->prepare("SELECT name, email, password FROM instructors WHERE email = ? AND password = ?");
                $stmt_instructor->bind_param("si", $email, $password);
                $stmt_instructor->execute();
                $result_instructor = $stmt_instructor->get_result();

                if($result_instructor -> num_rows > 0) {
                    header('Location: instructorIndex.php');
                } else {
                    echo "Student page will be implemented soon.";
                }
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Invalid email";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>OES Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container border border-secondary" style="margin-top: 200px;">
        <h2 style="text-align: center;"><img src="assets/OES.ico" alt="Icon" style="height: 150 px; width: 150px; display: block; margin: auto; margin-bottom: 10px;">Welcome to OES</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email: *</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password: *</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="form-group mt-3 text-center">
                <a href="#!" style="display: block;">Sign In</a>
            </div>
        </form>
    </div>
</body>
</html>