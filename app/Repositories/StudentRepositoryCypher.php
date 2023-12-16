<?php

namespace App\Repositories;

class StudentRepositoryCypher
{
    public function getAll()
    {
        $query = "MATCH (s:Student) RETURN s";
        return app('db')->connection('neo4j')->select($query);
    }

    public function getById($id)
    {
        $query = "MATCH (s:Student) WHERE ID(s) = $id RETURN s";
        return app('db')->connection('neo4j')->select($query);
    }
    public function getCourseById($id)
    {
        $query = "MATCH (c:Course) WHERE ID(c) = $id RETURN c";
        return app('db')->connection('neo4j')->select($query);
    }

    public function create(array $data)
    {
        $query = "CREATE (s:Student {name: '{$data['name']}', phone: {$data['phone']}, email: {$data['email']}}) RETURN s";
        return app('db')->connection('neo4j')->select($query);
    }

    public function update($id, array $data)
    {
        $query = "MATCH (s:Student) WHERE ID(s) = $id SET s.name = '{$data['name']}', s.phone = {$data['phone']}, s.email = {$data['email']} RETURN s";
        return app('db')->connection('neo4j')->select($query);
    }

    public function delete($id)
    {
        $query = "MATCH (s:Student) WHERE ID(s) = $id DELETE s";
        app('db')->connection('neo4j')->statement($query);
    }
    public function enroll($studentId, $courseId)
    {
        $query = "
        MATCH (s:Student), (c:Course)
        WHERE ID(s) = $studentId AND ID(c) =$courseId
        CREATE (s)-[:ENROLLED_IN]->(c)
        CREATE (s)<-[:ENROLLED_IN]-(c)
        ";

        app('db')->connection('neo4j')->statement($query);
    }

    public function getEnrolledCourses($studentId)
    {
        $query = "
            MATCH (s:Student)-[:ENROLLED_IN]->(c:Course)
            WHERE ID(s) = $studentId
            RETURN c
        ";

        return app('db')->connection('neo4j')->select($query);
    }
}
