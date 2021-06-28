<!DOCTYPE html>
<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
	
	include('config.php');
	
	$languagesURL = file_get_contents('data/language.json', false);
	$languages = json_decode($languagesURL, true);
	
	if (!isset($_COOKIE['clanWebLang'])) {
		$lang = $languages[$defaultLang];
	} else {
		$lang = $languages[$_COOKIE['clanWebLang']];
	}
	
	$opts = [
		'http' => [
			'method' => 'GET',
			'header' => [
				'User-Agent: ClanWebs',
				'authorization: Bearer '.$apiKey
			]
		]
	];
	
	$context = stream_context_create($opts);
	//file_get_contents('data/maint.json', false, $context);
	$membersURL = file_get_contents($apiUrl.$clanTag, false, $context);
	//$membersURL = file_get_contents('https://api.clashofclans.com/v1/clans/%23'.$clantag.'/members', false, $context);
	
	if ($membersURL != true) {
		maintenance();
		
		return;
	}
	
	$clan = json_decode($membersURL, true);
	
	if (!isset($clan['name'])) {
		maintenance();
		
		return;
	}
?>
<!--
	(C) Alcosmos 2021. Design by Supercell Oy. I don't have any relationship with Supercell Oy.
	Get your own Clan web in here: https://github.com/Alcosmos/clash-of-clans-clanwebs
-->
<html lang="<?=$defaultLang?>">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
			
				
	
	<title><?=$clan['name']?> - Clash of Clans</title>
	<link rel="stylesheet" href="data/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="<?=$description?>">
	<meta name="keywords" content="<?=$keywords?>">
	<meta name="theme-color" content="#171717">

	<meta property="og:title" content="<?php echo $clan['name']; ?> - Clash of Clans" />
	<meta property="og:site_name" content="<?php echo $clan['name']; ?> - Clash of Clans" />
	<meta property="og:description" content="<?=$description?>" />
	<link rel="icon" type="image/png" href="<?=$clan['badgeUrls']['small']?>">
	<meta name="apple-mobile-web-app-title" content="Clash of Clans">
	<meta name="application-name" content="Clash of Clans">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>
<body class="layout__home ">

<?php printGoto(); ?>

<div id="app">
	<div class="App">

		<!-- header start -->
		<header class="Header js-header">
			<a href="." class="Header__logo">
				<img src="<?=$clan['badgeUrls']['large']?>">
			</a>

			<div class='Header-bg'></div>

			<div class="Languagebar-holder">
				<div class='Languagebar-backdrop'></div>
				<div class='Languagebar-scroller'>
					<div class="Languagebar-FixedElements Languagebar-wrapper">
						<a
							href=""
							class="Languagebar-logo Languagebar-logo-outside js-click"
							title="Home"
							data-category="Header" data-label="Logo">
							<?=$lang['language']?>
						</a>

						<a class="Languagebar-language">
							<div class="Languagebar-arrow-left">
								<svg viewBox="0 0 23 24" class="icon-arrow" width="9px" height="9px">
									<g>
										<path d="M18.8,10.1L9.3,0.8c-1.1-1.1-2.8-1.1-3.9,0c-1.1,1.1-1.1,2.8,0,3.8l7.6,7.4l-7.6,7.4
                                    c-1.1,1.1-1.1,2.8,0,3.8c1.1,1.1,2.8,1.1,3.9,0l9.5-9.3C19.9,12.9,19.9,11.2,18.8,10.1z"></path>
									</g>
								</svg>
							</div>
							<span>
								<?=$lang['language']?>
							</span>
							<div class="Languagebar-arrow-right">
								<svg viewBox="0 0 23 24" class="icon-arrow" width="9px" height="9px">
									<g>
										<path d="M18.8,10.1L9.3,0.8c-1.1-1.1-2.8-1.1-3.9,0c-1.1,1.1-1.1,2.8,0,3.8l7.6,7.4l-7.6,7.4
                                        c-1.1,1.1-1.1,2.8,0,3.8c1.1,1.1,2.8,1.1,3.9,0l9.5-9.3C19.9,12.9,19.9,11.2,18.8,10.1z"></path>
									</g>
								</svg>
							</div>
						</a>
					</div>
					<nav class='Languagebar' ref="Languagebar">
						<div class='Languagebar-background' ref="navBg">
							<div class="Languagebar-wrapper" ref="LanguagebarWrapper">
								<div class='Languagebar-nav js-hover-effect'>
									<div class="Languagebar-primarynav" ref="primaryNav">
										<div class="Languagebar-item"></div>
											<div class="Languagebar-content">
												<?php
													foreach ($languages as $key => $value) {
														echo '<a href="" onclick="goto'.$key.'()">'.$value['language'].'</a>';
													}
												?>
											</div>
										<div class="Languagebar-item"></div>
									</div>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<!-- header end -->

				<div class="Hero">
			<div class="Hero-content">
				<h1><?php echo $clan['name']; ?></h1>
				<!--<span class="hero-subtitle">
					Clash of Clans
				</span>-->
			</div>
			
			<img src="data/images/header_clan.jpg" class="HeroImage">
		</div>
		
		<div class="content-wrapper">
		
			<!-- yield start -->
			
			
			
	<div class="home">
		<div class="section section-homepage section-homepage-main">
			<div class="section-wrapper">
				
<div class="home-main-news-item">
	<div class="home-main-news-item-image">
		<div class="home-main-picture">
			<img src="<?=$clan['badgeUrls']['large']?>" class="image-medium">
		</div>
	</div>
	<div class="home-main-news-item-content">

		<h2><img src="<?=$clan['badgeUrls']['large']?>" class="image-small"><?=$lang['descHeader']?></h2>
		
		<p>
			<?php
				/*
				 * Empty $lang['descBody']? we show clan description to api.
				 * $lang['descBody'] isn't empty? we show it.
				 */
				if ($lang['descBody'] == '') {
					echo $clan['description'];
				} else {
					echo $lang['descBody'];
				}
			?>
			<br><br>
			<?=$lang['descMembers'].$clan['members'].$lang['descWars'].$clan['warWins'].$lang['descLeague'].$lang[$clan['warLeague']['name']].$lang['descHalfFinal']?>
			<br><br>
			<?=$lang['descType'].($clan['type']=='open'?$lang['descTypeOpen']:$lang['descTypeClosed']).$lang['descRequired'].$clan['requiredTrophies'].$lang['descFinal']?>
		</p>
		
		<h3><?=$lang['descJoin'].$clan['tag']?></h3>
	</div>
</div>
							</div>
		</div>

		<div class="section section-homepage section-homepage-news-primary">
			<div class="section-wrapper">
													
<?php
	foreach ($clan['memberList'] as $member) {
echo '<div class="home-news-primary-item">
	<div class="home-news-primary-item-content js-match-height">
		<div class="home-news-primary-item-content-category" style="background-color: ';
switch ($member['role']) {
	case 'leader':
		echo '#552d96';
		break;
	case 'coLeader':
		echo '#15498a';
		break;
	case 'admin':
		echo '#A87C00';
		break;
	case 'member':
		echo '#55572B';
		break;
}
echo ';">
			<img src="'.$member['league']['iconUrls']['small'].'" align="left"><h4>#'.$member['clanRank'].' '.$member['name'].'</h4><br>
			<h5>'.$lang[$member['role']].'</h5>
		</div>
		<div class="home-news-primary-item-text">
			<p>
				'.$lang['memberLeague'].$lang[$member['league']['name']].'<br>
				'.$member['trophies'].$lang['memberTrophies'].'<br>
				'.$member['versusTrophies'].$lang['memberBhTrophies'].'<br><br>
				'.$lang['memberPrevious'].'#'.$member['previousClanRank'].' ('.sprintf("%+d", $member['previousClanRank']-$member['clanRank']).')<br>
			</p>
			<center>
				<table>
					<tr class="center">
						<td>'.$lang['memberDonated'].'</td><td>'.$lang['memberReceived'].'</td>
					</tr>
					<tr class="box center">
						<td>'.$member['donations'].'</td><td>'.$member['donationsReceived'].'</td>
					</tr>
				</table>
			</center>
		</div>
	</div>
</div>';
	}
?>
<div class="home-news-primary-item">
</div>
			</div>
		</div>
	</div>

	<div class="BlogDetail-Side">
	<h1 class="BlogDetail-Side-title"><?=$lang['sideHeaderMore']?></h1>
	<ul class="BlogDetail-Side-list">

					<li>
				<a href="https://www.facebook.com/ClashOfClansESC/" title="Facebook" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-facebook">
								<path d="M79.7,0H4.6C2.2,0,0,2.2,0,4.5l0,0v74.9C0,82.1,2.2,84,4.6,84l0,0h40.3V51.5h-11V38.8h11v-9.3c-1-8.4,5.3-15.8,13.7-16.8c1,0,1.7,0,2.6,0c3.4,0,6.5,0.2,9.8,0.5v11.2h-6.7c-5.3,0-6.2,2.6-6.2,6.2v8.1h12.5l-1.7,12.7h-11V84h21.6c2.6,0,4.6-2.2,4.6-4.5l0,0V4.5C84.2,2.2,82.3,0,79.7,0"/>
						</svg>
					</span>
				</a>
			</li>
					<li>
				<a href="https://instagram.com/clashofclans/" title="Instagram" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-instagram">
							<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="6.7605" y1="78.4379" x2="77.3573" y2="7.4436" gradientTransform="matrix(1 0 0 -1 0 85)">
	<stop  offset="8.814103e-04" style="stop-color:#5D5CA8"/>
	<stop  offset="0.9995" style="stop-color:#DD2F7A"/>
</linearGradient>
<path style="fill: url(#SVGID_2_);" class="st0" d="M42,7.6c11.2,0,12.6,0,16.9,0.2c4.1,0.2,6.2,1,7.9,1.4c1.9,0.7,3.3,1.7,4.8,3.1c1.4,1.4,2.4,2.9,3.1,4.8c0.5,1.4,1.2,3.8,1.4,7.9c0.2,4.5,0.2,5.7,0.2,16.9s0,12.6-0.2,16.9c-0.2,4.1-1,6.2-1.4,7.9c-0.7,1.9-1.7,3.3-3.1,4.8c-1.4,1.4-2.9,2.4-4.8,3.1c-1.4,0.5-3.8,1.2-7.9,1.4c-4.3,0.2-5.7,0.2-16.9,0.2s-12.6,0-16.9-0.2c-4.1-0.2-6.2-1-7.9-1.4c-1.9-0.7-3.3-1.7-4.8-3.1s-2.4-2.9-3.1-4.8c-0.5-1.4-1.2-3.8-1.4-7.9C7.6,54.4,7.6,53.2,7.6,42s0-12.6,0.2-16.9c0.2-4.1,1-6.2,1.4-7.9c0.7-1.9,1.7-3.3,3.1-4.8c1.4-1.4,2.9-2.4,4.8-3.1c1.4-0.5,3.8-1.2,7.9-1.4C29.4,7.6,30.8,7.6,42,7.6 M42,0C30.5,0,29.1,0,24.6,0.2c-4.3,0.2-7.4,1-10,1.9c-2.9,1.2-5.2,2.6-7.4,5c-2.4,2.4-3.8,4.8-4.8,7.4s-1.7,5.7-1.9,10.3C0,29.1,0,30.5,0,42s0,12.9,0.2,17.4s1,7.6,1.9,10.3c1,2.9,2.6,5,4.8,7.4c2.4,2.4,4.8,3.8,7.4,4.8c2.6,1,5.7,1.7,10.3,1.9S30.5,84,42,84s12.9,0,17.4-0.2s7.6-1,10.3-1.9c2.9-1,5-2.6,7.4-4.8c2.4-2.4,3.8-4.8,4.8-7.4c1-2.6,1.7-5.7,1.9-10.3S84,53.5,84,42s0-12.9-0.2-17.4s-1-7.6-1.9-10.3c-1-2.9-2.6-5-4.8-7.4c-2.4-2.4-4.8-3.8-7.4-4.8S64,0.5,59.4,0.2C54.9,0,53.5,0,42,0L42,0z M42,20.5c-11.9,0-21.5,9.5-21.5,21.5S30.1,63.5,42,63.5S63.5,53.9,63.5,42S53.9,20.5,42,20.5z M42,56.1c-7.6,0-14.1-6.2-14.1-14.1c0-7.6,6.2-14.1,14.1-14.1S56.1,34.1,56.1,42C56.1,49.6,49.6,56.1,42,56.1z M64.4,14.6c-2.9,0-5,2.1-5,5s2.1,5,5,5s5-2.1,5-5S67.3,14.6,64.4,14.6z"/>
<radialGradient id="SVGID_3_" cx="25.4" cy="35.6834" r="20.3478" gradientTransform="matrix(2.3864 0 0 -2.3864 -33.9659 168.875)" gradientUnits="userSpaceOnUse">
	<stop  offset="4.607372e-04" style="stop-color:#FCD375"/>
	<stop  offset="0.5957" style="stop-color:#E8544F"/>
	<stop  offset="1" style="stop-color:#D1347A;stop-opacity:0"/>
</radialGradient>
<path style="fill:url(#SVGID_3_)" d="M42,7.6c11.2,0,12.6,0,16.9,0.2c4.1,0.2,6.2,1,7.9,1.4c1.9,0.7,3.3,1.7,4.8,3.1c1.4,1.4,2.4,2.9,3.1,4.8c0.5,1.4,1.2,3.8,1.4,7.9c0.2,4.5,0.2,5.7,0.2,16.9s0,12.6-0.2,16.9c-0.2,4.1-1,6.2-1.4,7.9c-0.7,1.9-1.7,3.3-3.1,4.8c-1.4,1.4-2.9,2.4-4.8,3.1c-1.4,0.5-3.8,1.2-7.9,1.4c-4.3,0.2-5.7,0.2-16.9,0.2s-12.6,0-16.9-0.2c-4.1-0.2-6.2-1-7.9-1.4c-1.9-0.7-3.3-1.7-4.8-3.1s-2.4-2.9-3.1-4.8c-0.5-1.4-1.2-3.8-1.4-7.9C7.6,54.4,7.6,53.2,7.6,42s0-12.6,0.2-16.9c0.2-4.1,1-6.2,1.4-7.9c0.7-1.9,1.7-3.3,3.1-4.8c1.4-1.4,2.9-2.4,4.8-3.1c1.4-0.5,3.8-1.2,7.9-1.4C29.4,7.6,30.8,7.6,42,7.6 M42,0C30.5,0,29.1,0,24.6,0.2c-4.3,0.2-7.4,1-10,1.9c-2.9,1.2-5.2,2.6-7.4,5c-2.4,2.4-3.8,4.8-4.8,7.4s-1.7,5.7-1.9,10.3C0,29.1,0,30.5,0,42s0,12.9,0.2,17.4s1,7.6,1.9,10.3c1,2.9,2.6,5,4.8,7.4c2.4,2.4,4.8,3.8,7.4,4.8c2.6,1,5.7,1.7,10.3,1.9S30.5,84,42,84s12.9,0,17.4-0.2s7.6-1,10.3-1.9c2.9-1,5-2.6,7.4-4.8c2.4-2.4,3.8-4.8,4.8-7.4c1-2.6,1.7-5.7,1.9-10.3S84,53.5,84,42s0-12.9-0.2-17.4s-1-7.6-1.9-10.3c-1-2.9-2.6-5-4.8-7.4c-2.4-2.4-4.8-3.8-7.4-4.8S64,0.5,59.4,0.2C54.9,0,53.5,0,42,0L42,0z M42,20.5c-11.9,0-21.5,9.5-21.5,21.5S30.1,63.5,42,63.5S63.5,53.9,63.5,42S53.9,20.5,42,20.5z M42,56.1c-7.6,0-14.1-6.2-14.1-14.1c0-7.6,6.2-14.1,14.1-14.1S56.1,34.1,56.1,42C56.1,49.6,49.6,56.1,42,56.1z M64.4,14.6c-2.9,0-5,2.1-5,5s2.1,5,5,5s5-2.1,5-5S67.3,14.6,64.4,14.6z"/>
						</svg>
					</span>
				</a>
			</li>
					<li>
				<a href="https://www.youtube.com/clashofclans" title="YouTube" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-youtube">
								<path d="M82.3,21.9c-1-3.6-3.8-6.3-7.2-7.2c-10.8-1.2-21.9-1.9-33-1.7C31,12.8,20,13.3,9.1,14.5c-3.6,1-6.3,3.8-7.2,7.2C0.7,28.4,0,35.2,0,41.9s0.5,13.5,1.9,20.2c1,3.6,3.8,6.3,7.2,7.2C20,70.5,31,71.2,42.1,71c11.1,0.2,21.9-0.5,33-1.7c3.6-1,6.3-3.8,7.2-7.2c1.2-6.7,1.7-13.5,1.7-20.2C84.2,35.4,83.5,28.7,82.3,21.9L82.3,21.9z M33.7,54.9V29.6l21.9,12.5L33.7,54.9z"/>
						</svg>
					</span>
				</a>
			</li>
					<li>
				<a href="http://www.twitch.tv/directory/game/Clash%20of%20Clans" title="Twitch" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-twitch">
								<path d="M7.1,0L1.8,14.6v58.6H22V84h11l11-11h16.3l21.8-21.8V0H7.1z M14.5,7.2h60.2v40.1L62,60H41.9l-11,11V60H14.5V7.2z"/>
	<path d="M34.7,43.9h7.2V21.8h-7.2V43.9z M54.6,43.9h7.2V21.8h-7.2V43.9z"/>
						</svg>
					</span>
				</a>
			</li>
					<li>
				<a href="http://clashofclans.wikia.com/" title="Wikia" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-wikia">
								<path d="M31.7 64.2c-1.6 0-2.9 1.3-2.9 2.9s1.3 2.9 2.9 2.9c1.6 0 2.9-1.3 2.9-2.9s-1.3-2.9-2.9-2.9zM62.9 64.2c1.6 0 2.9 1.3 2.9 2.9S64.5 70 62.9 70 60 68.7 60 67.1s1.3-2.9 2.9-2.9zM39.6 86.6V64.1h5.1v12.6l1.3-1.6 2.9-3.4h7.2l-6 5.9 6.4 9h-6.6l-3.5-5.7-1.7 1.7v4zM20.9 71.7l-1.8 10.2-2.5-10.2h-5.9L8.3 81.9 6.4 71.7H1.1L5 86.6h6.7l1.9-7.8 2 7.8h6.7l3.9-14.9zM84.2 76l.3-4.3h-4.6l-.3 1.6c-1.1-1.1-2.4-2.1-4.7-2.1-4.2 0-6.5 2.7-6.5 7.9s2.3 7.9 6.5 7.9c2.3 0 3.7-.9 4.7-2l.3 1.6h4.6l-.3-4.3V76zm-5 5c-.6.8-1.7 1.4-3 1.4-1.5 0-2.7-1-2.7-3.3s1.2-3.3 2.7-3.3c1.3 0 2.3.6 3 1.4V81zM36 74.8v-3.2h-7.2V86.7H36v-3.2h-2.3v-8.7zM58.5 74.8v-3.2h7.3V86.7h-7.3v-3.2h2.3v-8.7z"/>
	<path d="M29.3 12.3V0H1.1v58.5h28.2V46.2h-8.8V12.3zM56.3 12.3V0h28.2v58.5H56.3V46.2h8.8V12.3z"/>
						</svg>
					</span>
				</a>
			</li>
					<li>
				<a href="https://twitter.com/ClashofClansESC" title="Twitter" class="SocialItem" target="_blank">
					<span class="BlogDetail-Side-svg-wrapper">
						<svg viewBox="0 0 87 87" style="vertical-align:middle;" class="icon-twitter">
								<path d="M84,16.1c-3.2,1.4-6.5,2.3-10,2.8c3.7-2.1,6.2-5.6,7.6-9.5c-3.5,2.1-7.2,3.5-10.9,4.2c-6.5-6.9-17.4-7.4-24.3-0.9c-3.7,3.2-5.6,7.6-5.6,12.5c0,1.4,0.2,2.5,0.5,3.9c-13.9-0.7-26.8-7.2-35.6-18c-1.6,2.5-2.3,5.6-2.3,8.6c0,5.8,2.8,11.1,7.6,14.3c-2.8,0-5.3-0.9-7.9-2.1V32c0,8.1,5.8,15.3,13.9,16.9c-2.5,0.7-5.1,0.7-7.9,0.2c2.3,6.9,8.8,11.8,16.2,12c-6,4.9-13.7,7.4-21.3,7.4c-1.4,0-2.8,0-4.2-0.2C7.9,73.4,17.1,76,26.6,76c26.8,0.5,48.8-21.3,49.1-48.1c0-0.2,0-0.5,0-0.7c0-0.7,0-1.4,0-2.3C78.9,22.5,81.9,19.5,84,16.1L84,16.1L84,16.1z"/>
						</svg>
					</span>
				</a>
			</li>
			<h1 class="BlogDetail-Side-title"><?=$lang['sideHeader']?></h1>
			<p class="BlogDetail-Side-body">
				<?=$lang['sideBody']?>
			</p>
			</ul>
</div>

			<!-- yield end -->

		</div>

		<a class="back-to-top js-back-to-top" href="#">
			<span class="back-to-top__cta">
				<?=$lang['goTop']?>
			</span>
			<span class="back-to-top__svg">
				<svg viewBox="0 0 24 15">
					<path fill="white" d="M10.1.8L.8 10.3c-1.1 1.1-1.1 2.8 0 3.9s2.8 1.1 3.8 0L12 6.6l7.4 7.6c1.1 1.1 2.8 1.1 3.8 0 1.1-1.1 1.1-2.8 0-3.9L13.9.8c-1-1.1-2.7-1.1-3.8 0z"/>
				</svg>
			</span>
		</a>

		<!-- footer start -->
		<footer class="Footer" ref="Footer">
			<div class="Footer-wrapper">
				<div class="Footer-primarynav js-hover-effect" ref="primaryNav">
					<?=$lang['footerWeb']?><a href="https://alcosmos.ddns.net" target="_blank">Alcosmos</a> 2021 - <?=date('Y')?>.
					<?=$lang['footerGit']?><a href="https://github.com/Alcosmos/clash-of-clans-clanwebs" target="_blank"><?=$lang['footerGitLink']?></a><?=$lang['footerGitFinal']?>
				</div>

				<div class="Footer-DownloadButton">
					
											<a href="https://apps.apple.com/app/clash-of-clans/id529479190" target="_blank" class="download--ios" data-category="Nav" data-label="Download">
							<img src="data/images/en_apple.png" alt="App Store Download" />
						</a>
																<a href="https://play.google.com/store/apps/details?id=com.supercell.clashofclans" class="download--android" data-category="Nav" target="_blank" data-label="Download">
							<img src="data/images/en_android.png" alt="Play Store Download" />
						</a>
									</div>

				
				<div class="Footer-secondarynav  js-hover-effect">
					<a href="https://alcosmos.ddns.net" target="_blank" class="Footer-item js-click" data-category="Footer">Alcosmos' Web</a>
					<a href="https://github.com/Alcosmos/clash-of-clans-clanwebs" target="_blank" class="Footer-item js-click" data-category="Footer">Clan webs' GitHub</a>
				</div>

				<div class="Footer-SocialItems social-media js-hover-effect">
											<a href="https://www.facebook.com/ClashOfClansESC/" title="Facebook" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-facebook">
										<path d="M79.7,0H4.6C2.2,0,0,2.2,0,4.5l0,0v74.9C0,82.1,2.2,84,4.6,84l0,0h40.3V51.5h-11V38.8h11v-9.3c-1-8.4,5.3-15.8,13.7-16.8c1,0,1.7,0,2.6,0c3.4,0,6.5,0.2,9.8,0.5v11.2h-6.7c-5.3,0-6.2,2.6-6.2,6.2v8.1h12.5l-1.7,12.7h-11V84h21.6c2.6,0,4.6-2.2,4.6-4.5l0,0V4.5C84.2,2.2,82.3,0,79.7,0"/>
								</svg>
							</span>
						</a>
											<a href="https://instagram.com/clashofclans/" title="Instagram" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-instagram">
									<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="6.7605" y1="78.4379" x2="77.3573" y2="7.4436" gradientTransform="matrix(1 0 0 -1 0 85)">
	<stop  offset="8.814103e-04" style="stop-color:#5D5CA8"/>
	<stop  offset="0.9995" style="stop-color:#DD2F7A"/>
</linearGradient>
<path style="fill: url(#SVGID_2_);" class="st0" d="M42,7.6c11.2,0,12.6,0,16.9,0.2c4.1,0.2,6.2,1,7.9,1.4c1.9,0.7,3.3,1.7,4.8,3.1c1.4,1.4,2.4,2.9,3.1,4.8c0.5,1.4,1.2,3.8,1.4,7.9c0.2,4.5,0.2,5.7,0.2,16.9s0,12.6-0.2,16.9c-0.2,4.1-1,6.2-1.4,7.9c-0.7,1.9-1.7,3.3-3.1,4.8c-1.4,1.4-2.9,2.4-4.8,3.1c-1.4,0.5-3.8,1.2-7.9,1.4c-4.3,0.2-5.7,0.2-16.9,0.2s-12.6,0-16.9-0.2c-4.1-0.2-6.2-1-7.9-1.4c-1.9-0.7-3.3-1.7-4.8-3.1s-2.4-2.9-3.1-4.8c-0.5-1.4-1.2-3.8-1.4-7.9C7.6,54.4,7.6,53.2,7.6,42s0-12.6,0.2-16.9c0.2-4.1,1-6.2,1.4-7.9c0.7-1.9,1.7-3.3,3.1-4.8c1.4-1.4,2.9-2.4,4.8-3.1c1.4-0.5,3.8-1.2,7.9-1.4C29.4,7.6,30.8,7.6,42,7.6 M42,0C30.5,0,29.1,0,24.6,0.2c-4.3,0.2-7.4,1-10,1.9c-2.9,1.2-5.2,2.6-7.4,5c-2.4,2.4-3.8,4.8-4.8,7.4s-1.7,5.7-1.9,10.3C0,29.1,0,30.5,0,42s0,12.9,0.2,17.4s1,7.6,1.9,10.3c1,2.9,2.6,5,4.8,7.4c2.4,2.4,4.8,3.8,7.4,4.8c2.6,1,5.7,1.7,10.3,1.9S30.5,84,42,84s12.9,0,17.4-0.2s7.6-1,10.3-1.9c2.9-1,5-2.6,7.4-4.8c2.4-2.4,3.8-4.8,4.8-7.4c1-2.6,1.7-5.7,1.9-10.3S84,53.5,84,42s0-12.9-0.2-17.4s-1-7.6-1.9-10.3c-1-2.9-2.6-5-4.8-7.4c-2.4-2.4-4.8-3.8-7.4-4.8S64,0.5,59.4,0.2C54.9,0,53.5,0,42,0L42,0z M42,20.5c-11.9,0-21.5,9.5-21.5,21.5S30.1,63.5,42,63.5S63.5,53.9,63.5,42S53.9,20.5,42,20.5z M42,56.1c-7.6,0-14.1-6.2-14.1-14.1c0-7.6,6.2-14.1,14.1-14.1S56.1,34.1,56.1,42C56.1,49.6,49.6,56.1,42,56.1z M64.4,14.6c-2.9,0-5,2.1-5,5s2.1,5,5,5s5-2.1,5-5S67.3,14.6,64.4,14.6z"/>
<radialGradient id="SVGID_3_" cx="25.4" cy="35.6834" r="20.3478" gradientTransform="matrix(2.3864 0 0 -2.3864 -33.9659 168.875)" gradientUnits="userSpaceOnUse">
	<stop  offset="4.607372e-04" style="stop-color:#FCD375"/>
	<stop  offset="0.5957" style="stop-color:#E8544F"/>
	<stop  offset="1" style="stop-color:#D1347A;stop-opacity:0"/>
</radialGradient>
<path style="fill:url(#SVGID_3_)" d="M42,7.6c11.2,0,12.6,0,16.9,0.2c4.1,0.2,6.2,1,7.9,1.4c1.9,0.7,3.3,1.7,4.8,3.1c1.4,1.4,2.4,2.9,3.1,4.8c0.5,1.4,1.2,3.8,1.4,7.9c0.2,4.5,0.2,5.7,0.2,16.9s0,12.6-0.2,16.9c-0.2,4.1-1,6.2-1.4,7.9c-0.7,1.9-1.7,3.3-3.1,4.8c-1.4,1.4-2.9,2.4-4.8,3.1c-1.4,0.5-3.8,1.2-7.9,1.4c-4.3,0.2-5.7,0.2-16.9,0.2s-12.6,0-16.9-0.2c-4.1-0.2-6.2-1-7.9-1.4c-1.9-0.7-3.3-1.7-4.8-3.1s-2.4-2.9-3.1-4.8c-0.5-1.4-1.2-3.8-1.4-7.9C7.6,54.4,7.6,53.2,7.6,42s0-12.6,0.2-16.9c0.2-4.1,1-6.2,1.4-7.9c0.7-1.9,1.7-3.3,3.1-4.8c1.4-1.4,2.9-2.4,4.8-3.1c1.4-0.5,3.8-1.2,7.9-1.4C29.4,7.6,30.8,7.6,42,7.6 M42,0C30.5,0,29.1,0,24.6,0.2c-4.3,0.2-7.4,1-10,1.9c-2.9,1.2-5.2,2.6-7.4,5c-2.4,2.4-3.8,4.8-4.8,7.4s-1.7,5.7-1.9,10.3C0,29.1,0,30.5,0,42s0,12.9,0.2,17.4s1,7.6,1.9,10.3c1,2.9,2.6,5,4.8,7.4c2.4,2.4,4.8,3.8,7.4,4.8c2.6,1,5.7,1.7,10.3,1.9S30.5,84,42,84s12.9,0,17.4-0.2s7.6-1,10.3-1.9c2.9-1,5-2.6,7.4-4.8c2.4-2.4,3.8-4.8,4.8-7.4c1-2.6,1.7-5.7,1.9-10.3S84,53.5,84,42s0-12.9-0.2-17.4s-1-7.6-1.9-10.3c-1-2.9-2.6-5-4.8-7.4c-2.4-2.4-4.8-3.8-7.4-4.8S64,0.5,59.4,0.2C54.9,0,53.5,0,42,0L42,0z M42,20.5c-11.9,0-21.5,9.5-21.5,21.5S30.1,63.5,42,63.5S63.5,53.9,63.5,42S53.9,20.5,42,20.5z M42,56.1c-7.6,0-14.1-6.2-14.1-14.1c0-7.6,6.2-14.1,14.1-14.1S56.1,34.1,56.1,42C56.1,49.6,49.6,56.1,42,56.1z M64.4,14.6c-2.9,0-5,2.1-5,5s2.1,5,5,5s5-2.1,5-5S67.3,14.6,64.4,14.6z"/>
								</svg>
							</span>
						</a>
											<a href="https://www.youtube.com/clashofclans" title="YouTube" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-youtube">
										<path d="M82.3,21.9c-1-3.6-3.8-6.3-7.2-7.2c-10.8-1.2-21.9-1.9-33-1.7C31,12.8,20,13.3,9.1,14.5c-3.6,1-6.3,3.8-7.2,7.2C0.7,28.4,0,35.2,0,41.9s0.5,13.5,1.9,20.2c1,3.6,3.8,6.3,7.2,7.2C20,70.5,31,71.2,42.1,71c11.1,0.2,21.9-0.5,33-1.7c3.6-1,6.3-3.8,7.2-7.2c1.2-6.7,1.7-13.5,1.7-20.2C84.2,35.4,83.5,28.7,82.3,21.9L82.3,21.9z M33.7,54.9V29.6l21.9,12.5L33.7,54.9z"/>
								</svg>
							</span>
						</a>
											<a href="http://www.twitch.tv/directory/game/Clash%20of%20Clans" title="Twitch" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-twitch">
										<path d="M7.1,0L1.8,14.6v58.6H22V84h11l11-11h16.3l21.8-21.8V0H7.1z M14.5,7.2h60.2v40.1L62,60H41.9l-11,11V60H14.5V7.2z"/>
	<path d="M34.7,43.9h7.2V21.8h-7.2V43.9z M54.6,43.9h7.2V21.8h-7.2V43.9z"/>
								</svg>
							</span>
						</a>
											<a href="http://clashofclans.wikia.com/" title="Wikia" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-wikia">
										<path d="M31.7 64.2c-1.6 0-2.9 1.3-2.9 2.9s1.3 2.9 2.9 2.9c1.6 0 2.9-1.3 2.9-2.9s-1.3-2.9-2.9-2.9zM62.9 64.2c1.6 0 2.9 1.3 2.9 2.9S64.5 70 62.9 70 60 68.7 60 67.1s1.3-2.9 2.9-2.9zM39.6 86.6V64.1h5.1v12.6l1.3-1.6 2.9-3.4h7.2l-6 5.9 6.4 9h-6.6l-3.5-5.7-1.7 1.7v4zM20.9 71.7l-1.8 10.2-2.5-10.2h-5.9L8.3 81.9 6.4 71.7H1.1L5 86.6h6.7l1.9-7.8 2 7.8h6.7l3.9-14.9zM84.2 76l.3-4.3h-4.6l-.3 1.6c-1.1-1.1-2.4-2.1-4.7-2.1-4.2 0-6.5 2.7-6.5 7.9s2.3 7.9 6.5 7.9c2.3 0 3.7-.9 4.7-2l.3 1.6h4.6l-.3-4.3V76zm-5 5c-.6.8-1.7 1.4-3 1.4-1.5 0-2.7-1-2.7-3.3s1.2-3.3 2.7-3.3c1.3 0 2.3.6 3 1.4V81zM36 74.8v-3.2h-7.2V86.7H36v-3.2h-2.3v-8.7zM58.5 74.8v-3.2h7.3V86.7h-7.3v-3.2h2.3v-8.7z"/>
	<path d="M29.3 12.3V0H1.1v58.5h28.2V46.2h-8.8V12.3zM56.3 12.3V0h28.2v58.5H56.3V46.2h8.8V12.3z"/>
								</svg>
							</span>
						</a>
											<a href="https://twitter.com/ClashofClansESC" title="Twitter" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-twitter">
										<path d="M84,16.1c-3.2,1.4-6.5,2.3-10,2.8c3.7-2.1,6.2-5.6,7.6-9.5c-3.5,2.1-7.2,3.5-10.9,4.2c-6.5-6.9-17.4-7.4-24.3-0.9c-3.7,3.2-5.6,7.6-5.6,12.5c0,1.4,0.2,2.5,0.5,3.9c-13.9-0.7-26.8-7.2-35.6-18c-1.6,2.5-2.3,5.6-2.3,8.6c0,5.8,2.8,11.1,7.6,14.3c-2.8,0-5.3-0.9-7.9-2.1V32c0,8.1,5.8,15.3,13.9,16.9c-2.5,0.7-5.1,0.7-7.9,0.2c2.3,6.9,8.8,11.8,16.2,12c-6,4.9-13.7,7.4-21.3,7.4c-1.4,0-2.8,0-4.2-0.2C7.9,73.4,17.1,76,26.6,76c26.8,0.5,48.8-21.3,49.1-48.1c0-0.2,0-0.5,0-0.7c0-0.7,0-1.4,0-2.3C78.9,22.5,81.9,19.5,84,16.1L84,16.1L84,16.1z"/>
								</svg>
							</span>
						</a>
											<a href="https://www.reddit.com/r/clashofclans" title="Reddit" class="SocialItem js-click" target="_blank">
							<span class="BlogDetail-Side-svg-wrapper">
								<svg viewBox="0 0 87 87" style="fill:#ffffff; vertical-align:middle;" class="icon-reddit">
										<path d="M49.9,53.8c0.2,0.2,0.2,0.7,0,1c-1.7,1.7-4.1,2.4-7.9,2.4l0,0l0,0c-3.6,0-6.2-0.7-7.9-2.4c-0.2-0.2-0.2-0.7,0-1c0.2-0.2,0.7-0.2,1,0c1.4,1.2,3.6,1.9,6.7,1.9l0,0l0,0c3.1,0,5.5-0.7,6.7-1.9C49,53.5,49.4,53.5,49.9,53.8z M37.7,45.4c0-1.7-1.4-3.1-3.1-3.1c-1.7,0-3.1,1.4-3.1,3.1s1.4,3.1,3.1,3.1C36.2,48.5,37.7,47,37.7,45.4z M84,42c0,23.3-18.7,42-42,42S0,65.3,0,42S18.7,0,42,0S84,18.7,84,42z M66.5,41.5c0-2.9-2.4-5.5-5.5-5.5c-1.4,0-2.9,0.5-3.8,1.4c-3.6-2.4-8.6-4.1-14.2-4.1l3.1-9.6l8.2,1.9l0,0c0,2.4,1.9,4.3,4.3,4.3c2.4,0,4.3-1.9,4.3-4.3s-1.7-4.1-4.1-4.1c-1.9,0-3.4,1.2-4.1,2.9l-8.9-2.2c-0.5,0-0.7,0.2-1,0.5l-3.4,10.6c-5.8,0-11,1.7-14.9,4.1c-1-1-2.2-1.4-3.6-1.4c-2.9,0-5.5,2.4-5.5,5.5c0,1.9,1.2,3.6,2.6,4.6c0,0.5-0.2,1.2-0.2,1.7c0,7.9,9.8,14.4,21.8,14.4s21.8-6.5,21.8-14.4c0-0.5,0-1.2-0.2-1.7C65.3,45.4,66.5,43.7,66.5,41.5z M49.4,42c-1.7,0-3.1,1.4-3.1,3.1c0,1.7,1.4,3.1,3.1,3.1s3.1-1.4,3.1-3.1S51.1,42,49.4,42z"/>
								</svg>
							</span>
						</a>
									</div>
			</div>
					</footer>
		<!-- footer end -->

	</div>
</div>

<script src="data/bundle.js"></script>

</body>

</html>



<?php
	function maintenance() {
		global $languages, $lang;
		echo '<html>
<head>
	<title>'.$lang['maintTitle'].' - Clash of Clans</title>
	<link rel="stylesheet" href="data/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="maint">
';

printGoto();

echo '
	<h1>'.$lang['maintTitle'].'</h1>
	<h4>';

$count = 0;

foreach ($languages as $key => $value) {
	$count++;
	
	echo '<a href="" onclick="goto'.$key.'()">'.$value['language'].'</a>';
	if ($count != count($languages)) {
		echo ' - ';
	}
}

echo '</h4>
	<h3>'.$lang['maintBody'].'</h3>
	<h3>'.$lang['maintBodyFinal'].'</h3>
</body>
<html>';
	}
	
	
	
	function printGoto() {
		global $languages;
		
		echo '<script>';
		
		foreach ($languages as $key => $value) {
			echo '
	function goto'.$key.'() {
		document.cookie = "clanWebLang='.$key.'; expires=Thu, 18 Dec 2200 12:00:00 UTC; path=/";
	}
';
		}
	echo '</script>';
	}
?>
