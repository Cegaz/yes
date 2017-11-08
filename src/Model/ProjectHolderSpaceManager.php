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

    public function checkProjectHolder($id)
    {
        $queryHolder = "SELECT * 
                        FROM user u
                        INNER JOIN project_holder ph
                        ON u.id = ph.id_user
                        WHERE u.id = $id";
        $result = $this->db->query($queryHolder);
        $datas = $result->fetch(\PDO::FETCH_OBJ);
        return $datas;
    }

}