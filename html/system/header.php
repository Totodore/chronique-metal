<?php
	$playlists = $bdd->query("SELECT * FROM playlists")->fetchAll();
?>
<div id="top">
	<header id="header">
		<a class="title" href="/fr/">CHRONIQUE METAL</a>
		<hr class="separator_header" />
		<h3 class="slogan">Actualité Rock / Métal, Chroniques, Vidéos et Podcasts</h3>
		<span class="button_menu_mobile" onclick="slideMenu()"><i class="fas fa-arrow-down"></i></span>
	</header>
	<nav id="nav">
		<ul id="nav_tab">
			<li><a href="/fr/">Page d'accueil</a></li>
			<li>
				<span class="display_video">Vidéos</span>
				<ul id="videos_tab">
					<?php foreach($playlists as $playlist) { //on affiche chaque lien de playlist yt ?>
						<li><a href="/fr/videos/?id=<?php echo $playlist['ID'] ?>"><?php echo $playlist['titre'] ?></a></li>
					<?php } ?>
				</ul>
			</li>
			<li><a href="/fr/chroniques-ecrites/">Chroniques écrites</a></li>
			<li>
				<span class="display_interviews">Interviews</span>
				<ul id="interviews_tab">
					<li><a href="/fr/interviews/interviews-ecrites/">Interviews écrites</a></li>
					<li><a href="/fr/interviews/interviews-videos/">Interviews vidéos</a></li>
					<li><a href="/fr/interviews/hellfest-2018/">Interviews Hellfest</a></li>
				</ul>
			</li>
			<li>
				<span class="display_concerts">Concerts</span>
				<ul id="concerts_tab">
					<li><a href="/fr/concerts/photos/">Galeries</a></li>
					<li><a href="/fr/concerts/reports/">Reports</a></li>
				</ul>
			</li>
			<li><a href="/fr/live-radio/">Live Radio</a></li>
		</ul>
	</nav>
	<nav id="nav_mobile">
		<ul id="nav_tab_mobile">
			<li><a href="/fr/">Page d'accueil</a></li>
			<li>
				<span class="display_video_mobile">Vidéos <i class="arrow_sub_nav fas fa-arrow-down"></i></span>
				<ul id="videos_tab_mobile">
					<?php foreach($playlists as $playlist) { //on affiche chaque lien de playlist yt ?>
						<li><a href="/fr/videos/?id=<?php echo $playlist['ID'] ?>"><?php echo $playlist['titre'] ?></a></li>
					<?php 
			} ?>
				</ul>
			</li>
			<li><a href="/fr/chroniques-ecrites/">Chroniques écrites</a></li>
			<li>
				<span class="display_interviews_mobile">Interviews <i class="arrow_sub_nav fas fa-arrow-down"></i></span>
				<ul id="interviews_tab_mobile">
					<li><a href="/fr/interviews/interviews-ecrites/">Interviews écrites</a></li>
					<li><a href="/fr/interviews/interviews-videos/">Interviews vidéos</a></li>
					<li><a href="/fr/interviews/hellfest-2018/">Interviews Hellfest</a></li>
				</ul>
			</li>
			<li>
				<span class="display_concerts_mobile">Concerts<i class="arrow_sub_nav fas fa-arrow-down"></i></span>
				<ul id="concerts_tab_mobile">
					<li><a href="/fr/concerts/photos/">Galeries</a></li>
					<li><a href="/fr/concerts/reports/">Reports</a></li>
				</ul>
			</li>
			<li><a href="/fr/live-radio/">Live Radio</a></li>
		</ul>
	</nav>
</div>