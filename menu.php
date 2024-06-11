<?php 
	print '
	<ul>
		<li><a href="index.php?menu=1">Početna</a></li>
		<li><a href="index.php?menu=2">Novosti</a></li>
		<li><a href="index.php?menu=3">Kontakti</a></li>
		<li><a href="index.php?menu=4">O nama</a></li>
		<li><a href="index.php?menu=10">Naši psi</a></li>
		<li><a href="index.php?menu=8">Galerija</a></li>
		<li><a href="index.php?menu=12">Spašeni psi (API)</a></li>
		<li><a href="index.php?menu=13">Dog facts (API)</a></li>';
		if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
			print '
			<li><a href="index.php?menu=5">Registriraj se</a></li>
			<li><a href="index.php?menu=6">Prijava</a></li>';
		}
		else if ($_SESSION['user']['valid'] == 'true') {
			print '
			<li><a href="index.php?menu=7">Admin</a></li>
			<li><a href="signout.php">Odjava</a></li>';
		}
		print '
	</ul>';
?>