<?php if (!empty($chyba) || !empty($_GET['chyba'])):  ?>
   <div class="alert alert-danger">
   oznamovaci oblast admin
   <?php echo htmlspecialchars(!empty($chyba) ? $chyba : $_GET['chyba']); ?>
   </div>
<?php 
  endif; 
  if(!empty($oznameni) || !empty($_GET['oznameni'])):  
?> 
   <div class="alert alert-info">
<?php 
  echo htmlspecialchars(!empty($oznameni)? $oznameni : $_GET['oznameni']);
?>
   </div>
<?php endif;  ?>