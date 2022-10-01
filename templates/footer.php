<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/js.js"></script>
<script src="https://kit.fontawesome.com/56b1221043.js" crossorigin="anonymous"></script>
</body>
</html>
