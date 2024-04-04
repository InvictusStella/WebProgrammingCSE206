<?php
    session_start();
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
    <script>
        $(document).ready(function () {
            $("#courseForm").on('submit', function (e) {
                e.preventDefault();

                var courseID = $("#courseID").val();
                var courseName = $("#courseName").val();
                var numStudents = $("#numStudents").val();
                var courseGiver = $("#courseGiver").val();
                var numExams = $("#numExams").val();

                $.ajax({
                    url: 'courseCreate.php', // replace with your PHP file
                    type: 'POST',
                    data: {
                        courseID: courseID,
                        courseName: courseName,
                        numStudents: numStudents,
                        numExams : numExams,
                        courseGiver: courseGiver
                    },
                    success: function (data) {
                        alert('Course successfully created');
                        // you can also refresh the page or redirect to another page here
                    },
                    error: function () {
                        alert('An error occurred');
                    }
                });
            });
        });
    </script>

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
                                <li class="nav-item active"><a class="nav-link" href="instructorIndex.php">Home</a></li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
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
                <!-- Page content-->
                <div class="container-fluid">
                    <form class="mt-5" id="courseForm">
                        <div class="mb-3">
                            <label for="courseID" class="form-label">Course ID</label>
                            <input type="text" class="form-control" id="courseID" placeholder="Enter course ID">
                        </div>
                        <div class="mb-3">
                            <label for="courseName" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="courseName" placeholder="Enter course name">
                        </div>
                        <div class="mb-3">
                            <label for="numStudents" class="form-label">Number of Students</label>
                            <input type="number" class="form-control" id="numStudents" placeholder="Enter number of students">
                        </div>
                        <div class="mb-3">
                            <label for="numExams" class="form-label">Number of Exams</label>
                            <input type="number" class="form-control" id="numExams" placeholder="Enter number of exams">
                        </div>
                        <div class="mb-3">
                            <label for="courseGiver" class="form-label">Course Giver</label>
                            <input type="text" class="form-control" id="courseGiver" placeholder="Enter course giver">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Course</button>
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
