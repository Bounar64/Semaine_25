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

    function last_id() {
        $last_id= $this->db->query('SELECT MAX(pro_id) + 1 AS name_fichier FROM produits');
        return $last_id->result(); // retourne le résultat ne pas oublier le result() !
    }
}
