<?php

namespace App\Services;

use App\Repositories\CourseRepositoryCypher;

class CourseServicesCypher
{
    private $courseRepository;

    public function __construct(CourseRepositoryCypher $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses()
    {
        return $this->courseRepository->getAll();
    }

    public function getCourse($id)
    {
        return $this->courseRepository->getById($id);
    }

    public function createCourse(array $data)
    {
        return $this->courseRepository->create($data);
    }

    public function updateCourse($id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    public function deleteCourse($id)
    {
        $this->courseRepository->delete($id);
    }

    public function getEnrolledStudents($courseId)
    {
        return $this->courseRepository->getEnrolledStudents($courseId);
    }
}