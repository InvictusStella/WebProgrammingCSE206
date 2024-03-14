<?php
    $courseID = $_POST['courseID'];
    $courseName = $_POST['courseName'];
    $numStudents = $_POST['numStudents'];
    $courseGiver = $_POST['courseGiver'];
    $numExams = $_POST['numExams'];

    $courseInfo = array('courseID' => $courseID, 'courseName' => $courseName, 'numStudents' => $numStudents, 'courseGiver' => $courseGiver, 'numExams' => $numExams);
    
    echo json_encode($courseInfo);
?>