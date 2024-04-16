<?php
    session_start();
    $servername = "localhost";
    $username = "admin";
    $password = ".YfP3orpdLop.xUw";
    $db_name = "exam_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (isset($_GET['cpk'])) {
        $cpk = $_GET['cpk'];
    } else {
        header('Location: courseDetails.php');
        exit;
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $examType = $_POST['examType'];
        $examDate = $_POST['examDate'];
        $grade = filter_var($_POST['grade'], FILTER_SANITIZE_NUMBER_INT);
        
        if(empty($examDate)) {
            echo "<script type='text/javascript'>alert('Error: Exam date is required');</script>";
        } else if(empty($grade)) {
            echo "<script type='text/javascript'>alert('Error: Grade is required');</script>";
        } else {

            $resGrade = $conn->query("SELECT SUM(grade) as sum FROM exam WHERE courseFk = $cpk");
            $row = $resGrade->fetch_assoc();

            if($row['sum'] == null) {
                $sumGrade = $grade;
            } else {
                $sumGrade = $row['sum'] + $grade;
            }

            if($sumGrade < 0 || $sumGrade > 100) {
                echo "Error: Total grade must be between 0 and 100";
                exit;
            }

            if($examType == 'Final') {
                $stmt_check = "SELECT * FROM exam WHERE courseFk = '$cpk' AND type = '$examType'";
                $result_check = $conn->query($stmt_check);
        
                if($result_check->num_rows > 0) {
                    echo "Error: A final exam already exists for this course";
                    exit;
                }
            }

            $stmt = $conn->prepare("INSERT INTO exam (courseFk, date, type, grade) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $cpk, $examDate, $examType, $grade);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Exam created successfully');</script>";
                header('Location: courseDetails.php?cpk=' . $cpk);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


    if (isset($_POST['logout'])) {
        // Unset all of the session variables
        $_SESSION = array();
    
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        // Finally, destroy the session.
        session_destroy();
    
        // Redirect to login page after logout
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ONLINE EXAMINATION SYSTEM</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
</head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light" style="text-align: center">
                    <a id="homePage" href=instructorIndex.php>
                        <img src="assets/OES.ico" alt="Icon" style="width: 100px; height: 100px; display: block; margin: auto" />
                    </a>
                    OES
                </div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                       id="profileButton"
                       href="#!">
                        Profile
                    </a>
                    <button class="list-group-item list-group-item-action list-group-item-light p-3 d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse"
                            data-bs-target="#dashboardCollapse"
                            aria-expanded="false"
                            aria-controls="dashboardCollapse">
                        Dashboard
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="dashboardCollapse">
                        <a id="Courses"
                           href= courses.php
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Courses</a>
                        <a id="Events"
                           href="#"
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Events</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3 ps-5"
                           id="courseCreateButton"
                           href=coursesCreate.php>
                            Create Course
                        </a>
                    </div>

                    <button class="list-group-item list-group-item-action list-group-item-light p-3 d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse"
                            data-bs-target="#mailsCollapse"
                            aria-expanded="false"
                            aria-controls="mailsCollapse">
                        Mails
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div class="collapse" id="mailsCollapse">
                        <a id="sentEmails"
                           href="#"
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Sent Emails</a>
                        <a id="receivedEmails"
                           href="#"
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Received Emails</a>
                        <a id="sendEmail"
                           href="#"
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Send Email</a>
                    </div>

                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary"
                                id="sidebarToggle"
                                style="background: none; border: none">
                            <img src="assets/sidebar2.png"
                                 alt="Image description"
                                 style="height: 35px; width: 35px; margin: 5px" />
                        </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="instructorIndex.php">Home</a></li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <form method="post" style="display: flex; justify-content: center">
                                            <img src="assets/logout.png" alt="logout" style="width: 20px; height: 25px; margin: auto; display: block;">
                                            <button type="submit" name="logout" class="btn btn-primary" style="background: none; border: none; color: black;">Logout</button>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#!">
                                        English
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                                            <a class="list-group-item list-group-item-action list-group-item-light p-3 ps-5" href="#!">
                                                Türkçe
                                            </a>
                                            <a class="list-group-item list-group-item-action list-group-item-light p-3 ps-5" href="#!">French</a>

                                        </div>

                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                    <form class="mt-5" method="POST">
                        <div class="mb-3">
                            <label for="examType" class="form-label">Exam Type*</label>
                            <select type="text" name = "examType" class="form-control" id="examType">
                                <option value="Midterm">Midterm</option>
                                <option value="Final">Final</option>
                                <option value="Quiz">Quiz</option>
                                <option value="Assignment">Assignment</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="examDate" class="form-label">Exam Date*</label>
                            <input type="date" name = "examDate" class="form-control" id="examDate">
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Percentage Grade*</label>
                            <input type="number" name="grade" class="form-control" id="grade" placeholder="Enter the average grade">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Create Exam</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
