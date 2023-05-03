<?php
    $topics=$result["data"]["topics"];
    $categorie=$result["data"]["category"];
?>

<div id="generalContainer">
    <div id="title">
        <h1>Liste des sujets de la catégorie <?=$categorie->getCategoryName()?> </h1>
    </div>


    <?php
    // Vérifier la présence de topics dans la catégorie pour éviter l'affichage d'un message d'erreur (si $topics=null)
    if(!empty($topics)){
        foreach($topics as $topic ){

            ?>
            <div class="listContainer">
                <div class="leftTopicContainer">
                    <div class="TitleAndCategory">
                        <h2> <a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></h2>
                    </div> 
                    <div class="additionnalContent">
                        <p >date de création : le <?=$topic->getCreationDate()->format("d-m-Y à h:i")?> - </p>
                        <p><a href="index.php?ctrl=forum&action=index&deleteTopic&id=<?=$topic->getId()?>">Supprimer</a></p>
                    </div>
                </div>
                <div class="rightTopicContainer">
                <p>par <span class="user"><?=$topic->getUser()->getPseudo()?></span></p>
                </div>
        </div>

    <?php }
    }else{ ?>
        <div class="listContainer">
            <p>Catégorie vide</p>
        </div>
    <?php } ?>

</div>