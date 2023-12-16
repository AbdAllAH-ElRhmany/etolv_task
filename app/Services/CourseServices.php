<?php
namespace App\Services;

use App\Repositories\CourseRepository;

class CourseServices
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
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
    public function getCourseWithStudents($id)
    {
        return $this->courseRepository->getByIdWithStudents($id, ['students']);
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
        return $this->courseRepository->delete($id);
    }


}