<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $query = $db->query('SELECT pk,courseName, courseCode FROM courses');

        $data['courses'] = $query->getResult('array');


        echo view('header');
        echo view('courses',$data);
        echo view('footer');
    }

    public function students($pk) {
        $db = db_connect();
        $query = $db->query('SELECT c.pk, courseCode, courseName, type, grade, date, s.name as sname, s.email as semail FROM courses AS c 
        JOIN exam AS e ON e.courseFk = c.pk 
        JOIN course_student AS cs ON cs.courseFk = c.pk 
        JOIN students AS s ON cs.studentFk = s.pk 
        WHERE c.pk = ?', [$pk]);

        $data['exam_students'] = $query->getResult('array');

        echo view('header');
        echo view('students',$data);
        echo view('footer');
    }

    public function create() {
        helper(['form']);

        $data['instructors'] = [
            ['id' => 1, 'name' => 'Diren Çakılcı'],
            ['id' => 2, 'name' => 'Joseph William Ledet'],
            ['id' => 3, 'name' => 'Taner Danışman']
        ];

        if($_POST) {
            $rules = [
                'courseName' => 'required',
                'courseCode' => 'required',
                'instructorFk' => 'required'
            ];

            if($this->validate($rules)) {
                $data = [
                    'courseName' => $this->request->getPost('courseName'),
                    'courseCode' => $this->request->getPost('courseCode'),
                    'instructorFk' => $this->request->getPost('instructorFk')
                ];
                
                $db = db_connect();
                $query = $db->query('INSERT INTO courses (courseName, courseCode,instructorFk) VALUES(:courseName:, :courseCode:,:instructorFk:)', $data);

                if($query) {
                    echo 'Course created successfully';
                } else {
                    echo 'Course creation failed';
                }
            } else {
                $data['validation'] = $this->validator;
            }
            
        }

        echo view('header');
        echo view('CourseCreate',$data);
        echo view('footer');
    }
}
