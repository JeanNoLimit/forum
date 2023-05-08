<?php
$categories = $result["data"]["categories"];

?>
<div id="generalContainer">

    <div class="button newList">
        <a href="index.php?ctrl=forum&action=newCategory">Nouvelle catégorie</a>
    </div>
    <div class="title">
        <h1>Liste des catégories</h1>
    </div>

    <?php foreach ($categories as $category){ ?>

        <div class="listContainer">
            <div class="leftCategoryList">
                <h2><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?=$category->getId() ?>"><?=$category->getCategoryName() ?></a></h2>
            </div>
            <div class="rightCategoryList">
                <p>Nombre de topics : <?=$category->getNbTopics()?></p>
            </div>
        </div>

    <?php } ?>

</div>