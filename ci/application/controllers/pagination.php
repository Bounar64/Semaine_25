<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination extends CI_Controller { // class Pagination extends CI_Controller {…} on définit la classe Pagination

    public function __construct() { // public function __construct() {…} Cette méthode initialise la méthode parent constructor et charge l url helper, *pagination_model et pagination` dans la librairie.
        parent:: __construct();
         // On peux aussi configurer le fichier application/config/autoload.php ce qui dispense d'écrire les trois lignes suivantes :
        $this->load->helper('url');
        $this->load->model('pagination_model');
        $this->load->library("pagination");
    }

    public function index() { // public function index() {…} définit la méthode qui répond à notre route.
        $config= array();
        $config["base_url"]= site_url() . "/pagination"; // $config["base_url"]= base_url() . "pagination"; Url de pagination qui sera utilsée pour générer les liens de pagination.
        $config["total_rows"]= $this->pagination_model->get_counter(); // $config["total_rows"]= $this->pagination_model->get_counter(); fixe les lignes totales à paginer. La valeur est récupérée de 'pagination_model' en appelant la méthode 'get_count'.
        $config["per_page"]= 3; // $config["per_page"]= 3; définit les lignes qui seront affichées par page ici 3.
        $config["uri_segment"]= 2; // $config["uri_segment"]= 2; spécifie que le segment d'Url est composé de 2 segments; dans l'exemple: pagination/nombre-de-pages-sautés

        $this->pagination->initialize($config); //  initialise la librairie pagination utilisant la config array.

        $page= ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; // if ($this->uri->segment(2)) { $page= $this->uri->segment(2); } else { $page = 0; } vérifie que le nombre des pages sautées est dans la seconde partie du segment de l'URI et s'il n'y est pas la valeur 0 est fixée à la variable $page

        $data["links"]= $this->pagination->create_links(); // $data["links"]= $this->pagination->create_links(); créer les liens de pagination et les fixent dans la variable $data array.

        $data['pagination']= $this->pagination_model->get_prod($config["per_page"], $page); // $data['pagination']= $this->pagination_model->get_prod($config["per_page"], $page); récupère les enregistrements par page les assignent dans la variable $data array.

        $this->load->view('paginations/index', $data); // $this->load->view('paginations/index', $data); charge l'index (view) dans le dossier 'paginations' et le passe dans la variable $data.
    }

    //*****************Attention : $config["uri_segment"] et $page doivent avoir la même valeur ici 2 parce que deux éléments dans l'URI : pagination/number*****************
}
