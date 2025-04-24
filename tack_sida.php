<style>
body {
	background-color: #1a1a1a;
	color: white;
	text-align: center;
	margin-top: 17vw
}
h1 {
	font-size: 5vw;
}
</style>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');
echo "<h1>Tack för din beställning!</h1>";
echo "<h2>Du skickas snart tillbaka till startsidan...</h2>";
header("refresh:4;url=index.html"); // Omdirigera till startsidan efter 4 sekunder

?>
