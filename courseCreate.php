<?php
    /*$courseID = $_POST['courseID'];
    $courseName = $_POST['courseName'];
    $numStudents = $_POST['numStudents'];
    $courseGiver = $_POST['courseGiver'];
    $numExams = $_POST['numExams'];

    $courseInfo = array('courseID' => $courseID, 'courseName' => $courseName, 'numStudents' => $numStudents, 'courseGiver' => $courseGiver, 'numExams' => $numExams);
    
    echo json_encode($courseInfo);*/

    $cojson = '[{"ID":"1", "code":"CSE101","Name":"Java Programing", "credit":"4","numOfStudents":"98", "numOfExams":"3"}, 
                {"ID":"2", "code":"CSE124","Name":"Natural Sciences", "credit":"5","numOfStudents":"113", "numOfExams":"4"}, 
                {"ID":"3", "code":"CSE236","Name":"Web Programming", "credit":"6","numOfStudents":"13", "numOfExams":"2"}]';
    $co = json_decode($cojson);

    echo '<table>';
    foreach($co as $result){
        echo '<tr>';
            echo '<td>'.$result->ID.'</td>';
            echo '<td>'.$result->code.'</td>';
            echo '<td>'.$result->Name.'</td>';
            echo '<td>'.$result->credit.'</td>';
            echo '<td>'.$result->numOfStudents.'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>