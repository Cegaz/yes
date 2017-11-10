<?php


namespace Model;



class TagsManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function listTags()
    {
        $tagsQuery = 'SELECT DISTINCT * FROM tag';
        $res = $this->db->query($tagsQuery);
        $list = array();
        while($data = $res->fetch()) {
            $list[] = [$data['tag_name']];
        }

        return $list;
    }
}