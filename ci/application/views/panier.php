<h1>Mon panier</h1>

<?php 
// Si le panier n'existe pas encore  
if ($this->session->panier != null) 
{ 
?>
    <div class="row">
    <div class="col-12"> 
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>&nbsp;</th> 
            </tr>   
        </thead>
        <tbody>
        <?php 
        $iTotal = 0;

        /* ici, écrire le code pour afficher les produits mis dans le panier...
        * ... oh oh oh! ça sent la boucle...  
        * n'oubliez pas de calculer le total,
        * ni d'ajouter de mettre un champ de type number pour augmenter/diminuer la quantité d'un produit
        */
        ?>
        </tbody>
    </table>
    </div>
    <div>
        <div>
            <h3>Récapitulatif</h3>
            <div>
                <p>TOTAL : <?= str_replace('.', ',' , $iTotal); ?> &euro;</p>
                <p href="<?= site_url("panier/supprimerPanier"); ?>" >Supprimer le panier</a></p> 
                <p><a href="<?= site_url("Main/liste"); ?>">Retour liste des produits</a></p>
            </div>
        </div>
    </div>
    </div>
    <?php 
    } 
    else 
    { 

        ?>
        <div class="alert alert-danger">Votre panier est vide. Pour le remplir, vous pouvez consulter <a href="<?= site_url("Main/liste"); ?>">la liste des produits</a>.</div>
        <?php 
    } 