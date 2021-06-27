<?php 

class Ajouter_model extends CI_model {

    function ajouter($data) {
        $ajout= $this->db->insert('produits', $data);
        return $ajout;
    }

    function fetch_cat() {
        $liste_cat= $this->db->query('SELECT * FROM categories');
        return $liste_cat;
    }
}