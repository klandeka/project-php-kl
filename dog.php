<?php 
	print '
	<h1>Psi</h1>';
	if (!isset($_POST['action']) || $_POST['action'] == '') { $_POST['action'] = FALSE; }
		
		if ($_POST['action'] == FALSE) {
			print '
			  <h1 style="text-align:left;">Dohvati sliku psa</h1>
			  <form class="form-horizontal" action="" name="imdbsearch" method="POST">

				<input type="hidden" name="action" value="TRUE">
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="Dohvati">
				  </div>
				</div>
			  </form>';
		} 
		else if ($_POST['action'] == TRUE) {
			print '
			<h1>Rezultat:</h1>';
		
			
			$url = 'https://dog.ceo/api/breeds/image/random';
			$json = file_get_contents($url);
			$_data = json_decode($json,true);

			
			$url2 = 'https://randomuser.me//api';
			$json2 = file_get_contents($url2);
			$_data2 = json_decode($json2,true);

			
			print '
			<p><a href="index.php?menu=12">Povratak</a></p>
			<div style="float: left;width: 22%;margin-right: 2%;">
				<img src="' . $_data['message'] . '" alt="Slika" style="width: 100%;border:4px solid grey; padding: 2px; margin:0 10px 10px 0; float:left;">
			</div>
			<div style="float:left;width:70%">
				<p><strong>Jedan pas iz našeg azila Landeka kojeg je udomila osoba</p>
				<h2>Osoba koja je udomila psa</h2>
				<p>Ime i prezime: ' . $_data2['results'][0]['name']['first'] . ' ' . $_data2['results'][0]['name']['last'] . '</p>
				<p>Spol: ' . $_data2['results'][0]['gender'] . '</p>
				<p>Grad: ' . $_data2['results'][0]['location']['city'] . '</p>
			</div>
			<div style="clear:both"></div>
			<form class="form-horizontal" action="" name="imdbsearch" method="POST">

				<input type="hidden" name="action" value="TRUE">
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="Dohvati novog psa">
				  </div>
				</div>
			  </form>
			';
			
		}
	print '
	</div>';
?>