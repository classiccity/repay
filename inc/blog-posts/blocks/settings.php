<?php
$id = $block['id']; // Block ID
$align = $block['align'] ? 'align' . $block['align'] : ''; // Align Class
$class = (isset($block['className'])) ? $block['className'] : ''; // Block Custom Classes

$all_classes = $class . " " . $align;