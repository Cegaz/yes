<?php
/**
 * Created by PhpStorm.
 * User: gilles
 * Date: 07/11/17
 * Time: 17:36
 */

namespace Model;


class ProjectHolderSpaceManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function checkProjectHolder($id) {
        $queryHolder = "SELECT * 
                        FROM user u
                        INNER JOIN project_holder ph
                        ON u.id = ph.id_user
                        WHERE u.id = $id";
        $result = $this->db->query($queryHolder);
        $datas = $result->fetch(\PDO::FETCH_OBJ);
        return $datas;
    }

    public function showProject($id, $progress){
        $queryProject = "SELECT * 
                                    FROM project p
                                    INNER JOIN project_holder ph
                                    ON p.id_project_holder = ph.id
                                    WHERE p.id_project_holder = $id
                                    AND p.progress = :progress";
        $prep = $this->db->prepare($queryProject);
        $prep->bindValue(':progress', $progress);
        $prep->execute();
        $datas = $prep->fetchAll(\PDO::FETCH_OBJ);
        return $datas;
    }


}