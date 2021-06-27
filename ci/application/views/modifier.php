<?php echo form_open(); ?>

    <div class="row">
        <div class="col-lg">
            <h1 class="mt-4 mr-6 font-weight-normal h2 text-right">Modifier un produit</h1>
        </div>
    </div>
    <hr>

    <div class="form-group">
        <label for="pro_id">ID</label>
        <input type="text" name="pro_id" id="pro_id" class="form-control" value="<?php echo set_value('pro_id', $produit->pro_id); ?>" readonly>
        <small style="color:#FF0000"><?php echo form_error('pro_ref'); ?></small>
    </div> 

    <div class="form-group">
        <label for="pro_ref">Référence</label>
        <input type="text" name="pro_ref" id="pro_ref" class="form-control" value="<?php echo set_value('pro_ref', $produit->pro_ref); ?>">
        <small style="color:#FF0000"><?php echo form_error('pro_ref'); ?></small>
    </div> 

    <div class="form-group">
        <label for="pro_cat_id">Catégorie</label>
        <select name="pro_cat_id" id="pro_cat_id" class="form-control" value="<?php echo set_value('pro_cat_id', $produit->pro_cat_id); ?>">
        <option>
                <?php
                    echo set_value('cat_nom', $produit->cat_nom); 
                    foreach ($liste_produits as $row) {
                        echo"<option>".$row->cat_nom."</option>";
                    }
                ?>
            </option>
        </select>
        <small style="color:#FF0000"><?php echo form_error('pro_cat_id'); ?></small>
    </div> 

    <div class="form-group">
        <label for="pro_libelle">Libellé</label>
        <input type="text" name="pro_libelle" id="pro_libelle" class="form-control" value="<?php echo set_value('pro_libelle', $produit->pro_libelle); ?>">
        <small style="color:#FF0000"><?php echo form_error('pro_libelle'); ?></small>
    </div>

    <div class="form-group">
        <label for="pro_description">Description</label>
        <textarea name="pro_description" id="pro_description" class="form-control"><?php echo set_value('pro_description', $produit->pro_description); ?></textarea>
        <style> #pro_description { resize: none; height: 150px; width: 1110px; }</style>
        <small style="color:#FF0000"><?php echo form_error('pro_description'); ?></small>
    </div>

    <div class="form-group">
        <label for="pro_prix">Prix (€)</label> 
        <input type="text" name="pro_prix" id="pro_prix" class="form-control" value="<?php echo set_value('pro_prix', $produit->pro_prix); ?>">
        <small style="color:#FF0000"><?php echo form_error('pro_prix'); ?></small>
    </div>

    <div class="form-group">
        <label for="pro_stock">Stock</label> 
        <input type="text" name="pro_stock" id="pro_stock" class="form-control" value="<?php echo set_value('pro_stock', $produit->pro_stock); ?>">
        <small style="color:#FF0000"><?php echo form_error('pro_stock'); ?></small>
    </div>

    <div class="form-group">
        <label for="pro_couleur">Couleur</label> 
        <input type="text" name="pro_couleur" id="pro_couleur" class="form-control" value="<?php echo set_value('pro_couleur', $produit->pro_couleur); ?>">
        <small style="color:#FF0000"><?php echo form_error('pro_couleur'); ?></small>
    </div>

    <div class="form-group">
        <label for="pro_bloque" class="form-label">Produit bloqué ?</label> 
            </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque" value="<?php echo set_value('pro_bloque', $produit->pro_bloque)?>" <?php if(set_value('pro_bloque', $produit->pro_bloque) == 1) { ?> checked <?php } ?>>
                    <label class="form-check-label" for="bloqueoui">Oui</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pro_bloque" id="pro_bloque" value="<?php echo set_value('pro_bloque', $produit->pro_bloque)?>" <?php if(set_value('pro_bloque', $produit->pro_bloque) == 0) { ?> checked <?php } ?>>
                    <label class="form-check-label" for="bloquenon">Non</label>
                </div>
            <div>
                <small style="color:#FF0000"><?php echo form_error('pro_bloque'); ?></small>
            </div><br>

    <div class="form-group">
        <label for="pro_stock">Date d'ajout</label> 
        <input type="text" name="pro_d_ajout" id="pro_d_ajout" class="form-control" value="<?php echo set_value('pro_d_ajout', $produit->pro_d_ajout); ?>" readonly>
    </div>

    <div class="form-group">
        <label for="pro_stock">Date de modification</label> 
        <input type="text" name="pro_d_modif" id="pro_d_modif" class="form-control" value="<?php echo (date('Y-m-d H:i:s')); ?>" readonly>
    </div>

    <div class="center">
        <button type="submit" class="btn btn-warning px-5 justify-content-center">Modifier</button>
        <style> .center { display: flex; justify-content: center; align-items: center; height: 100px; }</style>
    </div>  
</form>
