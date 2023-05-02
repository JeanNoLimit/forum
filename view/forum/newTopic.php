<?php
$categories = $result["data"]["categories"];

?>


<div id="title">
    <h1>Nouveau sujet</h1>
</div>

<div id="borderPost">

   <form action="" method="post">

    <div>
        <label for="titleTopic"> Titre du sujet 
            <input type="text" name="titleTopic" id="titleTopic">
        </label>
    </div>

    <div>
        <label for="category"> Catégorie
            <select name="category_id" id="category">
                <?php foreach($categories as $category) { ?>
                    <option value="<?= $category->getId(); ?>"><?= $category->getCategoryName();?></option>
                <?php } ?>    
            </select>
        </label>
    </div>

    <div>
        <label for="message">Message 
            <textarea name="message" id="message" cols="80" rows="10"></textarea>
        </label>
    </div>

    <div>
        <input type="submit" value="Envoyer" name="submitNewTopic">
    </div>
    





   </form> 




</div>