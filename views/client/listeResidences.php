<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page de gestion des résidences -->
<div class="container">
    <h1 class="mt-4">Mes Résidences</h1>

    <!-- Table pour afficher les résidences de l'utilisateur -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Label</th>
                <th>Ville</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher chaque résidence de l'utilisateur -->
            <?php foreach ($residences as $residence): ?>
                <tr>
                    <td><?= $residence['id'] ?></td>
                    <td><?= $residence['label'] ?></td>
                    <td><?= $residence['ville'] ?></td>
                    <td><?= number_format($residence['prix'], 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
