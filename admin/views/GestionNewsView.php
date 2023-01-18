<?php
require_once('./controllers/GestionNewsController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class GestionNewsView extends GlobalView
{
    public function content()
    {
        $controller = new GestionNewsController();
        $news = $controller->getAllNews();
        $this->news($news);
    }

    public function news($news){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Gestion des news
            <a href="./ajouter-news" class="action-btn" style="test-decoration:none">
                Ajouter une news
            </a>
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">titre news</th>
                        <th data-sortable="true">corps</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($news as $new){
                        ?>
                    <tr>
                        <td><?php echo $new["titre"] ?></td>
                        <td><?php echo  str_replace("$"," ",substr($new["corps"], 0, 300) . "...") ?></td>
                        <td>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <a href="<?php echo "./news?idNews=".$new["idNews"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="voir détaills">
                                    <i class="fa-sharp fa-solid fa-eye color m-auto"></i>
                                </a>
                                <a href="<?php echo "./modifier-news?idNews=".$new["idNews"] ?>"
                                    style="text-decoration: none;padding:1px 6px;" data-toggle="tooltip"
                                    data-placement="bottom" title="modifier news">
                                    <i class="fa-solid fa-pen-to-square color m-auto"></i>
                                </a>
                                <form action="./redirect.php" method="post" class="mb-0">
                                    <input type="hidden" name="idNews" value="<?php echo $new["idNews"] ?>">
                                    <button type="submit" name="supprimer-news" class="btn-d-none" data-toggle="tooltip"
                                        data-placement="bottom" title="supprimer news">
                                        <i class="fa-solid fa-trash color m-auto"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
    }
    public function afficherGestionNews()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}