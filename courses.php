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
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'courseCreate.php',
                method: 'POST',
                dataType: 'json',
                success: function (data) {
                    var courseInfo = data;
                    var row = $('<tr>');
                    row.append('<th scope="row">' + ($('#courseTable tr').length) + '</th>');
                    row.append('<td>' + courseInfo.courseID + '</td>');
                    row.append('<td>' + courseInfo.courseName + '</td>');
                    row.append('<td>' + courseInfo.numStudents + '</td>');
                    row.append('<td>' + courseInfo.numExams + '</td>'); 
                    row.append('<td>' + courseInfo.courseGiver + '</td>');
                    $('#courseTable').append(row);
                }
            });
        });
    </script>


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
                    <a id="Exams"
                       href=examList.html
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Exams</a>
                    <a id="Courses"
                       href=courses.html
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Courses</a>
                    <a id="Events"
                       href="#"
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Events</a>
                    <a id="examCreation"
                       href=examCreate.html
                       class="list-group-item list-group-item-action list-group-item-light p-3 ps-5">Create Exam</a>
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
            <!-- Page content-->
            <div class="container-fluid mt-5">
                <table class="table table-striped table-hover bordered-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course ID</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Course Giver</th>
                        </tr>
                    </thead>
                    <tbody id="courseTable">
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
                            echo "Connected successfully";

                            $sql = "SELECT c.pk, c.courseName as cName, c.courseCode, i.name as iname FROM courses AS c JOIN instructors AS i ON i.pk = instructorFk";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    ?>
                                    <td><?php echo $row['c.pk']; ?></td>
                                    <td><?php echo $row['cName']; ?></td>
                                    <td><?php echo $row['c.courseCode']; ?></td>
                                    <td><?php echo $row['iname']; ?></td>
                                    <?php
                                }
                            } else {
                            echo "0 results";
                            }

                            $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
