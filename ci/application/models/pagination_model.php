<?php

class Pagination_model extends CI_Model {

    protected $table= 'produits'; // protected $table= 'produits'; protected variable qui définit le nom de la table pour le modèle

    public function __construct() { // public function __construct() {…} appelle de la méthode parent constructor
        parent::__construct(); 
    }

    public function get_counter() { // public function get_count() {…} retourne la totalité des enregistrements de la table "produits".
        return $this->db->count_all($this->table);
    }

    public function get_prod($limit, $start) { // public function get_prod($limit, $start) {…} cette méthode sera utilisée pour récupérer les résultats de pagination de la table. limit definit le nombre total d'enregistrements à retourner tandis que 'start' définit le nombre d'enregistrements qui sont sautés.
        $this->db->limit($limit, $start);
        $query= $this->db->get($this->table);

        return $query->result();
    }
}