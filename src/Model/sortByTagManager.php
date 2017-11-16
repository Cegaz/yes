<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 07/11/17
 * Time: 16:40
 */

namespace Model;


class sortByTagManager
{

    private $db;
    private $tag;

    public function __construct($db, $tag)
    {
        $this->db = $db;
        $this->tag = $tag;
    }

    public function sortByTagRequest() {

$projectsWithThisTag = $this->db->query("SELECT ltp.id_project, ltp.id_tag, t.id, t.tag_name
   FROM link_tag_project ltp
   JOIN tag t 
   ON ltp.id_tag = t.id
   WHERE t.tag_name = '$this->tag'
   ");


        $projectsId = [];

        while($data2 = $projectsWithThisTag->fetch()) {
            $projectsId[] =  $data2['id_project'];


        }




        $result = $this->db->query('SELECT p.id, p.title, p.short_description, p.date,
        p.little_picture, p.amount, p.dead_line, p.id_project_holder,
        ph.first_name, ph.name, ph.avatar, ph.id,
        SUM(f.amount) AS collected, f.id_project
        FROM project p
        JOIN project_holder ph
        ON p.id_project_holder = ph.id
        right JOIN financement f
        ON f.id_project = p.id
        WHERE p.id IN (' . implode($projectsId, ", ") . ')
        GROUP BY f.id_project 
        ORDER BY p.dead_line DESC
        LIMIT 3
        ');


        $projects = [];
        while($data = $result->fetch()) {
            $date1 = strtotime(date('Y-m-d'));
            $date2 = strtotime($data['dead_line']);

            $projects[] =  ['title' => $data['title'],
                'id' => $data['id'],
                'short_description' => $data['short_description'],
                'titleReplace' => str_replace(' ','-',$data['title']),
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