<?php
    session_start();
    $servername = "localhost";
    $username = "admin";
    $password = ".YfP3orpdLop.xUw";
    $db_name = "exam_system";
    $conn = new mysqli($servername, $username, $password, $db_name);

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
                           href=courses.php
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
                    <h1 class="mt-4">ONLINE EXAMINATION SYSTEM</h1>
                    <p>Online Exam Systems for Educative Organizations</p>
                    <div id="homeContent" class="row">
                        <!-- Card 1 -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-preview">
                                    <div class="fuse-card">
                                        <div class="p-16">
                                            <div class="h1">Question Preparation Module</div>
                                            <div class="h4 secondary-text">
                                                Prepare simple, related, integrated questions
                                            </div>
                                        </div>
                                        
                                        <div class="p-16 pt-0 line-height-1.75"
                                             style="padding: 5px">
                                            Contains guiding elements that will contribute to the
                                            question preparation process for users with question
                                            preparation authority (faculty members, instructors,
                                            lecturers, etc.). This module allows for 3 different
                                            types of questions
                                            <b>(simple, related, and integrated)</b> and can host an
                                            unlimited number of questions. The questions stored by
                                            the module are encrypted and stored in the database with
                                            an ID. When needed, a stored question can be easily
                                            accessed using a keyword.
                                            <p><b>Main features of the questions:</b></p>
                                            <ul>
                                                <li>
                                                    Cognitive level, difficulty level, acceptability
                                                    index, cumulative difficulty index, validity dates,
                                                    relation to learning objectives, peer review
                                                </li>
                                            </ul>
                                            Questions go through peer review by an authorized and
                                            appointed person/board. Questions that pass the
                                            technical inspection and are approved can appear in
                                            exams. If problems are detected during the inspection,
                                            an email will be sent to the user who prepared the
                                            question, explaining the problem and suggesting
                                            solutions.
                                            <p>
                                                In addition to these features, ASOS is fully
                                                compatible with the <b>Core Education Program</b> and
                                                the
                                                <b>
                                                    Turkish Higher Education Qualifications
                                                    Framework
                                                </b>. Questions can be matched with learning objectives,
                                                core diseases, etc.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-preview">
                                    <div class="fuse-card">
                                        <div class="p-16" style="padding: 5px">
                                            <div class="h1">Exam Question Planning Module</div>
                                            <div class="h4 secondary-text">
                                                Create exams based on various parameters
                                            </div>
                                        </div>
                                        
                                        <div class="p-16 pt-0 line-height-1.75"
                                             style="padding: 5px">
                                            In the exam automation system, the authority to create
                                            exams is given only to exam creation officers (semester
                                            coordinators, exam coordinators, course board
                                            chairpersons, exam staff, etc.) designated by the
                                            administration. These officers begin preliminary
                                            preparations related to the exams to be conducted by
                                            creating plans for
                                            <ul>
                                                <li>Course,</li>
                                                <li>Course board</li>
                                            </ul>
                                            exams in accordance with the upcoming exam schedule.
                                            <p>
                                                Notification emails are sent to faculty members and
                                                question control officers through the system for any
                                                deficiencies.
                                            </p>
                                            During the exam preparation phase, questions are
                                            automatically selected by the system through various
                                            algorithms. Questions are filtered according to various
                                            parameters (class hours, learning objectives, credits,
                                            difficulty level, acceptability index, favorite
                                            questions, or keywords). The selected questions are
                                            added to the list as a result of filtering. The
                                            selection of questions continues until the total number
                                            of exam questions is reached. After the system makes the
                                            question selection, an informational email is sent to
                                            the relevant faculty members about the questions that
                                            will appear in the exam.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-preview">
                                    <div class="fuse-card">
                                        <div class="p-16" style="padding: 5px">
                                            <div class="h1">Exam Module</div>
                                            <div class="h4 secondary-text">
                                                Conduct traditional, electronic, or
                                                <b>fully secure remote</b> exams
                                            </div>
                                        </div>
                                      
                                        <div class="p-16 pt-0 line-height-1.75"
                                             style="padding: 5px">
                                            The first process in the exam module is the preparation
                                            of exam booklets. After reaching the planned number of
                                            questions for the exam, the selected questions are
                                            reviewed by the exam staff. Once the questions to be
                                            included in the exam are approved, the preparation
                                            process for the booklet (printed or electronic) begins.
                                            An unlimited number of booklets of the desired variety
                                            can be created. Exams can be conducted with these
                                            booklets in multiple sessions and different branches.
                                            Answer keys for each question booklet are prepared by
                                            the system. Based on these prepared booklets, 5
                                            different types of exams can be conducted:
                                            <ul>
                                                <li>Midterm/Quizzes,</li>
                                                <li>Final,</li>
                                                <li>Make-up,</li>
                                                <li>Readiness,</li>
                                                <li>Development</li>
                                            </ul>
                                            The positions of the questions and options in each
                                            booklet can be automatically randomized by the system.
                                            It offers options to conduct traditional (printed exam
                                            booklets), electronic (in computer labs or exam
                                            centers), or <b>fully secure</b> remote (electronic)
                                            exams.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
