<?php
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
        header('Location: courses.php');
        exit;
    }

    if (isset($_GET['addSuccess'])) {
        echo "<script type='text/javascript'>alert('New exam created successfully');</script>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light" style="text-align: center">
                <a id="homePage" href=index.html>
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
                       href=courses.php
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Courses</a>
                    <a id="Events"
                       href="#"
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Events</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 ps-5"
                       id="courseCreateButton"
                       href=coursesCreate.html>
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
                            <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#!">Log Out</a>

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
            <!-- Course Details Card -->
            <div class="container-fluid mt-5">
                <div class="card">
                    <div class="card-header">
                        Course Details
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                            $sql = "SELECT courseName, courseCode, i.name as iname FROM courses AS c JOIN instructors AS i ON i.pk = instructorFk WHERE c.pk = $cpk";
                            $result = $conn-> query($sql);
                            
                            while ($row = $result->fetch_assoc()) {
                                echo "<li class='list-group-item'>Course Name: " . $row['courseName'] . "</li>";
                                echo "<li class='list-group-item'>Course Code: " . $row['courseCode'] . "</li>";
                                echo "<li class='list-group-item'>Course Instructor: " . $row['iname'] . "</li>";
                            }
                            
                        ?>
                    </ul>
                </div>
            </div>
            <!-- Page content-->
            <div class="container-fluid mt-5">
                <table class="table table-striped table-hover">
                    <thead class="table-light mt-5 ms-auto">
                        <tr>
                            <th scope="col">Exam ID</th>
                            <th scope="col">Exam Type</th>
                            <th scope="col">Exam Date</th>
                            <th scope="col">Average Score</th>
                        </tr>
                    </thead>
                    <tbody id="examTable">
                        <?php
                            $sql = "SELECT pk, type, date, grade FROM exam WHERE courseFk = $cpk";
                            $result = $conn-> query($sql);
                            
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                
                                <tr>
                                    <td><?php echo $row['pk']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['grade']; ?></td>
                                    <td>
                                        <a href="#!">
                                            <button class="btn btn-primary" style="background-color: green; text-align: center;"> Update </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#!">
                                            <button class="btn btn-primary" style="background-color: red; text-align: center;"> Delete </button>
                                        </a>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                
                <div class = "examCreateButton" style="text-align: left;">
                    <a href="examCreate.php?cpk=<?php echo $cpk; ?>">
                        <button class="btn btn-primary" style="background-color: primary; text-align: center;">
                            Add Exam
                        </button>
                    </a>
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
