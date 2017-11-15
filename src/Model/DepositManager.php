<?php
/**
 * Created by PhpStorm.
 * User: hurricane
 * Date: 07/11/17
 * Time: 15:11
 */

namespace Model;


class DepositManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function newProjectHolder($structure_name, $name, $first_name, $phone, $avatar)
    {
        $prep = $this->db->prepare(
            'INSERT INTO project_holder(id_user, date, structure_name, name, first_name, phone, avatar)
            VALUES(:id_user, NOW(), :structure_name, :name, :first_name, :phone, :avatar)');
        $querySuccess = $prep->execute([
            ':id_user'=>$_SESSION['idUser'],
            ':structure_name'=>$structure_name,
            ':name'=>$name,
            ':first_name'=>$first_name,
            ':phone'=>$phone,
            ':avatar'=>$avatar
        ]);

        return $querySuccess;
    }

    public function newDeposit($title, $shortDescription, $littlePicture)
    {
        $prep = $this->db->prepare(
            'INSERT INTO project(title, short_description, little_picture, id_project_holder)
            VALUES(:title, :shortDescription, :littlePicture, :idProjectHolder)');
        $querySuccess = $prep->execute([
            ':title'=>$title,
            ':shortDescription'=>$shortDescription,
            ':littlePicture'=>$littlePicture,
            ':idProjectHolder'=>$_SESSION['idProjectHolder']
        ]);
        return $querySuccess;
    }

    public function updateDeposit($description1, $description2, $description3, $description4,
                                   $sponsors, $pathList)
    {
        $prep = $this->db->prepare(
            'UPDATE project SET description1 = :desc1, description2 = :desc2, description3 = :desc3,
            description4 = :desc4, sponsors = :sponsors, picture1 = :pic1, picture2 = :pic2,
            picture3 = :pic3
            WHERE id = :id');
        $querySuccess = $prep->execute([
            ':id'=>$_SESSION['idProject'],
            ':desc1'=>$description1,
            ':desc2'=>$description2,
            ':desc3'=>$description3,
            ':desc4'=>$description4,
            ':sponsors'=>$sponsors,
            ':pic1'=>$pathList[0],
            ':pic2'=>$pathList[1],
            ':pic3'=>$pathList[2]
        ]);

        return $querySuccess;
    }

    public function updateDeposit2($amount, $launchDate, $deadLine)
    {
        $launchDate = strtotime($launchDate);
        $launchDate = date('Y-m-d', $launchDate);

        $deadLine = strtotime($deadLine);
        $deadLine = date('Y-m-d', $deadLine);

        $prep = $this->db->prepare(
            'UPDATE project SET amount = :amount, launch_date = :launchDate, dead_line = :deadLine
            WHERE id = :id');
        $querySuccess = $prep->execute([
            ':id'=>$_SESSION['idProject'],
            ':amount'=>$amount,
            ':launchDate'=>$launchDate,
            ':deadLine'=>$deadLine
        ]);

        return $querySuccess;
    }

    public function updateStep($step)
    {
        $prep = $this->db->prepare(
            'UPDATE project SET step_form = :step WHERE id = :id'
        );
        $prep->execute([
            ':step'=>$step,
            ':id'=>$_SESSION['idProject']
        ]);
    }

    public function changeProgress($idProject, $progress)
    {
        $prep = $this->db->prepare(
            'UPDATE projet SET progress = :progress WHERE id = :idProject');
        $prep->execute([
            ':progress'=>$progress,
            ':idProject'=>$idProject
        ]);
    }



}

