	<?php 
  //CA Information
  if (!sizeof($data['sum_cf'])) {
      echo 
      '<div class="alert alert-info">No Cf Data.</div>';
  }else{
      echo
      '<div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">CF</div>';
          foreach ($data['sum_cf'] as $sum){
             echo 
            '<p>'.$sum->sum_cf. ' Records</p>';
          }
      echo
      '</div> <!-- panel panel-default -->'; 
  } 
  ?>