<?php
namespace App\Repositories;

use App\Models\Course;
use App\Models\Student;

class StudentRepository
{


    public function getAll()
    {
        return Student::all();
    }

    public function getById($id)
    {
        return Student::findOrFail($id);
    }
    public function getByIdWithCourses($id, array $with=[])
    {
        return Student::with($with)->findOrFail($id);
    }
    public function getCourseById($id)
    {
        return Course::findOrFail($id);
    }
    public function create(array $data)
    {
        return Student::create($data);
    }
    public function update($id, array $data)
    {
        $student = $this->getById($id);
        $student->update($data);

        return $student;
    }
    public function delete($id)
    {
        $student = $this->getById($id);
        $student->delete();

        return true;
    }


}