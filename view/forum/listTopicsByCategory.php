<?php
    $topics=$result["data"]["topics"];
    $categorie=$result["data"]["category"];
?>

<h1>Liste des sujets de la catégorie <?=$categorie->getCategoryName()?> </h1>

<?php
// Vérifier la présence de topics dans la catégorie pour éviter l'affichage d'un message d'erreur (si $topics=null)
if(!empty($topics)){
    foreach($topics as $topic ){

        ?>
        <p> <a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>"><?=$topic->getTitle()?></a> - <?=$topic->getCategory()->getCategoryName() ?></p>
        <p><?=$topic->getCreationDate()->format("D M Y")?></p>
        <p><?=$topic->getUser()->getPseudo()?></p>
        <?php
    }
}else{ ?>
    <p>Catégorie vide</p>
<?php } ?>