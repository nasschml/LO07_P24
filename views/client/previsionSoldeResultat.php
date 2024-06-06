<?php include __DIR__ . '/../common/header.php'; ?>

<div class="container">
    <h1 class="mt-4">Prévision de Solde - Résultat</h1>
    <p>Date possible pour acheter la résidence : <?= $dateAchatPossible->format('d-m-Y') ?></p>
    
    <?php if ($suggestLoan): ?>
        <div class="alert alert-warning">
            La date d'achat possible est trop éloignée. Nous vous recommandons de considérer la possibilité de faire un prêt bancaire pour accélérer l'achat de votre résidence.
        </div>
    <?php endif; ?>
    
    <a href="<?= BASE_URL ?>index.php?controller=client&action=previsionSolde" class="btn btn-primary">Retour</a>
</div>

<?php include __DIR__ . '/../common/footer.php'; ?>
