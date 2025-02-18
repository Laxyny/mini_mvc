<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Entity\Comment;

class CommentController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        $this->add();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function add()
    {
        if (!isset($_SESSION['user'])) {
            throw new \Exception("Vous devez être connecté pour ajouter un commentaire");
        }

        if (isset($_POST['addComment'])) {
            $commentRepository = new CommentRepository();
            $comment = new Comment();

            $comment->setComment($_POST['comment']);
            $comment->setUserId($_SESSION['user']['id']);
            $comment->setArticleId((int)$_GET['article_id']);

            $commentRepository->persist($comment);

            header('location: index.php?controller=article&action=show&id=' . $_GET['article_id']);
        }
    }
}
