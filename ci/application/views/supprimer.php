<?php echo form_open(); ?>

    <div class="row">
        <div class="col-lg">
            <h1 class="mt-4 mr-6 font-weight-normal h2 text-right">Supprimer un produit</h1>
        </div>
    </div>
    <hr>

    <div class="col-lg">
        <h2 class="mt-4 mr-6 font-weight-normal h2 text-right text-center p-5">Êtes-vous sûr de vouloir supprimer le produit <strong ><?php echo set_value('pro_libelle', $produit->pro_libelle); ?></strong> ?</h2>
    </div>

    <div class="center">
        <button type="submit" class="btn btn-danger px-5 justify-content-center" name="supprimer" value="supprimer">Supprimer</button>
        <style> .center { display: flex; justify-content: center; align-items: center; height: 100px; }</style>
    </div>  
    </form>
    