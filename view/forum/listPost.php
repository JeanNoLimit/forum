<?php
$posts = $result["data"]["posts"];
$topic = $result["data"]["topic"];
// Alternative possible en utilisant la fonction current()
// $topicName = $posts->current()->getTopic()->getTitle();
$topicName=$topic->getTitle();
echo $topicName;
?>

<h1>Liste des posts</h1>



<?php
foreach($posts as $post){ ?>
    <p><?=$post->getUser()->getPseudo()?></p>
    <p><?=$post->getUser()->getinscriptionDate()?></p>

    <h3><?=$post->getTopic()->getTitle()?></h3>
    <p><?=$post->getText()?></p>
    <p><?=$post->getCreationDate()->format(" d m Y")?></p>

<?php } ?>

