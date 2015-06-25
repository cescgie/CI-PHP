
  <?php 
  //CA Information
  if (!sizeof($data['sum_cf'])) {
      echo 
      '<div class="alert alert-info">No CF Data.</div>';
  }else{
          foreach ($data['sum_cf'] as $sum){
             echo 
            '<p>CF : '.$sum->sum_cf. ' Einträge</p>';
          }
  } 

  //GA Information
  if (!sizeof($data['sum_ga'])) {
      echo 
      '<div class="alert alert-info">No GA Data.</div>';
  }else{
          foreach ($data['sum_ga'] as $sum){
             echo 
            '<p>GA : '.$sum->sum_ga. ' Einträge</p>';
          }
  } 

  //GL Information
  if (!sizeof($data['sum_gl'])) {
      echo 
      '<div class="alert alert-info">No GL Data.</div>';
  }else{
          foreach ($data['sum_gl'] as $sum){
             echo 
            '<p>GL : '.$sum->sum_gl. ' Einträge</p>';
          }
  } 

  //IR Information
  if (!sizeof($data['sum_ir'])) {
      echo 
      '<div class="alert alert-info">No IR Data.</div>';
  }else{
          foreach ($data['sum_ir'] as $sum){
             echo 
            '<p>IR : '.$sum->sum_ir. ' Einträge</p>';
          }
  }

  //KV Information
  if (!sizeof($data['sum_kv'])) {
      echo 
      '<div class="alert alert-info">No KV Data.</div>';
  }else{
          foreach ($data['sum_kv'] as $sum){
             echo 
            '<p>KV : '.$sum->sum_kv. ' Einträge</p>';
          }
  }

  //KW Information
  if (!sizeof($data['sum_kw'])) {
      echo 
      '<div class="alert alert-info">No KW Data.</div>';
  }else{
          foreach ($data['sum_kw'] as $sum){
             echo 
            '<p>KW : '.$sum->sum_kw. ' Einträge</p>';
          }
  }

  //TC Information
  if (!sizeof($data['sum_tc'])) {
      echo 
      '<div class="alert alert-info">No TC Data.</div>';
  }else{
          foreach ($data['sum_tc'] as $sum){
             echo 
            '<p>TC : '.$sum->sum_tc. ' Einträge</p>';
          }
  }
  ?>
  </body>
</html>