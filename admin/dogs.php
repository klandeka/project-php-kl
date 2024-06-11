<?php 
	
	#Add dogs
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_dogs') {
		$_SESSION['message'] = '';
		# htmlspecialchars — Convert special characters to HTML entities
		# http://php.net/manual/en/function.htmlspecialchars.php
		$query  = "INSERT INTO dogs (name, breed, description, archive)";
		$query .= " VALUES ('" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['breed'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
		$result = @mysqli_query($MySQL, $query); 
		
		$ID = mysqli_insert_id($MySQL);
		
		# picture
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
			# strtolower - Returns string with all alphabetic characters converted to lowercase. 
			# strrchr - Find the last occurrence of a character in a string
			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
			
            $_picture = $ID . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "dogs/".$_picture);
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
				$_query  = "UPDATE dogs SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . $ID . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>You successfully added picture.</p>';
			}
        }
		
		
		$_SESSION['message'] .= '<p>You successfully added dogs!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	
	# Update dogs
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_dogs') {
		$query  = "UPDATE dogs SET name='" . htmlspecialchars($_POST['name'], ENT_QUOTES) . "', breed='" . htmlspecialchars($_POST['breed'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		
		# picture
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                
			# strtolower - Returns string with all alphabetic characters converted to lowercase. 
			# strrchr - Find the last occurrence of a character in a string
			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
            
			$_picture = (int)$_POST['edit'] . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "dogs/".$_picture);
			
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
				$_query  = "UPDATE dogs SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . (int)$_POST['edit'] . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>You successfully added picture.</p>';
			}
        }
		
		$_SESSION['message'] = '<p>You successfully changed dogs!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	# End update dogs
	
	# Delete dogs
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
		
		# Delete picture
        $query  = "SELECT picture FROM dogs";
        $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
        $row = @mysqli_fetch_array($result);
        @unlink("dogs/".$row['picture']); 
		
		# Delete dogs
		$query  = "DELETE FROM dogs";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted dogs!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	# End delete dogs
	
	
	#Show dogs info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM dogs";
		$query .= " WHERE id=".$_GET['id'];
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<h2>Pregled pasa</h2>
		<div class="dogs">
			<img src="dogs/' . $row['picture'] . '" alt="' . $row['name'] . '" name="' . $row['name'] . '">
			<h2>' . $row['name'] . '</h2>
			<p>' . $row['breed'] . '</p>
			<p>' . $row['description'] . '</p>
			<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
			<hr>
		</div>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p>';
	}
	
	#Add dogs 
	else if (isset($_GET['add']) && $_GET['add'] != '') {
		
		print '
		<h2>Dodaj psa</h2>
		<form action="" id="dogs_form" name="dogs_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_dogs">
			
			<label for="name">Ime psa *</label>
			<input type="text" id="name" name="name" placeholder="Ime psa.." required>

			<label for="breed">Pasmina *</label>
			<input type="text" id="breed" name="breed" placeholder="Pasmina.." required></input>
			
			<label for="description">Opis *</label>
			<textarea id="description" name="description" placeholder="Opis.." required></textarea>
				
			<label for="picture">slika</label>
			<input type="file" id="picture" name="picture">
						
			<label for="archive">Arhiviraj:</label><br />
            <input type="radio" name="archive" value="Y"> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N" checked> NO
			
			<hr>
			
			<input type="submit" value="Spremi">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p>';
	}
	#Edit dogs
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM dogs";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;

		print '
		<h2>Uređivanje psa</h2>
		<form action="" id="dogs_form_edit" name="dogs_form_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_dogs">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			
			<label for="name">Ime psa *</label>
			<input type="text" id="name" name="name" value="' . $row['name'] . '" placeholder="Ime psa.." required>

			<label for="breed">Pasmina *</label>
			<input type="text" id="name" name="breed" value="' . $row['breed'] . '" placeholder="Pasmina.." required>
			
			<label for="description">Opis *</label>
			<textarea id="description" name="description" placeholder="Opis vijesti.." required>' . $row['description'] . '</textarea>
				
			<label for="picture">Slika</label>
			<input type="file" id="picture" name="picture">
						
			<label for="archive">Arhiviraj:</label><br />
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> DA &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NE
			
			<hr>
			
			<input type="submit" value="Spremi">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p>';
	}
	else {
		print '
		<h2>Naši psi</h2>
		<div id="dogs">
			<table>
				<thead>
					<tr>
						<th width="16"></th>
						<th width="16"></th>
						<th width="16"></th>
						<th>Ime</th>
						<th>Pasmina</th>
						<th>Opis</th>
						<th>Datum</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM dogs";
				$query .= " ORDER BY date DESC";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img src="img/user.png" alt="user"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/edit.png" alt="uredi"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši"></a></td>
						<td>' . $row['name'] . '</td>
						<td>' . $row['breed'] . '</td>
						<td>' . $row['description'] . '</td>
						<td>' . pickerDateToMysql($row['date']) . '</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="img/inactive.png" alt="" title="" />'; }
                            else if ($row['archive'] == 'N') { print '<img src="img/active.png" alt="" title="" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
			<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink">Dodaj psa</a>
		</div>';
	}
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>