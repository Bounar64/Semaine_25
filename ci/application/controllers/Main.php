<?php
// application/controllers/Produits.php
date_default_timezone_set('Europe/Paris');
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
    public function liste() {
        $this->load->view('header');
        $this->load->model('liste_model');
        $liste['fetch_liste']= $this->liste_model->fetch_liste();
        $this->load->view('liste', $liste);
        $this->load->view('footer');
    }

    public function ajouter() {
        $this->load->view('header');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger p-1">', '</div>'); // ne pas oublier de rajouter le link et le script bootstrap
        $this->load->database();  
        $this->load->model('ajouter_model');
        $cat['fetch_cat']= $this->ajouter_model->fetch_cat();

        if($this->input->post()) {

            $data= $this->input->post();
            $this->form_validation->set_rules("pro_ref", "Référence", "trim|required|alpha_numeric", array("required"=> "Champ obligatoire", "alpha_numeric"=> "La %s doit avoir uniquement des caractères alphabétiques et/ou numériques"));
            $this->form_validation->set_rules("pro_cat_id", "Catégorie", "trim|required", array("required"=> "Veuillez faire un choix"));
            $this->form_validation->set_rules("pro_libelle", "Libellé", "trim|required|alpha_numeric", array("required"=> "Champ obligatoire", "alpha_numeric"=> "Le %s doit avoir uniquement des caractères alphabétiques"));
            $this->form_validation->set_rules("pro_description", "Déscription", "trim|required|regex_match[/^[a-zA-Z0-9_. ,]*$/]", array("required"=> "Champ obligatoire", "regex_match"=> "La %s doit avoir uniquement des caractères alphabétiques et/ou numériques"));
            $this->form_validation->set_rules("pro_prix", "Prix", "trim|required|decimal", array("required"=> "Champ obligatoire", "decimal"=> "Le %s doit avoir uniquement des caractères décimaux exemple 19.99"));
            $this->form_validation->set_rules("pro_stock", "Stock", "trim|required|integer", array("required"=> "Champ obligatoire", "integer"=> "Le %s doit avoir uniquement des caractères numériques"));
            $this->form_validation->set_rules("pro_couleur", "Couleur", "trim|required|alpha", array("required"=> "Champ obligatoire", "alpha"=> "La %s doit avoir uniquement des caractères alphabétiques"));
            $this->form_validation->set_rules("pro_bloque", "Produit bloqué", "trim|required", array("required"=> "Veuillez faire un choix"));
            $this->form_validation->set_rules("pro_d_ajout", "Date d'ajout", array());

            if($this->form_validation->run()== FALSE) {
                $this->load->view('ajouter', $cat);
            } else {
                if($_FILES) {
                    $extension= substr(strrchr($_FILES['fichier']['name'], '.'), 1); // fichier est la valeur donnée à l'attribut name du champ de type 'file'
                }
                $last_id= $this->ajouter_model->last_id(); // récupère dernière clé primaire + 1 (équivaut au prochain pro_id généré)
                // var_dump($last_id);
                $id= $last_id[0]->name_fichier; // on récupère la propriété de l'objet 
                $id= intval($id); // on convertie en int
                $config['upload_path']= '..\ci\assets\images'; // chemin où sera stocké le fichier
                $config['file_name']= $id.'.'.$extension; // nom du fichier final
                $config['allowed_types']= 'gif|jpg|jpeg|png|tiff'; // On indique les types autorisés 
                $this->load->library('upload'); // On charge la librairie 'upload'
                $this->upload->initialize($config); // On initialise la config

                if(!$this->upload->do_upload('fichier')) {
                     // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
                    $sUploadErrors= $this->upload->display_errors(); // Echec : on récupère les erreurs dans une variable (une chaîne)
                    $View['sUploadErrors']= $sUploadErrors; // on réaffiche la vue du formulaire en passant les erreurs 
                    $View['fetch_cat']= $this->ajouter_model->fetch_cat(); 
                    error_log($sUploadErrors, 0); //  On envoie le message d'erreur dans le fichier php_error.log
                    $this->load->library('session'); // avec la librairie session on envoie un message flash à l'utilisateur
                    $this->session->set_flashdata("fichier", "<div class='alert alert-danger p-1'>Le téléchargement de la photo a échoué </div>");
                    $aUploadDatas= $this->upload->data(); // récupère (dans un tableau PHP) les informations d'origine sur le fichier téléchargé. 
                    // var_dump($aUploadDatas);
                    $this->load->view('ajouter', $View);
                } else {  
                    $ajout['ajouter']= $this->ajouter_model->ajouter($data); // ajout dans la bdd 
                    redirect("Main/liste");
                }               
            }
        } else {
            $this->load->view('ajouter', $cat);
        }      
        $this->load->view('footer');
    }

    public function modifier($id) {
        $this->load->view('header'); 
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger p-1">', '</div>');
        $this->load->database();  
        $produit= $this->db->query('SELECT * FROM produits JOIN categories ON pro_cat_id=cat_id WHERE pro_id= ?', $id);
        $aView["produit"]= $produit->row();

        $results= $this->db->query('SELECT * FROM categories');
        $aListe= $results->result();
        $aView['liste_produits']= $aListe;

        if ($this->input->post()) { 
            $data= $this->input->post();
            $this->form_validation->set_rules("pro_ref", "Référence", "trim|required|alpha_numeric", array("required"=> "Champ obligatoire", "alpha_numeric"=> "La %s doit avoir uniquement des caractères alphabétiques et/ou numériques"));
            $this->form_validation->set_rules("pro_cat_id", "Catégorie", "trim|required", array("required"=> "Veuillez faire un choix"));
            $this->form_validation->set_rules("pro_libelle", "Libellé", "trim|required|alpha_numeric", array("required"=> "Champ obligatoire", "alpha_numeric"=> "Le %s doit avoir uniquement des caractères alphabétiques et/ou numériques"));
            $this->form_validation->set_rules("pro_description", "Déscription", "trim|required|regex_match[/^[a-zA-Z0-9_. ,]*$/]", array("required"=> "Champ obligatoire", "regex_match"=> "La %s doit avoir uniquement des caractères alphabétiques et/ou numériques"));
            $this->form_validation->set_rules("pro_prix", "Prix", "trim|required|decimal", array("required"=> "Champ obligatoire", "decimal"=> "Le %s doit avoir uniquement des caractères décimaux exemple 19.99"));
            $this->form_validation->set_rules("pro_stock", "Stock", "trim|required|integer", array("required"=> "Champ obligatoire", "integer"=> "Le %s doit avoir uniquement des caractères numériques"));
            $this->form_validation->set_rules("pro_couleur", "Couleur", "trim|required|alpha", array("required"=> "Champ obligatoire", "alpha"=> "La %s doit avoir uniquement des caractères alphabétiques"));
            $this->form_validation->set_rules("pro_bloque", "Produit bloqué", "trim|required", array("required"=> "Veuillez faire un choix"));
            $this->form_validation->set_rules("pro_d_modif", "Date de modification", array());
            var_dump($data);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('modifier', $aView);
            } else {  
                $this->db->where('pro_id', $id);
                $this->db->update('produits', $data);
                redirect("Main/liste");
            }
        } else {             
            $this->load->view('modifier', $aView);
        }     
        $this->load->view('footer');
    }

    public function supprimer($id) {
        $this->load->view('header');
        $this->load->database();
        $produit= $this->db->query('SELECT * FROM produits WHERE pro_id= ?', $id);
        $fetch["produit"]= $produit->row();
        $this->load->view('supprimer', $fetch);
        if($this->input->post('supprimer')) {
            $this->db->where('pro_id', $id);
            $this->db->delete('produits');
            redirect('Main/liste');
        }
        $this->load->view('footer');
        }      
    }
?>