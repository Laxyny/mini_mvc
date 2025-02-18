<?php require_once _TEMPLATEPATH_ . '/header.php'; ?>

<h1><?= $pageTitle; ?></h1>

<?php if (!empty($articles)) { ?>
    <ul>
        <?php foreach ($articles as $article) { ?>
            <li>
                <h2><?= $article->getTitle(); ?></h2>
                <a href="index.php?controller=article&action=show&id=<?= $article->getId(); ?>">Lire plus</a>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>Aucun article trouvé.</p>
<?php } ?>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>