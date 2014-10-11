<?php

if(OOAddon::isAvailable('textile'))
{
  // Fliesstext 
  $textile = '';
  if(REX_IS_VALUE[1])
  {
    $textile = htmlspecialchars_decode("REX_VALUE[1]");
    $textile = str_replace("<br />","",$textile);
    $textile = rex_a79_textile($textile);
    $textile = str_replace("###","&#x20;",$textile);
?>
    <div class="contentBlock <?php if ('REX_VALUE[2]'!='') echo 'bgcontainer'; ?>"><?php echo $textile; ?></div>
<?php
  } 
}
else
{
  echo rex_warning('Dieses Modul benÃ¶tigt das "textile" Addon!');
}

?>