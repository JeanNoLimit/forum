
<div class="formContainerCat">
    <div class="title">
        <h1>Nouvelle catégorie</h1>
    </div>


    <div id="borderContainer">

    <form action="index.php?ctrl=forum&action=newCategory" method="post" class="formTopicAndCat">

            <div>
                <label for="categoryName"> Titre de la nouvelle catégorie 
                    <input type="text" name="categoryName" id="categoryName" class="inputField newTitle">
                </label>
            </div>

                <input type="submit" value="Envoyer" name="submitNewCategory" class="submitButton">
            
        </form>
    </div>
</div>