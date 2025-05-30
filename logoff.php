<?php

session_start();
unset($_SESSION['admin']);
unset($_SESSION['admpass']);
unset($_SESSION['apoteose']);
unset($_SESSION['email']);
unset($_SESSION['senha']);
unset($_SESSION['logado']);
echo "<script>alert('Até breve!'); window.location.href='index.php'</script>";