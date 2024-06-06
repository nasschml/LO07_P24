<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page de transfert de compte -->
<div class="container">
    <h1 class="mt-4">Transfert de Compte</h1>

    <!-- Formulaire pour effectuer un transfert de compte -->
    <form action="<?= BASE_URL ?>index.php?controller=client&action=transfertCompte" method="POST">
        <!-- Champ pour sélectionner le compte source -->
        <div class="form-group">
            <label for="compte_source">Compte source:</label>
            <select id="compte_source" name="compte_source" class="form-control" required>
                <!-- Boucle pour afficher les options des comptes disponibles -->
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?= $compte['id'] ?>"><?= $compte['label'] ?> - Solde: <?= number_format($compte['montant'], 2) ?> €</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Champ pour sélectionner le compte de destination -->
        <div class="form-group">
            <label for="compte_dest">Compte destination:</label>
            <select id="compte_dest" name="compte_dest" class="form-control" required>
                <!-- Boucle pour afficher les options des comptes disponibles -->
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?= $compte['id'] ?>"><?= $compte['label'] ?> - Solde: <?= number_format($compte['montant'], 2) ?> €</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Champ pour entrer le montant à transférer -->
        <div class="form-group">
            <label for="montant">Montant à transférer:</label>
            <input type="number" id="montant" name="montant" class="form-control" step="0.01" required>
        </div>
        
        <!-- Bouton pour soumettre le formulaire et effectuer le transfert -->
        <button type="submit" class="btn btn-primary">Transférer</button>
    </form>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
