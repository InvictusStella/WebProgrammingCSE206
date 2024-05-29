<div class="container">
    <?php
        if (isset($validation)) {
            echo "<div class='alert alert-danger'>";
            echo $validation->listErrors();
            echo "</div>";
        }
    ?>
    <form method="post" >
        <div class="form-group">
            <label for="courseName">Course Name</label>
            <input name="courseName" type="text" class="form-control" id="courseName">
        </div>
        <div class="form-group">
            <label for="courseCode">Course Code</label>
            <input name="courseCode" type="text" class="form-control" id="courseCode">
        </div>        
        <div class="form-group">
            <label for="instructorFk">Instructor</label>
            <select name="instructorFk" class="form-control" id="instructorFk">
                <option value="">Select Instructor</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>