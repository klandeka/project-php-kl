<?php
	

	print '<h1>Naši psi</h1>';
	$query  = "SELECT * FROM dogs";
	$query .= " WHERE archive='N'";
	$query .= " ORDER BY date ASC";
	$result = @mysqli_query($MySQL, $query);
	while($row = @mysqli_fetch_array($result)) {
		print '
		<div class="news">
			<img src="dogs/' . $row['picture'] . '" alt="' . $row['name'] . '" title="' . $row['name'] . '">
			<h2>Ime psa: ' . $row['name'] . '</h2>
			<p>Pasmina: ' . $row['breed'] . '</p>
			<p>Opis: ' . $row['description'] . '</p>
			<p>Datum dolaska u azil: ' . $row['date'] . '</p>
			<hr>
		</div>';
	}
?>