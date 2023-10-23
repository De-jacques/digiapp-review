{{-- MOUVEMENT DE Produit

Ici on doit pouvoir gérer tout ce qui est mouvement des différents produits dans les différents entrepots

en partant d'un tableau qui aura d'abord des informations sur le produit(designation,quantite) et la quantite de chacun des 
autres entrepots

----------------------------------------------------------------------------------------------------------------------------
{{-- 
ENTREPOT 


POUVOIR FILTRER LES PRODUITS DE L'ENTREPOT A | B | Etc
à partir de l'entête quand l'entrepot en question est sélectionné, la db doit charger --}}


{{-- ---------------------------------------------------------------------------------------------------------------------------

Retirer la quantité de la création du produit

C'est dans la section mouvement et entrée de bon qu'on enrégistre la quantite et l'entrepot concerné

--------------------------------------------------------------------------------------------------------------------------- --}}



{{-- DANS LE GESTIONNAIRE DE STOCK --}}

{{-- PRODUIT -> QUANTITE -> ENTREPOT( PAR DEFAUT LE PREMIER ENTREPOT EST SELECTIONNÉ) 
    
    ----------------------------------------------------------------------------------------------------------------------------
    --}}

{{-- DANS GESTION DES STOCKS
    - Création des produits: champs retenus
            - Désignation
            - Marque
            - Sous catégorie
            - Prix de revient
            - Description --}}

    {{-- - Bon d'entrée :
                    champs retenus(
                        - Fournisseurs
                        - numero de Factures
                        - Produits *
                        - Quantité *
                        - Entrepot *
                    ) --}}
 {{-- 
Mettre la quantité de tous les produits à zéro dans tous les entrepots à la Création

Le bon d'entré seul peut modifier les data de la quantité


--------------------------------------------------------------------------

Possibilité de demander un surdiscount

Commercial tant demande une remise de tant pour le client tant 



 --}}
 ----------------------------------------------------------------------------------------------------------------------------
<br>
GESTION DES SN
<br>
- juste une vue,
<br>
- chak item a une SN (Serial Number)
<br>
- Sn des produits en stock
<br>
- SN des produits sortis
<br>
ACCORDION