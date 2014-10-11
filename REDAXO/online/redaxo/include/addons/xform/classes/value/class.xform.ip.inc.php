<?php

class rex_xform_ip extends rex_xform_abstract
{

  function enterObject()
  {
    $sk = "REMOTE_ADDR";
    if ($this->getElement(3) != "") $sk = $this->getElement(3);

    $this->setValue($_SERVER[$sk]);

    $this->params["value_pool"]["email"][$this->getName()] = stripslashes($this->getValue());
    if ($this->getElement(2) != "no_db") $this->params["value_pool"]["sql"][$this->getName()] = $this->getValue();
  }

  function getDescription()
  {
    return "ip -> Beispiel: ip|label|[no_db]";
  }
}

?>