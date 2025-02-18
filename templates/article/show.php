<?php require_once _TEMPLATEPATH_ . '/header.php'; ?>

<h1><?= $pageTitle; ?></h1>

<p><?= $article->getDescription(); ?></p>

<a href="index.php?controller=article&action=list">Retour à la liste</a>

<h2>Commentaires</h2>
<?php if (!empty($comments)) { ?>
    <ul>
        <?php foreach ($comments as $comment) { ?>
            <li><?= $comment->getComment(); ?></li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>Aucun commentaire trouvé.</p>
<?php } ?>

<?php if (isset($_SESSION['user'])) { ?>
    <h3>Ajouter un commentaire</h3>
    <form method="post" action="index.php?controller=comment&action=add&article_id=<?= $article->getId(); ?>">
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment" class="form-control" required></textarea>
        </div>
        <button type="submit" name="addComment" class="btn btn-primary">Ajouter</button>
    </form>
<?php } else { ?>
    <p>Vous devez être connecté pour ajouter un commentaire.</p>
<?php } ?>

<?php require_once _TEMPLATEPATH_ . '/footer.php'; ?>