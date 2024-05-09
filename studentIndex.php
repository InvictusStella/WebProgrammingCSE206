<?php
    session_start();
    $servername = "localhost";
    $username = "admin";
    $password = ".YfP3orpdLop.xUw";
    $db_name = "exam_system";
    $conn = new mysqli($servername, $username, $password, $db_name);

    $pk = $_SESSION['pk'];

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
    <title>Online Examination System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light" style="text-align: center">
                    <a id="homePage" href=studentIndex.php>
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
                           href=studentCourses.php
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Courses</a>
                        <a id="Events"
                           href="#"
                           class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Events</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3 ps-5"
                           id="studentExamsButton"
                           href=studentExams.php>
                            Exams
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
                                <li class="nav-item active"><a class="nav-link" href="studentIndex.php">Home</a></li>

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
                    <div class="p-16" style="padding: 5px">
                            <div class="h1">Upcoming Exams</div>
                            <div class="h4 secondary-text">
                                Here are your upcoming exams
                            </div>
                    </div>
                    <div>
                        <table class="container-fluid">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $sql = "SELECT date, type, c.courseName as cname FROM exam AS e 
                                    JOIN courses AS c ON e.courseFk = c.pk
                                    JOIN course_student AS cs ON c.pk = cs.courseFk
                                    WHERE cs.studentFk = $pk  
                                    ORDER BY e.date
                                    LIMIT 3";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['cname'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>