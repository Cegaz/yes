<?php
/**
 * Created by PhpStorm.
 * User: cecile
 * Date: 19/10/17
 * Time: 14:23
 */

namespace Model;

class ProjectsManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getProjectsAbstracts($id, $progress, $limit, $start = 0) {
        $queryId="";
        $queryProgress= "";
        $queryLimit="";

        if($progress !==null) {
            $queryProgress = " WHERE p.progress = :progress";
        }

        if($id !== null){
            $queryId = " AND p.id_project_holder = $id";
        }

        if($limit !== null) {
            $queryLimit = " LIMIT " . $start . ',' . $limit ;
        }

        $query = 'SELECT p.id, p.title, p.short_description, p.date,
        p.little_picture, p.amount, p.dead_line, p.id_project_holder,
        ph.first_name, ph.name, ph.avatar, ph.id,
        SUM(f.amount) AS collected, f.id_project
        FROM project p
        JOIN project_holder ph
        ON p.id_project_holder = ph.id
        right JOIN financement f
        ON f.id_project = p.id' . $queryProgress. $queryId . '
        GROUP BY f.id_project
        ORDER BY p.dead_line ASC' . $queryLimit . ';';



        $prep = $this->db->prepare($query);
        $prep->bindValue(':progress', $progress);
        $prep->execute();

        $projects = [];
        while($data = $prep->fetch()) {
            $date1 = strtotime(date('Y-m-d'));
            $date2 = strtotime($data['dead_line']);

            $projects[] =  ['title' => $data['title'],
                'short_description' => $data['short_description'],
                'little_picture' => $data['little_picture'],
                'amount' => $data['amount'],
                'dead_line' => $data['dead_line'],
                'first_name' => $data['first_name'],
                'name' => $data['name'],
                'avatar' => $data['avatar'],
                'time_left' => round(($date2 - $date1)/3600/24),
                'collected' => $data['collected'],
                'percent' => round($data['collected']/$data['amount']*100)
            ];
        }

        return $projects;
    }
}