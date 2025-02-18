# mini MVC
##  Gérer une page listant tous les articles (stockés en bdd)
* Vous devez créer Article.php (entity) en vous basant sur ce qui a été fait dans User.php
* Vous devez créer ArticleRepository.php et à l'intérieur, ajouter une méthode avec une requête pour récupérer tous les articles.
* Vous devez créer ArticleController.php en ajoutant une action list qui appellera le repository et retournera le résultat à la vue.
* Vous devez modifier Controller.php pour gérer le controleur Article
* Vous devez créer la vue dans templates/article/list.php qui affiche uniquement le titre de l'article et un lien "Lire plus"
* Mettre à jour le menu
* On veut ensuite affiche le détail d'un article (quand on clique sur Lire plus")
  * Il faudra créer une action show qui récupère un article et le retourne à la vue