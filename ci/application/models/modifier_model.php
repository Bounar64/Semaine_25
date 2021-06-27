<?php 

class Modifier_model extends CI_model {

    function modifier($data) {
        $where= $this->db->where('pro_id', $id);
        $modif= $this->db->update('produits', $data);
        return $where;
        return $modif;
    }

    function fetch_cat() {
        $liste_cat= $this->db->query('SELECT * FROM categories');
        return $liste_cat;
    }
}