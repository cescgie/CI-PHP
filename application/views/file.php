
  <h1>Adserverdaten</h1>
  <?php 
  //CA Information
  if (!sizeof($data['sum_cf'])) {
      echo 
      '<div class="alert alert-info">No CF Data.</div>';
  }else{
          foreach ($data['sum_cf'] as $sum){
             echo 
            '<p>CF :<span class="cf"> ' .$sum->sum_cf. ' </span>Eintraege</p>';
          }
  } 

  //GA Information
  if (!sizeof($data['sum_ga'])) {
      echo 
      '<div class="alert alert-info">No GA Data.</div>';
  }else{
          foreach ($data['sum_ga'] as $sum){
             echo 
            '<p>GA :<span class="ga"> ' .$sum->sum_ga. ' </span>Eintraege</p>';
          }
  } 

  //GL Information
  if (!sizeof($data['sum_gl'])) {
      echo 
      '<div class="alert alert-info">No GL Data.</div>';
  }else{
          foreach ($data['sum_gl'] as $sum){
             echo 
            '<p>GL :<span class="gl"> ' .$sum->sum_gl. ' </span>Eintraege</p>';
          }
  } 

  //IR Information
  if (!sizeof($data['sum_ir'])) {
      echo 
      '<div class="alert alert-info">No IR Data.</div>';
  }else{
          foreach ($data['sum_ir'] as $sum){
             echo 
            '<p>IR :<span class="ir"> ' .$sum->sum_ir. ' </span>Eintraege</p>';
          }
  }

  //KV Information
  if (!sizeof($data['sum_kv'])) {
      echo 
      '<div class="alert alert-info">No KV Data.</div>';
  }else{
          foreach ($data['sum_kv'] as $sum){
             echo 
            '<p>KV :<span class="kv"> ' .$sum->sum_kv. ' </span>Eintraege</p>';
          }
  }

  //KW Information
  if (!sizeof($data['sum_kw'])) {
      echo 
      '<div class="alert alert-info">No KW Data.</div>';
  }else{
          foreach ($data['sum_kw'] as $sum){
             echo 
            '<p>KW :<span class="kw"> ' .$sum->sum_kw. ' </span>Eintraege</p>';
          }
  }

  //TC Information
  if (!sizeof($data['sum_tc'])) {
      echo 
      '<div class="alert alert-info">No TC Data.</div>';
  }else{
          foreach ($data['sum_tc'] as $sum){
             echo 
            '<p>TC :<span class="tc"> ' .$sum->sum_tc. ' </span>Eintraege</p>';
          }
  }
  ?>
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
   <script type="text/javascript">
      var i = 0;
     var timeOutId = 0;
     var ajaxfn = function() {
        $.ajax({ url: '/CI-PHP/connect/',
           type: 'get',
           success: function(output) {
              var table = output.split("-");
              $(".cf").html("<span style='color: #ff0000'> " +table[0]+" </span>");
              $(".ga").html("<span style='color: #ff0000'> " +table[1]+" </span>");
              $(".gl").html("<span style='color: #ff0000'> " +table[2]+" </span>");
              $(".ir").html("<span style='color: #ff0000'> " +table[3]+" </span>");
              $(".kv").html("<span style='color: #ff0000'> " +table[4]+" </span>");
              $(".kw").html("<span style='color: #ff0000'> " +table[5]+" </span>");
              $(".tc").html("<span style='color: #ff0000'> " +table[6]+" </span>");
              
              console.log(output);
              console.log("done"+i++);
              //location.reload();
              timeOutId = setTimeout(ajaxfn, 5000);
             }
          });
      }
      ajaxfn(); // seconds
      timeOutId = setTimeout(ajaxfn, 5000);
      //location.reload();
    </script>
  </body>
</html>