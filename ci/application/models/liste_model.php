<?php

class Liste_model extends CI_Model {

    function fetch_liste() {

        $liste= $this->db->query('SELECT * FROM produits JOIN categories ON cat_id=pro_cat_id');
        return $liste;
    }

}