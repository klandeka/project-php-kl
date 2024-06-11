<?php 
	print '
	<h1>Zanimljivosti o psima</h1>';
	if (!isset($_POST['action']) || $_POST['action'] == '') { $_POST['action'] = FALSE; }
		
		if ($_POST['action'] == FALSE) {
			print '
			  <h1 style="text-align:left;">Dohvati zanimljivost o psima</h1>
			  <form class="form-horizontal" action="" name="imdbsearch" method="POST">

				<input type="hidden" name="action" value="TRUE">
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="Dohvati novu zanimljivost">
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

			
			$url2 = 'https://dogapi.dog/api/v2/facts?limit=1';
			$json2 = file_get_contents($url2);
			$_data2 = json_decode($json2,true);

			
			print '
			<p><a href="index.php?menu=13">Povratak</a></p>
			<div style="float: left;width: 22%;margin-right: 2%;">
				<img src="' . $_data['message'] . '" alt="Slika" style="width: 100%;border:1px solid grey; padding: 2px; margin:0 10px 10px 0; float:left;">
			</div>
			<div style="float:left;width:70%">
				<h2><strong>Nova zanimljivost o psima:</h2>
				<p>Fun fact: ' . $_data2['data'][0]['attributes']['body'] . '</p>
			</div>
			<div style="clear:both"></div>
			<form class="form-horizontal" action="" name="imdbsearch" method="POST">

				<input type="hidden" name="action" value="TRUE">
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="Dohvati novu zanimljivost">
				  </div>
				</div>
			  </form>
			';
			
		}
	print '
	</div>';
?>