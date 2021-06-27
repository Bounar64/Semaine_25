<?php 

class Panier extends CI_Controller {


    public function ajouter() {
        $this->load->library('session');
        $aData= $this->input->post();

        if($this->session->panier == null) {
            $aPanier= array();
            array_push($panier, $aData);
            $this->session->set_userdata('panier', $aPanier);
        } else {
            $aPanier= $this->session->panier;
            $pro_id= $this->input->post('pro_id');
            $bSortie= false;

            foreach($aPanier as $produit) {
                if($produit['pro_id']== $pro_id) {
                    $bSortie= true;
                }
            }

            if($bSortie) {
                echo '<div class="alert alert-danger">Ce produit est déjà dans le panier.</div>';
                redirect('Main/liste');
            } else {
                array_pudh($aPanier, $aData);
                $this->session->panier= $panier;
                $this->load->view('Main/liste', $View);
                redirect('Main/liste');
            }
        }
    }

    public function afficherPanier() {
        $this->load->view('panier');
    }
}