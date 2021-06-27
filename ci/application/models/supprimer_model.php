<?php

class Supprimer_model extends CI_Model {

function supp($id) {

    $supp= $this->db->query('SELECT * FROM produits WHERE pro_id= ?', $id);
    return $supp;
}

function produit() {
    $produit= $this->db->query('SELECT * FROM categories');
    return $produit;
}
}