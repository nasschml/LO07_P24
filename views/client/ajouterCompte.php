<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page d'ajout de compte -->
<div class="container">
    <h1 class="mt-4">Ajouter un Compte</h1>

    <!-- Formulaire pour ajouter un nouveau compte -->
    <form action="<?= BASE_URL ?>index.php?controller=client&action=ajouterCompte" method="POST">
        <!-- Champ pour le label du compte -->
        <div class="form-group">
            <label for="label">Label:</label>
            <input type="text" id="label" name="label" class="form-control" required>
        </div>
        
        <!-- Champ pour le montant initial du compte -->
        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="number" id="montant" name="montant" class="form-control" step="0.01" required>
        </div>
        
        <!-- Champ pour sélectionner la banque associée au compte -->
        <div class="form-group">
            <label for="banque_id">Banque:</label>
            <select id="banque_id" name="banque_id" class="form-control" required>
                <!-- Boucle pour afficher les options des banques disponibles -->
                <?php foreach ($banques as $banque): ?>
                    <option value="<?= $banque['id'] ?>"><?= $banque['label'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Bouton pour soumettre le formulaire -->
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
