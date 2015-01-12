<div class="imageGallery clearfix">
<?php
$medien = split(",", "REX_MEDIALIST[1]");
foreach ($medien as $m) {
	$media = OOMedia::getMediaByFileName($m);
	$title = $media->getTitle();
	if (!$title) $title = $this->getValue('name');
	echo '<div class="text-center">';
	echo '<img src="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=fileSmall&rex_img_file='.$m.'" />';
	echo '</div>';
}
?>
</div>