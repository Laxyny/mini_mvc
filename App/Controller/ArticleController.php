<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;

class ArticleController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
                        break;
                    case 'show':
                        $this->show();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
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

    protected function list()
    {
        try {
            $articleRepository = new ArticleRepository();
            $articles = $articleRepository->findAll();

            $this->render('article/list', [
                'articles' => $articles,
                'pageTitle' => 'Liste des articles'
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function show()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new \Exception("ID de l'article non fourni");
            }

            $articleRepository = new ArticleRepository();
            $article = $articleRepository->findOneById((int)$_GET['id']);

            $commentRepository = new CommentRepository();
            $comments = $commentRepository->findByArticleId((int)$_GET['id']);

            if (!$article) {
                throw new \Exception("Article non trouvé");
            }

            $this->render('article/show', [
                'article' => $article,
                'comments' => $comments,
                'pageTitle' => $article->getTitle()
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
