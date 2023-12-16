<?php
namespace App\Services;

use App\Repositories\StudentRepository;

class StudentServices
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getAllStudents()
    {
        return $this->studentRepository->getAll();
    }
    public function getStudent($id)
    {
        return $this->studentRepository->getById($id);
    }
    public function getStudentWithCourses($id)
    {
        return $this->studentRepository->getByIdWithCourses($id, ['courses']);
    }
    public function createStudent(array $data)
    {
        return $this->studentRepository->create($data);
    }
    public function updateStudent($id, array $data)
    {
        return $this->studentRepository->update($id, $data);
    }

    public function deleteStudent($id)
    {
        return $this->studentRepository->delete($id);
    }

    public function enrollStudent($studentId, $courseId)
    {
        $student = $this->studentRepository->getById($studentId);
        $course = $this->studentRepository->getCourseById($courseId);

        if (!$student || !$course) {
            throw new \Exception('Student or course not found', 404);
        }

        $student->courses()->attach($course);
        $course->students()->attach($student);

        return true;
    }

}