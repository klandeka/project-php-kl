<?php 
	print '
	<h1>Kontakt</h1>
	<div id="contact">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2786.265801459493!2d16.10332719289445!3d45.70570424272949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47667dc68bb590fd%3A0xf44bf4565a3169dc!2zVmVsaWtvZ29yacSNa2EgdWwuIDIsIDEwNDE1LCBOb3ZvIMSMacSNZQ!5e0!3m2!1shr!2shr!4v1717855792634!5m2!1shr!2shr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		<h1>Kontakt podaci</h1>
		<h2>Katarina Landeka</h2>
		<p>katarina.landeka@vvg.hr</p> 
		<form action="http://localhost/project-php-api/send-contact.php" id="contact_form" name="contact_form" method="POST">
			<label for="fname">Vaše ime *</label>
			<input type="text" id="fname" name="firstname" placeholder="Vaše ime.." required>
			
			<label for="lname">Vaše prezime *</label>
			<input type="text" id="lname" name="lastname" placeholder="Vaše prezime.." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email" placeholder="E-mail.." required>

			<label for="country">Država *</label>
			<select id="country" name="country" required>
				<option value="">Odaberite</option>
				<option value="BE">Belgium</option>
				<option value="HR" selected>Croatia</option>
				<option value="LU">Luxembourg</option>
				<option value="HU">Hungary</option>
			</select>

			<label for="country">Newsletter *</label>
			<select id="newsletter" name="newsletter" required>
				<option value="">Odaberite</option>
				<option value="YES">DA</option>
				<option value="NO">NE</option>
			</select>

			<label for="subject">Vaš upit *</label>
			<textarea id="subject" name="subject" placeholder="Upišite tekst.." style="height:200px" required></textarea>

			<input type="submit" value="Pošalji">
		</form>
	</div>';
?>