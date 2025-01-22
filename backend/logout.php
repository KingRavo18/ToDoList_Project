<?php
session_start();
session_unset();
session_destroy();
header("Location: ../public/Registration/index.php");
exit(); 