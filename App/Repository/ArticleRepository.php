<?php

namespace App\Repository;

use App\Entity\Article;
use App\Db\Mysql;
use App\Tools\StringTools;

class ArticleRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM article WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $article = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($article) {
            return Article::createAndHydrate($article);;
        } else {
            return false;
        }
    }
    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM article");
        $query->execute();
        $articles = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $articlesObjects = [];
        foreach ($articles as $article) {
            $articlesObjects[] = Article::createAndHydrate($article);;
        }
        return $articlesObjects;
    }
    public function findOneByTitle(string $title)
    {
        $query = $this->pdo->prepare("SELECT * FROM article WHERE title = :title");
        $query->bindParam(':title', $title, $this->pdo::PARAM_STR);
        $query->execute();
        $article = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($article) {
            return Article::createAndHydrate($article);;
        } else {
            return false;
        }
    }

    public function persist(Article $article)
    {
        if ($article->getId() !== null) {
            $query = $this->pdo->prepare('UPDATE article SET title = :title, description = :description WHERE id = :id');
            $query->bindValue(':id', $article->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare('INSERT INTO article (title, description) VALUES (:title, :description)');

            $query->bindValue(':title', $article->getTitle(), $this->pdo::PARAM_STR);
            $query->bindValue(':description', $article->getDescription(), $this->pdo::PARAM_STR);

            return $query->execute();
        }
    }
}
