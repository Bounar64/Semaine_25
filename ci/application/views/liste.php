<?php echo form_open('panier/ajouterPanier'); ?>

<div class="row">
    <div class="col-lg">
        <h1 class="mt-4 mr-6 font-weight-normal h2 text-right">Liste des produit</h1>
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
        <th class="th"></th>
    </tr>
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
        <td><input type="number" class="form-control text-center" name="pro_qte" id="pro_qte" value="1">
            <input type="submit" value="Ajouter au panier" class="btn btn-primary btn-sm mt-2 p-2">
            <input type="hidden" name="pro_id" id="pro_id" value="<?= $row->pro_prix ?>">
            <input type="hidden" name="pro_libelle" id="pro_libelle" " value="<?= $row->pro_libelle ?>">        
        </td>    
    <?php
    }
    ?>
    </tr>      
</table>
</form>