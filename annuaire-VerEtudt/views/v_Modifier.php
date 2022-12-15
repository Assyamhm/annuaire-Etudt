<form action=index.php?uc=gerer&action=afficherModifier method="post">

<div class="p-5 mb4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Modifier un membre</h1>
            <select name="id" class="form-select" aria-label="default select example">

  
 <?php 
 foreach ($les_membres as $membre):?>
        <option value='<?php echo $membre['id'];?>'>
   
        <?php echo $membre['nom'];?>
        <?php echo $membre['prenom'];?>
        </option>
 <?php endforeach ?>

 
 </select>

<button type="submit" class="btn btn-primary">Valider</button>
</form>
</div>
</div>