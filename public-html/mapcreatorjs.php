<body style="background-color:#d00;">
  <meta charset="utf-8">
  <meta name="description" content="its a simple map creator for 2d maps, also this tool exports data into csv format.">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript,CSV,Map,creator,js">
  <meta name="author" content="dangakun">
<style type="text/css">
@font-face {
    font-family: saxMono;
    src: url(sax.woff);
}

</style>
<?php
$c = 10;
$f = 10;
if ( (isset($_REQUEST['cols'])) && (isset($_REQUEST['fils'])) ){
  $c = $_REQUEST['cols'];
  $f = $_REQUEST['fils'];
  if($c >= 1 && $f >= 1){
  }else{
    $c = 10;
    $f = 10;
  }
}

$w = '25px';
$h = '25px';
$bgcolor = 'white';

echo '<table border="1" cellspacing="0" cellpadding="0">';
for($i=1;$i<=$c;$i++){
  echo "<tr>";
  for($j=1;$j<=$f;$j++){
    echo '<td style="cursor:pointer;background-color:'.$bgcolor.';width:'.$w.';heigth:'.$h.'"><div data-status="0" data-pos="'.$i.$j.'" class="pix" id="'.$i.$j.'" >&nbsp;</div></td>';
  }
  echo "<tr>";
}
echo '</table>';
?>
<br><br>
<form method="get" action="">
<label>Columnas:</label> <input placeholder="10" value="<?=$c?>" type="text" name="cols">
<label>Filas:</label> <input placeholder="10" value="<?=$f?>" type="text" name="fils">
<input type="submit" value="Crear Mapa">
<input type="button" id="generate" value="Generar Mapa CSV">
</form>
<textarea style="padding:15px;font-family:saxMono;font-size: 1em;" id="csv" cols="<?=($c*1.8)?>" rows="<?=($f*1)?>"></textarea>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var ctrlDown = 0;
  $( document ).keydown(function( event ) {
    if ( event.which == 17 ) {
      if(ctrlDown == 1){
        ctrlDown = 0;
        $('body').css('background-color','#d00');
      }else{
        ctrlDown = 1;
        $('body').css('background-color','#0a0');
      }
    }
  });

  function changeStatus(cual){
    if(cual.data('status') == 0){
      cual.css('background-color','black');
      cual.data('status',1);
    }else{
      cual.css('background-color','white');
      cual.data('status',0);
    }
  }

  function generateMapCsv(){
    var elems = $(".pix");
    $('#csv').text('');
     
    $('.pix').each(function(i) {
      var sta = $(this).data('status');
      var pos = $(this).data('pos');
      var valor = $('#csv').text();
      if(sta == 1){
        $('#csv').text(valor+'1,');
      }else{
        $('#csv').text(valor+'0,');
      }
    });
  }

  $('#generate').on('click',function(){
    generateMapCsv();
  });

  $('.pix').on('click',function(){
    changeStatus($(this));
  });

  $('.pix').on('mouseover',function(){
    if(ctrlDown == 1){
      changeStatus($(this));
    }
  });
});
</script>
</body>