<?php

namespace App\Repositories;

class CourseRepositoryCypher
{
    public function getAll()
    {
        $query = "MATCH (c:Course) RETURN c";
        return app('db')->connection('neo4j')->select($query);
    }

    public function getById($id)
    {
        $query = "MATCH (c:Course) WHERE ID(c) = $id RETURN c";
        return app('db')->connection('neo4j')->select($query);
    }

    public function create(array $data)
    {
        $query = "CREATE (c:Course {title: '{$data['title']}', desc: '{$data['desc']}'}) RETURN c";
        return app('db')->connection('neo4j')->select($query);
    }

    public function update($id, array $data)
    {
        $query = "MATCH (c:Course) WHERE ID(c) = $id SET c.title = '{$data['title']}', c.desc = '{$data['desc']}' RETURN c";
        return app('db')->connection('neo4j')->select($query);
    }

    public function delete($id)
    {
        $query = "MATCH (c:Course) WHERE ID(c) = $id DETACH DELETE c";
        app('db')->connection('neo4j')->statement($query);
    }

    public function getEnrolledStudents($courseId)
    {
        $query = "
            MATCH (c:Course)-[:ENROLLED_IN]->(s:Student)
            WHERE ID(c) = $courseId
            RETURN s
        ";

        return app('db')->connection('neo4j')->select($query);
    }
}