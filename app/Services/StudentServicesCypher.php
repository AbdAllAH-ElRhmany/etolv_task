<?php

namespace App\Services;

use App\Repositories\StudentRepositoryCypher;

class StudentServicesCypher
{
    private $studentRepository;

    public function __construct(StudentRepositoryCypher $studentRepository)
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
        $this->studentRepository->delete($id);
    }
    public function enrollStudent($studentId, $courseId)
    {
        $student = $this->studentRepository->getById($studentId);
        $course = $this->studentRepository->getCourseById($courseId);

        if (!$student || !$course) {
            throw new \Exception('Student or course not found', 404);
        }

        $this->studentRepository->enroll($studentId, $courseId);

        return true;
    }

    public function getEnrolledCourses($studentId)
    {
        return $this->studentRepository->getEnrolledCourses($studentId);
    }
}