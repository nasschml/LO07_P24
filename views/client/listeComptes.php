<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page de gestion des comptes -->
<div class="container">
    <h1 class="mt-4">Mes Comptes</h1>

    <!-- Table pour afficher les comptes de l'utilisateur -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Label</th>
                <th>Montant</th>
                <th>Banque</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher chaque compte de l'utilisateur -->
            <?php foreach ($comptes as $compte): ?>
                <tr>
                    <td><?= $compte['id'] ?></td>
                    <td><?= $compte['label'] ?></td>
                    <td><?= number_format($compte['montant'], 2) ?> €</td>
                    <td><?= $compte['banque_label'] ?? 'Non spécifié' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
