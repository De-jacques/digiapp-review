<div id="condition">
                                    <div class="mt-5">
                                        <div class="text-center mb-3">
                                            <h2 class="">CONDITION DE VENTE</h2>
                                        </div>

                                        <textarea class="form-control ckeditor " name="conditionVente"
                                            id="conditionsTextarea" placeholder="Description du produit"
                                            style="height: 100px"></textarea>

                                    </div>
                                    <div class="mt-5">
                                        <div class="text-center mb-3">
                                            <h2 class="">GUARANTIE</h2>
                                        </div>

                                        <textarea class="form-control ckeditor" name="garantieTextarea"
                                            id="garantieTextarea" placeholder="Description du produit"
                                            style="height: 100px"></textarea>

                                    </div>
                                    <div class="mt-5">
                                        <div class="text-center mb-3">
                                            <h2 class="">MOYEN DE REGLEMENT</h2>
                                        </div>

                                        <textarea class="form-control ckeditor" name="paiementTextarea"
                                            id="paiementTextarea" placeholder="Description du produit"
                                            style="height: 100px"></textarea>

                                    </div>

                                    <div class="mt-5">
                                        <div class="text-center mb-3">
                                            <h2 class="">LIVRAISON</h2>
                                        </div>

                                        <textarea class="form-control ckeditor" name="livraisonTextarea"
                                            id="livraisonTextarea" placeholder="Description du produit"
                                            style="height: 100px"></textarea>

                                    </div>

                                    <div class="mt-5">
                                        <div class="text-center mb-3">
                                            <h2 class="">RETOUR</h2>
                                        </div>

                                        <textarea class="form-control ckeditor" name="retourTextarea"
                                            id="retourTextarea" placeholder="Description du produit"
                                            style="height: 100px"></textarea>

                                    </div>

                                </div>
<script>
    // Supposons que vous ayez une variable contenant le texte des conditions de vente

     var conditionsDeVente = "Conditions de vente<br><br>1. Commandes<br>- Toutes les commandes sont soumises à disponibilité et à l'acceptation de notre part.<br>- Les prix et les spécifications des produits peuvent être sujets à des modifications sans préavis.<br><br>2. Prix et paiement<br>- Les prix indiqués sont en dollars américains et ne comprennent pas les taxes applicables et les frais de livraison.<br>- Le paiement doit être effectué intégralement avant l'expédition de la commande.<br>- Nous acceptons les paiements par carte de crédit, virement bancaire ou tout autre mode de paiement spécifié.<br><br>3. Livraison<br>- Les délais de livraison estimés sont fournis à titre indicatif uniquement et ne sont pas garantis.<br>- Les frais de livraison sont calculés en fonction du poids, de la taille et de la destination de la commande.<br>- Les risques de perte ou de dommage des produits sont transférés à l'acheteur au moment de la livraison.<br><br>4. Retours et remboursements<br>- Les retours sont acceptés dans un délai de 30 jours à compter de la réception de la commande, sous certaines conditions.<br>- Les produits retournés doivent être dans leur état d'origine, non utilisés et accompagnés de tous les accessoires et emballages d'origine.<br>- Les remboursements seront effectués selon le mode de paiement utilisé lors de l'achat initial, après réception et inspection des produits retournés.<br><br>5. Responsabilité<br>- Nous déclinons toute responsabilité en cas de dommages directs, indirects, accidentels ou consécutifs résultant de l'utilisation de nos produits.<br>- L'acheteur est responsable de l'utilisation appropriée des produits conformément aux instructions fournies.<br><br>6. Confidentialité<br>- Toutes les informations personnelles fournies par l'acheteur seront traitées conformément à notre politique de confidentialité.<br><br>Veuillez lire attentivement ces conditions de vente avant de passer votre commande. En effectuant votre achat, vous acceptez pleinement et sans réserve toutes les conditions énoncées ci-dessus.";
     var guarantie = "Conditions de garantie<br><br>1. Durée de la garantie<br>- Nos produits sont couverts par une garantie limitée d'une durée de [durée de la garantie] à compter de la date d'achat.<br>- Veuillez consulter la documentation du produit ou contacter notre service clientèle pour connaître la durée spécifique de garantie de votre produit.<br><br>2. Couverture de la garantie<br>- La garantie couvre les défauts de fabrication et les problèmes liés aux matériaux utilisés.<br>- Elle ne couvre pas les dommages causés par une mauvaise utilisation, une utilisation abusive, une négligence ou une modification non autorisée du produit.<br><br>3. Processus de réclamation<br>- En cas de problème couvert par la garantie, veuillez nous contacter pour obtenir un numéro de réclamation et des instructions détaillées.<br>- Les frais d'expédition pour le retour du produit sont à la charge de l'acheteur, sauf indication contraire.<br><br>Veuillez noter que des conditions spécifiques peuvent s'appliquer à certains produits ou catégories de produits. Veuillez consulter la documentation du produit ou contacter notre service clientèle pour plus d'informations sur les conditions de garantie.";
     var paiement = "Conditions de moyen de reglement<br><br>1. Virement bancaire<br>- Les paiements par virement bancaire doivent être effectués en utilisant les informations bancaires fournies lors de la passation de commande.<br>- Veuillez indiquer votre numéro de commande dans la description du virement pour faciliter l'identification et le traitement de votre paiement.<br>- Votre commande sera traitée une fois que le paiement aura été confirmé et crédité sur notre compte bancaire.<br><br>2. Paiement en espèces (pour les sommes inférieures à 250 000 fr)<br>- Nous acceptons les paiements en espèces pour les montants inférieurs à 250 000 francs.<br>- Veuillez effectuer le paiement en espèces lors de la livraison de votre commande.<br>- Notre représentant vous fournira un reçu de paiement en espèces.<br><br>Veuillez noter que des frais de transaction peuvent s'appliquer pour certains modes de paiement. Veuillez vérifier auprès de votre institution financière ou de votre fournisseur de services de paiement pour plus d'informations sur les éventuels frais supplémentaires.";
     var livraison = "Conditions de livraison<br><br>1. Modes de livraison<br>- Nous proposons plusieurs options de livraison, y compris la livraison standard, la livraison express et la livraison en magasin.<br>- Veuillez sélectionner le mode de livraison souhaité lors de la passation de commande.<br><br>2. Délais de livraison<br>- Les délais de livraison estimés sont fournis à titre indicatif seulement et peuvent varier en fonction de la destination et du mode de livraison choisi.<br>- Nous mettrons tout en œuvre pour livrer votre commande dans les délais les plus courts possibles.<br><br>3. Frais de livraison<br>- Les frais de livraison sont calculés en fonction du poids, de la taille et de la destination de la commande.<br>- Les frais de livraison seront indiqués lors du processus de commande et ajoutés au montant total de votre commande.<br><br>Veuillez noter que des conditions spécifiques peuvent s'appliquer à certains produits ou destinations de livraison. Veuillez consulter les informations détaillées lors de la passation de commande ou contactez notre service clientèle pour plus d'informations.";
     var retour = "Conditions de retour<br><br>1. Politique de retour<br>- Les retours sont acceptés dans un délai de 30 jours à compter de la réception de la commande.<br>- Veuillez nous contacter pour obtenir un numéro de retour et des instructions détaillées avant de renvoyer les produits.<br><br>2. État des produits<br>- Les produits retournés doivent être dans leur état d'origine, non utilisés et accompagnés de tous les accessoires et emballages d'origine.<br>- Nous nous réservons le droit de refuser les retours de produits endommagés ou altérés.<br><br>3. Remboursements<br>- Les remboursements seront effectués selon le mode de paiement original utilisé lors de l'achat initial.<br>- Le remboursement sera émis après réception et inspection des produits retournés.<br><br>4. Frais de retour<br>- Les frais de retour sont à la charge de l'acheteur, sauf en cas de produit défectueux ou d'erreur de notre part.<br>- Veuillez conserver une preuve d'envoi lors du retour des produits.<br><br>Veuillez noter que des conditions spécifiques peuvent s'appliquer à certains types de produits. Veuillez consulter les informations détaillées lors de la passation de commande ou contactez notre service clientèle pour plus d'informations.";

// Recherchez l'élément textarea dans le DOM
var textarea = document.getElementById("conditionsTextarea");
var textarea1 = document.getElementById("garantieTextarea");
var textarea2 = document.getElementById("paiementTextarea");
var textarea3 = document.getElementById("livraisonTextarea");
var textarea4 = document.getElementById("retourTextarea");

// Définissez la valeur du textarea avec le texte des conditions de vente
textarea.value = conditionsDeVente;
textarea1.value = guarantie;
textarea2.value = paiement;
textarea3.value = livraison;
textarea4.value = retour;
</script>
