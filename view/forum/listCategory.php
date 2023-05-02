<?php
$categories = $result["data"]["categories"];

?>
<div id="generalContainer">

    <div class="button newList">
        <a href="index.php?ctrl=forum&action=newCategory">Nouvelle catégorie</a>
    </div>
    <div id="title">
        <h1>Liste des catégories</h1>
    </div>

    <?php foreach ($categories as $category){ ?>

        <div class="listContainer">
            <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?=$category->getId() ?>"><?=$category->getCategoryName() ?></a></p>
    </div>

    <?php } ?>

</div>