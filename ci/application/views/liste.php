<div class="row">
    <div class="col-lg">
        <h1 class="mt-4 mr-6 font-weight-normal h2 text-right">Liste des produits</h1>
    </div>
</div>
<hr>

<table class="table table_bordered">
    <tr>
        <th class="th">ID</th>
        <th class="th">photo</th>
        <th class="th">Catégorie</th>
        <th class="th">Référence</th>
        <th class="th">Libellé</th>
        <th class="th">Description</th>
        <th class="th">prix</th>
        <th class="th">stock</th>
        <th class="th">couleur</th>
        <th class="th">date d'ajout</th>
        <th class="th">date de modification</th>
        <th class="th">bloqué</th>
        <?php
        if ($this->session->panier != null) {
        $aPanier= $this->session->panier;
        $Total= 0;
        foreach($aPanier as $produit) {
            $Total += $produit['pro_qte'];
        }
        ?>
        <th class="th"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
        </svg><a href="<?= site_url("panier/afficherPanier"); ?>"> Panier </a><button type="button" class="btn btn-warning"><span class="badge badge-light"></span><?= $Total; ?></button></th>
    </tr>
    <?php } else { ?>
        <th class="th"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
        </svg>Panier <button type="button" class="btn btn-warning"><span class="badge badge-light"></span>0</button></th>
    <?php } ?>

    <?php 
    foreach($fetch_liste->result() as $row) { ?>
    <tr>
        <td><?php echo $row->pro_id ?></td>
        <td><?php echo $row->pro_photo ?></td>
        <td><?php echo $row->cat_nom ?></td>
        <td><?php echo $row->pro_ref ?></td>
        <td><?php echo $row->pro_libelle ?></td>
        <td><?php echo $row->pro_description ?></td>
        <td><?php echo $row->pro_prix ?></td>     
        <td><?php echo $row->pro_stock ?></td>     
        <td><?php echo $row->pro_couleur ?></td>     
        <td><?php echo $row->pro_d_ajout ?></td>     
        <td><?php echo $row->pro_d_modif ?></td>     
        <td><?php echo $row->pro_bloque ?></td>    
        <td>
            <?php echo form_open('panier/ajouterPanier');?> 
                <input type="number" class="form-control text-center" name="pro_qte" id="pro_qte" value="1" min="1">
                <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $row->pro_id ?>">
                <input type="hidden" name="pro_libelle" id="pro_libelle" value="<?php echo $row->pro_libelle ?>">
                <input type="hidden" name="pro_prix" id="pro_prix" value="<?php echo $row->pro_prix ?>">  
                <input type="submit" value="Ajouter au panier" class="btn btn-primary btn-sm mt-2 p-2"> 
            </form>            
        </td>    
    <?php
    }
    ?>
    <p><?php if(isset($this->session->doublon)) { echo $this->session->doublon; } ?></p>
    </tr>      
</table>
</form>
