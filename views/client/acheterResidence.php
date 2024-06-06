<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page d'achat d'une résidence -->
<div class="container">
    <h1 class="mt-4">Achat d'une Résidence</h1>

    <!-- Affiche un message d'erreur si une erreur est présente -->
    <?php if (isset($erreur) && !empty($erreur)): ?>
        <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>

    <!-- Formulaire pour acheter une résidence -->
    <form action="<?= BASE_URL ?>index.php?controller=client&action=acheterResidence" method="POST">
        <div class="form-group">
            <label for="residence_id">Résidence:</label>
            <!-- Sélection des résidences disponibles -->
            <select id="residence_id" name="residence_id" class="form-control" required>
                <?php foreach ($residences as $residence): ?>
                    <option value="<?= $residence['id'] ?>" data-prix="<?= $residence['prix'] ?>" data-vendeur="<?= $residence['vendeur'] ?>" data-compte-vendeur="<?= $residence['compte_vendeur_id'] ?>">
                        <?= $residence['label'] ?> - <?= $residence['ville'] ?> - <?= $residence['prix'] ?> € (Vendeur: <?= $residence['vendeur'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="compte_acheteur">Compte Acheteur:</label>
            <!-- Sélection des comptes acheteur disponibles -->
            <select id="compte_acheteur" name="compte_acheteur" class="form-control" required>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?= $compte['id'] ?>"><?= $compte['label'] ?> (<?= number_format($compte['montant'], 2) ?> €)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Champ caché pour le compte vendeur -->
        <input type="hidden" id="compte_vendeur" name="compte_vendeur">
        <div class="form-group">
            <label for="prix">Prix:</label>
            <!-- Champ pour afficher le prix, non modifiable -->
            <input type="number" id="prix" name="prix" class="form-control" readonly>
        </div>
        <!-- Champ caché pour l'ID du vendeur -->
        <input type="hidden" id="vendeur_id" name="vendeur_id">
        <button type="submit" class="btn btn-primary">Acheter</button>
    </form>
</div>

<!-- Script pour gérer la mise à jour dynamique des champs en fonction de la sélection de la résidence -->
<script>
    // Ajoute un écouteur d'événements pour changer la sélection de la résidence
    document.getElementById('residence_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        // Met à jour les champs en fonction des attributs de la résidence sélectionnée
        document.getElementById('prix').value = selectedOption.getAttribute('data-prix');
        document.getElementById('vendeur_id').value = selectedOption.getAttribute('data-vendeur');
        document.getElementById('compte_vendeur').value = selectedOption.getAttribute('data-compte-vendeur');
    });

    // Initialiser les valeurs pour la première option sélectionnée par défaut
    var initialOption = document.getElementById('residence_id').options[document.getElementById('residence_id').selectedIndex];
    document.getElementById('prix').value = initialOption.getAttribute('data-prix');
    document.getElementById('vendeur_id').value = initialOption.getAttribute('data-vendeur');
    document.getElementById('compte_vendeur').value = initialOption.getAttribute('data-compte-vendeur');
</script>

<?php include __DIR__ . '/../common/footer.php'; ?>
