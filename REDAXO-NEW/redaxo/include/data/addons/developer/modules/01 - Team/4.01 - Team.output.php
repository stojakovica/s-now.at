<div class="team clearfix">
	<h1>REX_VALUE[1]</h1>
	<?php
	$subcat = explode(",", "REX_LINKLIST[1]");
	foreach($subcat as $article) {
		$a = OOArticle::getArticleById($article);
		if(!$a->isOnline()) continue;
		if($a->isStartArticle()) continue;
		$img = $a->getFile();
		$title = $a->getName();
		$description = $a->getDescription();
		$description = htmlspecialchars_decode($description);
		$description = str_replace("<br />","",$description);
		$description = rex_a79_textile($description);
		$description = str_replace("###","&#x20;",$description);
		?>
		<div class="teamBlock">
			<div class="img">
				<img src="<?php $REX['HTDOCS_PATH']; ?>index.php?rex_img_type=team&rex_img_file=<?php echo $img; ?>" />
			</div>
			<div class="content">
				<h2><?php echo $title?></h2>
				<?php echo $description; ?>
			</div>
		</div>
		<?php
	}
	?>
</div>