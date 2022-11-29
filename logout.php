<?php
  require_once __DIR__ . "/autoload.php";

  session_unset();
  session_destroy();

  header("location: " . base_url());
  
?>