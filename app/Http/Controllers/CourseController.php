<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\UpdateCourseRequest;
use App\Services\CourseServices;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseServices;

    public function __construct(CourseServices $courseServices)
    {
        $this->courseServices = $courseServices;
    }

    public function index()
    {
        try {
            $courses = $this->courseServices->getAllCourses();

            return response()->json([
                'count' => $courses->count(),
                'data' => $courses,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'desc' => 'required',
            ]);

            $course = $this->courseServices->createCourse($request->all());

            return response()->json(['data' => $course], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            $course = $this->courseServices->getCourse($id);
            $studentNamse = $course->students()->pluck('name');

            return response()->json([
                'data' => [
                    'course' => $course,
                    'student_names' => $studentNamse,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
    public function showWithStudents($id)
    {
        try {
            $course = $this->courseServices->getCourseWithStudents($id);

            return response()->json([
                'data' => [
                    'course' => $course,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    public function update(UpdateCourseRequest $request, $id)
    {
        {
            try {
                $course = $this->courseServices->updateCourse($id, $request->all());

                return response()->json(['message' => 'course updated successfully', 'course' => $course]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function destroy($id)
    {
        try {
            $this->courseServices->deleteCourse($id);

            return response()->json(['message' => 'Course deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}