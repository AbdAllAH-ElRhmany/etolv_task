<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentServices;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentServices $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        try {
            $students = $this->studentService->getAllStudents();

            return response()->json([
                'count' => $students->count(),
                'data' => $students,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|integer',
            ]);

            $student = $this->studentService->createStudent($request->all());

            return response()->json(['data' => $student], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            $student = $this->studentService->getStudent($id);

            return response()->json([
                'data' => [
                    'student' => $student
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
    public function showWithCourses($id)
    {
        try {
            $student = $this->studentService->getStudentWithCourses($id);

            return response()->json([
                'data' => [
                    'student' => $student
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    public function update(UpdateStudentRequest $request, $id)
    {
        {
            try {
                $student = $this->studentService->updateStudent($id, $request->all());

                return response()->json(['message' => 'Student updated successfully', 'student' => $student]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function destroy($id)
    {
        try {
            $this->studentService->deleteStudent($id);

            return response()->json(['message' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function enroll($studentId, $courseId){
        try {
            $this->studentService->enrollStudent($studentId, $courseId);

            return response()->json(['message' => 'Student enrolled in the course successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

}