<div class="container margin-auto">
    <div
        class="table-responsive"
    >
        <table
            class="table table-light"
        >
            <thead>
                <tr>
                    <th scope="col">Class Code</th>
                    <th scope="col">Class Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($exam_students as $exam_student) {
                        echo "<tr>";
                        echo "<td>".$exam_student['courseCode']."</td>";
                        echo "<td>".$exam_student['courseName']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    
</div>



<div
    class="table-responsive"
>
    <table
        class="table table-light"
    >
        <thead>
            <tr>
                <th scope="col">Exam Name</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($exam_students as $exam_student){
                    echo "<tr>";
                    echo "<td>".$exam_student['type']."</td>";
                    echo "<td>".$exam_student['grade']."</td>";
                    echo "<td>".$exam_student['date']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<div
    class="table-responsive"
>
    <table
        class="table table-light"
    >
        <thead>
            <tr>
                <th scope="col">Student Name</th>
                <th scope="col">Student Email</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($exam_students as $exam_student){
                    echo "<tr>";
                    echo "<td>".$exam_student['sname']."</td>";
                    echo "<td>".$exam_student['semail']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

