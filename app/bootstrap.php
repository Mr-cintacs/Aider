<?php
  // Load Config
  require_once 'config/config.php';
  require_once 'helpers/func_redirect.php';
  require_once 'helpers/func_session_helper.php';
  require_once 'helpers/text_funcs.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
