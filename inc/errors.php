<?php
require_once 'dbconn.php';
  if (isset($_SESSION['errors']))
  {
    foreach($_SESSION['errors'] as $error){?>
    <alert class="alert alert-danger"><?=$error; ?></alert>
<?php
    }
    unset($_SESSION['errors']);
  }


?>