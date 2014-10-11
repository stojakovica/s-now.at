<div class="imageGallery clearfix">
<?php
$medien = split(",", "REX_MEDIALIST[1]");
foreach ($medien as $m) {
	$media = OOMedia::getMediaByFileName($m);
	$title = $media->getTitle();
	if (!$title) $title = $this->getValue('name');
	echo '<div>';
	echo '<a rel="lightbox-arc" href="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=fileBig&rex_img_file='.$m.'" title="'.$title.'">';
	echo '<img src="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=fileSmall&rex_img_file='.$m.'" />';
	echo '</a>';
	echo '</div>';
}
?>
</div>