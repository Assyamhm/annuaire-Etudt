<form action=index.php?uc=gerer&action=ValiderSupprimer method="post">

<div class="p-5 mb4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Suprimer un membre</h1>
            <select name="SUPMEM" class="form-select" aria-label="default select example">

  
 <?php 
 foreach ($les_membres as $membre):?>
 <option value="<?php echo $membre['id'];?>"><?php echo $membre['nom']." ".$membre['prenom'];?></option>
 <?php endforeach ?>

 
 </select>
<button type="submit" class="btn btn-primary">Supprimer</button>
</form>
</div>
</div>