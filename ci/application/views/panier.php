<h1>Mon panier</h1>

<?php 
// Si le panier n'existe pas encore  
if ($this->session->panier != null) { 
?>
    <div class="row">
        <div class="col-12"> 
        <table class="col-lg text-center">
            <thead>
                <tr>
                    <th class="p-3">Produit</th>
                    <th>Prix</th>
                    <th>Prix total</th>
                    <th>Quantité</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Supprimer</th>  
                </tr>   
            </thead>
            <tbody>
            <?php
            $aPanier= $this->session->panier;
            $iTotal= 0;
            foreach($aPanier as $produit) {
                $iTotal+= $produit['pro_qte'] * $produit['pro_prix'];
                $lTotal= $produit['pro_qte'] * $produit['pro_prix'];

                //  à savoir <?= remplace <?php echo  //
            ?>
                <tr>
                    <td><?= $produit['pro_libelle']; ?></td>
                    <td><?= $produit['pro_prix']; ?></td>
                    <td><?= number_format($lTotal, 2); ?></td>

            <?php echo form_open('panier/modifierProduit');?>
                    <input type="hidden" name="pro_id" value="<?= $produit['pro_id']; ?>">
                    <input type="hidden" name="pro_qte" value="<?= $produit['pro_qte']; ?>">
                    <td><input type="text" class="form-control text-center" value="<?= $produit['pro_qte']; ?>" readonly></td>
                    <td><input type="submit" name="ajouter" value="+"></td>
                    <td><input type="submit" name="retirer" value="-"></td>
            </form> 

            <?php echo form_open('panier/supprimerProduit');?>
                    <input type="hidden" name="pro_id" value="<?= $produit['pro_id']; ?>">
                    <td><input type="submit" value="Supprimer"></td>
                </tr>
            </form>
            <?php 
            }
            ?>   
            </tbody>
        </table>
        <div>
            <div>
                <h3 class="pt-5 pb-3">Récapitulatif</h3>
                <div>
                    <p>TOTAL : <?= str_replace('.', ',' , number_format($iTotal, 2)); ?> &euro;</p>
                    <p><a href="<?= site_url("Panier/viderPanier"); ?>">Vider le panier</a></p> 
                    <p><a href="<?= site_url("Main/liste"); ?>">Retour liste des produits</a></p>
                </div>
            </div>
        </div>
        </div>
    </div>
    <?php 
    } 
    else {
        ?>
        <div class="alert alert-danger">Votre panier est vide. Pour le remplir, vous pouvez consulter <a href="<?= site_url("Main/liste"); ?>">la liste des produits</a>.</div>
        <?php 
    } 