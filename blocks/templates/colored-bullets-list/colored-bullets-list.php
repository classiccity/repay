<!-- start : repay/app/public/wp-content/themes/repay/blocks/templates/colored-bullets-list/colored-bullets-list.php -->
<?php
	include(get_theme_file_path().'/blocks/blocks.settings.php');

	$block_name = prefix() . '-colored-bullets-list';

	$list = get_field('list');

?>
<ul class="<?php echo $block_name . ' ' . $all_classes; ?>" <?php if( !empty( $id )) echo "id='$id'"; ?>>
	<?php foreach($list as $li):
		// var_dump($li);
		$bullet_color = $li['bullet_color'];
		$text = $li['text'];
	?>
	<li style="--bullet-color:<?=$bullet_color?>"><?=$text?></li>
	<?php
		endforeach;
	?>
</ul>
<!-- end : repay/app/public/wp-content/themes/repay/blocks/templates/colored-bullets-list/colored-bullets-list.php -->