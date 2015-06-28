
<?php
$password = "boubou";
$cryptPassword = password_hash($password, PASSWORD_DEFAULT);
$verify = password_verify("boubou", $cryptPassword);
var_dump($verify); // Returns bool(true)

?>
