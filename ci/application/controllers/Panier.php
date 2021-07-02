<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Panier extends CI_Controller {

    public function ajouterPanier() {
        $aData= $this->input->post(); // On récupère les données du formulaire 
        if($this->session->panier == null) { // Au 1er article ajouté, création du panier car il n'existe pas
            $aPanier= array(); // On créé un tableau pour stocker les informations du produit
            array_push($aPanier, $aData);  // On ajoute les infos du produit ($aData) au tableau du panier ($aPanier)
            $this->session->set_userdata('panier', $aPanier); // On stock le panier dans une variable de session nommée 'panier'   
        } else { // le panier existe (on a déjà mis au moins un article)
            $aPanier= $this->session->panier; // On récupère le contenu du panier en session 
            $pro_id= $this->input->post('pro_id');
            $bSortie= false;

            foreach($aPanier as $produit) { // on cherche si le produit existe déjà dans le panier
                if(!empty($produit['pro_id']) && $produit['pro_id']== $pro_id) {
                    $bSortie= true;
                }
            }

            if($bSortie) { // si le produit est déjà dans le panier, l'utilisateur est averti
                $this->session->set_flashdata("doublon", "<div class='alert alert-danger p-2'>Ce produit est déjà dans le panier</div>");
                redirect('Main/liste'); // On redirige sur la liste
            } else {
                array_push($aPanier, $aData); // sinon, le produit est ajouté dans le panier
                $this->session->panier= $aPanier;
                redirect('Main/liste');
            }
        }
    }

    public function viderPanier() {
        // $this->session->sess_destroy();
        $this->session->set_userdata('panier');
        redirect("panier/afficherPanier");
    }

    public function supprimerProduit() {
        $aPanier= $this->session->panier;
        $pro_id= $this->input->post('pro_id');
        $aTemp= array(); //création d'un tableau temporaire vide

        for ($i= 0; $i < count($aPanier); $i++) { //on cherche dans le panier les produits à ne pas supprimer
            if ($aPanier[$i]['pro_id'] !== $pro_id) {
                array_push($aTemp, $aPanier[$i]); // ces produits sont ajoutés dans le tableau temporaire
            }
        }

        $aPanier= $aTemp;
        unset($aTemp);
        $this->session->panier= $aPanier; // le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer
        $this->session->set_userdata("panier", $aPanier);
        // On réaffiche le panier 
        redirect("panier/afficherPanier");
    }

    public function modifierProduit() {
    $aPanier= $this->session->panier;
    $pro_id= $this->input->post('pro_id');
    $pro_qte= $this->input->post('pro_qte');

    
    if($this->input->post('ajouter')) { // Pour augmenter la quantité
        $aTemp= array(); //création d'un tableau temporaire vide
        // On parcourt le tableau produit après produit
        for ($i= 0; $i < count($aPanier); $i++) {
            if ($aPanier[$i]['pro_id'] !== $pro_id) {
                array_push($aTemp, $aPanier[$i]);
            } else {
                $aPanier[$i]['pro_qte']++;
                array_push($aTemp, $aPanier[$i]);
            }
        }
    } elseif($this->input->post('retirer')) { // Pour baisser la quantité
        $aTemp= array(); //création d'un tableau temporaire vide
        // On parcourt le tableau produit après produit
        for ($i= 0; $i < count($aPanier); $i++) {
            if ($aPanier[$i]['pro_id'] !== $pro_id) {
                array_push($aTemp, $aPanier[$i]);
            } else {
                if($aPanier[$i]['pro_qte'] > 1) { // pour éviter le chiffre négatif
                $aPanier[$i]['pro_qte']--;
                array_push($aTemp, $aPanier[$i]);
                } else {
                    $aPanier[$i]['pro_qte'] == 1;
                    array_push($aTemp, $aPanier[$i]);
                }
            }
        }
    }
        $aPanier= $aTemp;
        unset($aTemp);
        $this->session->set_userdata("panier", $aPanier);
        // On réaffiche le panier 
        redirect("panier/afficherPanier");
        }  

    public function afficherPanier() {
        $this->load->view('header');
        $this->load->view('panier');
        $this->load->view('footer');   
    }
}