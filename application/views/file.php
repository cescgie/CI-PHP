	<?php 
  //CA Information
  if (!sizeof($data['sum_cf'])) {
      echo 
      '<div class="alert alert-info">No CF Data.</div>';
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

  //GA Information
  if (!sizeof($data['sum_ga'])) {
      echo 
      '<div class="alert alert-info">No GA Data.</div>';
  }else{
      echo
      '<div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">GA</div>';
          foreach ($data['sum_ga'] as $sum){
             echo 
            '<p>'.$sum->sum_ga. ' Records</p>';
          }
      echo
      '</div> <!-- panel panel-default -->'; 
  } 

  //GA Information
  if (!sizeof($data['sum_gl'])) {
      echo 
      '<div class="alert alert-info">No GL Data.</div>';
  }else{
      echo
      '<div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">GL</div>';
          foreach ($data['sum_gl'] as $sum){
             echo 
            '<p>'.$sum->sum_gl. ' Records</p>';
          }
      echo
      '</div> <!-- panel panel-default -->'; 
  } 
  ?>