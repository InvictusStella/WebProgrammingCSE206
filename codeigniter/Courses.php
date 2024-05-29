<div class="container">
    <div
        class="table-responsive"
    >
        <table
            class="table table-light"
        >
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Course Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                    foreach($courses as $course){
                        echo "<tr>";
                        echo "<td>".$course['courseCode']."</td>";
                        echo "<td>".$course['courseName']."</td>";
                        echo "<td><a href='students/".$course['pk']."' class='btn btn-info'>Details</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    
</div>