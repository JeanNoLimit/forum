<?php

$topics = $result["data"]['topics'];
//    var_dump($topics->current());die; 
?>

<div id="generalContainer">

    <div class="button newList">
        <a href="index.php?ctrl=forum&action=newTopic">Nouveau Sujet</a>
    </div>

    <div class="title">
        <h1>liste des sujets</h1>
    </div>

    <?php
    if(!empty($topics)){
        
        foreach($topics as $topic ){
    
            ?>
            <div class="listContainer">
                <div class="leftListContainer">
                    <div class="TitleAndCategory">
                        <h2><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></h2> 
                        <p>&nbsp- <?=$topic->getCategory()->getCategoryName() ?></p>
                        
                    </div>
                    <div class="additionnalContent">
                        <p >date de création : le <?=$topic->getCreationDate()->format("d-m-Y à H:i")?> - </p>
                        <p><a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$topic->getId()?>">Supprimer </a></p>
                    </div>
                </div>
                <div class="rightListContainer">
                    <p>par <span class="user"><?=$topic->getUser()->getPseudo()?></span></p>
                    <p>Nombre de posts : <?=$topic->getNbPosts() ?></p>
                </div>
            </div>
            <?php
        } 

    }else {?>
        <div class="listContainer">
            <p>aucun topic créé pour le moment...</p>
        </div>
    <?php } ?>
</div>


  
