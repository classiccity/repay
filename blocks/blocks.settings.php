<?php
$id = $block['id']; // Block ID
$align = $block['align'] ? 'align' . $block['align'] : ''; // Align Class
$class = key_exists('className', $block) ? $block['className'] : ''; // Block Custom Classes

$all_classes = $class . " " . $align;