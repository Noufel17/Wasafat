<?php
require_once('./controllers/MessagesController.php');
require_once('./views/Components.php');
require_once('./views/GlobalView.php');
class MessagesView extends GlobalView
{
    public function content()
    {
        $controller = new MessagesController();
        $messages = $controller->getAllMessages();
        $this->messages($messages);
    }

    public function messages($messages){
        ?>
<center class="my-4">
    <a href="./acceuil" class="action-btn" style="test-decoration:none">
        Retour
    </a>
</center>
<div card>
    <div class="card mx-auto mb-4" style="width:90%">
        <div class=" card-header d-flex flex-row justify-content-between align-items-center">
            Messages des utilisateurs
        </div>
        <div class="card-body">
            <table data-search="true" data-toggle="table" class="table-style">
                <thead>
                    <tr>
                        <th data-sortable="true">nom</th>
                        <th data-sortable="true">prenom</th>
                        <th data-sortable="true">email</th>
                        <th data-sortable="true">téléphone</th>
                        <th data-sortable="true">message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($messages as $message){
                        ?>
                    <tr>
                        <td><?php echo $message["nom"]?></td>
                        <td><?php echo $message["prenom"]?></td>
                        <td><?php echo $message["email"]?></td>
                        <td><?php echo "0".$message["telephone"]?></td>
                        <td><?php echo $message["message"]?></td>
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
    public function afficherMessages()
    {
        $this->head();
        $this->header();
        $this->content();
    }
}