<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 15/11/17
 * Time: 11:09
 */

namespace Model;


class showOneProjectManager
{
    private $db;
    private $id;


    public function __construct($db, $id)
    {
        $this->db = $db;
        $this->id = $id;
    }

    public function showOne() {

        $id = $this->id;

        $query = 'SELECT p.id,p.picture1,p.picture2, p.picture3, p.title, p.short_description, p.date,
        p.little_picture, p.amount, p.dead_line, p.id_project_holder,
        ph.first_name, ph.name, ph.avatar, ph.id,
        SUM(f.amount) AS collected, f.id_project
        FROM project p
        JOIN project_holder ph
        ON p.id_project_holder = ph.id
        right JOIN financement f
        ON f.id_project = p.id
       /* GROUP BY f.id_project */
        WHERE p.id = ' . ':id' . '
        ';

        $prep = $this->db->prepare($query);
        $prep->bindValue(':id', $id);
        $prep->execute();
        $data = $prep->fetch(\PDO::FETCH_ASSOC);

        $date1 = strtotime(date('Y-m-d'));
        $date2 = strtotime($data['dead_line']);

        $project =  ['title' => $data['title'],
            'id'=> $data['id_project'],
            'titleReplace' => str_replace(' ','-',$data['title']),
            'short_description' => $data['short_description'],
            'little_picture' => $data['little_picture'],
            'amount' => $data['amount'],
            'dead_line' => $data['dead_line'],
            'first_name' => $data['first_name'],
            'name' => $data['name'],
            'avatar' => $data['avatar'],
            'time_left' => round(($date2 - $date1)/3600/24),
            'collected' => $data['collected'],
            'percent' => round($data['collected']/$data['amount']*100),
            'picture1' => $data['picture1'],
            'picture2' => $data['picture2'],
            'picture3' => $data['picture3']
        ];

        return $project;

    }
}