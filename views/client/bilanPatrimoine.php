<?php include __DIR__ . '/../common/header.php'; ?>

<!-- Conteneur principal pour la page de bilan du patrimoine -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Bilan de mon patrimoine</h1>
        </div>
        <div class="card-body">
            <!-- Section pour les comptes -->
            <h2 class="mb-3">Comptes</h2>
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Montant</th>
                        <th>Banque</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle pour afficher les comptes de l'utilisateur -->
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

            <!-- Section pour les résidences -->
            <h2 class="mt-4 mb-3">Résidences</h2>
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Ville</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle pour afficher les résidences de l'utilisateur -->
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
        <div class="card-footer">
            <!-- Affichage des valeurs totales -->
            <h3>Valeur totale des comptes : <?= number_format($totalComptes, 2) ?> €</h3>
            <h3>Valeur totale des résidences : <?= number_format($totalResidences, 2) ?> €</h3>
            <h3>Valeur totale du patrimoine : <?= number_format($totalPatrimoine, 2) ?> €</h3>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
