<form action=index.php?uc=gerer&action=ValiderModifier method="post">

<div class="mb-3">

    <label for="usernamebox" class="form-label">Nom</label>
    <input type="Text" class="form-control" id="usernamebox" name="nom" value="<?php echo $leMembre['nom'] ?>" required>
    <div id="emailHelp" class="form-text">
    </div>

</div>

<div class="mb-3">

    <label for="prenom" class="form-label">Prenom</label>
    <input type="Text" class="form-control" id="prenom" name="prenom" value="<?php echo $leMembre['prenom'] ?>" required >

</div>
<button type="submit" class="btn btn-primary">Modifier</button>
</form>
</div>
</div>