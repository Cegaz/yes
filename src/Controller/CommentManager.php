<?php
/**
 * Created by PhpStorm.
 * User: hurricane
 * Date: 08/11/17
 * Time: 11:22
 */

namespace Controller;


class CommentManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getComments()
    {

       $commentQuery = '
            SELECT id_user, id_project, comment, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\')
            AS date_creation_fr
            FROM comments
            WHERE id_user = '.$_SESSION['idUser'].'
            ORDER BY date_creation
            DESC LIMIT 0, 5 ' ;
        $result = $this->db->query($commentQuery);
        $comments = array();

        while($data = $result->fetch()) {
            $comments[] =
                ['id_user' => $data['id_user'],
                    'id_project' => $data['id_project'],
                    'comment' => $data['comment']
                ];
        }

        return $comments;
    }

}
