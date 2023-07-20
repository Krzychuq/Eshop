
<?php
echo "<h1 style=text-align:center;>".date("d-m-Y H:i:s")."</h1><br>";

?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style>
    html {
  display: flex;
  align-items: center;
  justify-content: center;
}


</style>
<div class="podobne_produkty">
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>
<div class="ui-card"></div>

</div>
<script>
    $num = $('.ui-card').length;
$even = $num / 2;
$odd = ($num + 1) / 2;

if ($num % 2 == 0) {
  $('.ui-card:nth-child(' + $even + ')').addClass('active');
  $('.ui-card:nth-child(' + $even + ')').prev().addClass('prev');
  $('.ui-card:nth-child(' + $even + ')').next().addClass('next');
} else {
  $('.ui-card:nth-child(' + $odd + ')').addClass('active');
  $('.ui-card:nth-child(' + $odd + ')').prev().addClass('prev');
  $('.ui-card:nth-child(' + $odd + ')').next().addClass('next');
}

$('.ui-card').click(function() {
  $slide = $('.active').width();
  console.log($('.active').position().left);
  
  if ($(this).hasClass('next')) {
    $('.podobne_produkty').stop(false, true).animate({left: '-=' + $slide});
  } else if ($(this).hasClass('prev')) {
    $('.podobne_produkty').stop(false, true).animate({left: '+=' + $slide});
  }
  
  $(this).removeClass('prev next');
  $(this).siblings().removeClass('prev active next');
  
  $(this).addClass('active');
  $(this).prev().addClass('prev');
  $(this).next().addClass('next');
});


// Keyboard nav
$('html body').keydown(function(e) {
  if (e.keyCode == 37) { // left
    $('.active').prev().trigger('click');
  }
  else if (e.keyCode == 39) { // right
    $('.active').next().trigger('click');
  }
});
</script>