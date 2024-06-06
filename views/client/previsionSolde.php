<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page de prévision de solde -->
<div class="container">
    <h1 class="mt-4">Prévision de Solde</h1>

    <!-- Affiche un message d'erreur si une erreur est présente -->
    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <!-- Formulaire pour calculer la prévision de solde -->
    <form action="<?= BASE_URL ?>index.php?controller=client&action=previsionSolde" method="POST">
        <!-- Champ pour sélectionner les résidences futures -->
        <div class="form-group">
            <label for="selected_residences">Sélectionner les résidences futures :</label>
            <select id="selected_residences" name="selected_residences[]" class="form-control" multiple>
                <!-- Boucle pour afficher les options des résidences disponibles -->
                <?php foreach ($residences as $residence): ?>
                    <option value="<?= $residence['id'] ?>"><?= $residence['label'] ?> - <?= $residence['ville'] ?> - <?= number_format($residence['prix'], 2) ?> €</option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Champ pour les économies mensuelles -->
        <div class="form-group">
            <label for="monthly_savings">Économies mensuelles :</label>
            <input type="number" id="monthly_savings" name="monthly_savings" class="form-control" step="0.01" required>
        </div>

        <!-- Champ pour le salaire mensuel -->
        <div class="form-group">
            <label for="monthly_salary">Salaire mensuel :</label>
            <input type="number" id="monthly_salary" name="monthly_salary" class="form-control" step="0.01" required>
        </div>

        <!-- Bouton pour soumettre le formulaire et calculer la prévision -->
        <button type="submit" class="btn btn-primary">Calculer Prévision</button>
    </form>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
