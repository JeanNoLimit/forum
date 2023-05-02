<?php

$topics = $result["data"]['topics'];
    
?>

<div id="generalContainer">

    <div class="button newList">
        <a href="index.php?ctrl=forum&action=newTopic">Nouveau Sujet</a>
    </div>

    <div id="title">
        <h1>liste des topics</h1>
    </div>

    <?php
    foreach($topics as $topic ){

        ?>
        <div class="listContainer">
            <div class="leftTopicContainer">
                <div class="TitleAndCategory">
                    <h2><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a></h2> 
                    <p>&nbsp- <?=$topic->getCategory()->getCategoryName() ?></p>
                </div>
                <div class="additionnalContent">
                    <p >date de création : le<?=$topic->getCreationDate()->format("d-m-Y à h:i")?> - </p>
                    <p><a href="index.php?ctrl=forum&action=index&deleteTopic&id=<?=$topic->getId()?>">Supprimer</a></p>
                </div>
            </div>
            <div class="rightTopicContainer">
                <p>par <span class="user"><?=$topic->getUser()->getPseudo()?></span></p>
            </div>
        </div>
        <?php
    } ?>
</div>


  
