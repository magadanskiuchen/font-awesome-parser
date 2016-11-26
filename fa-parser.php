<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'fa-config.php');

$css = file_get_contents(FA_SRC_DIR . 'font-awesome.min.css');
$options = array();

function get_label_from_class($class) {
	return ucwords(str_replace('-', ' ', $class));
}

function get_entity_from_hex($hex) {
	return '&#' . hexdec($hex) . ';';
}

preg_match_all('/(\.fa-([^:]+):before,?)*?{content:"\\\([0-9a-f]{4})"}/iums', $css, $icons);

foreach ($icons[0] as $i => $icon) {
	preg_match_all('/fa-([^:]+):before,?/iums', $icon, $selectors);
	
	foreach ($selectors[1] as $selector) {
		$options['fa-' . $selector] = get_label_from_class($selector) . ' (' . get_entity_from_hex($icons[3][$i]) . ')';
	}
}

file_put_contents(FA_DEST_DIR . 'fa-json.json', json_encode($options));
?>