<?php
function str_to_id($str) {
	return strtolower(str_replace(' ', '_', str_replace('-', '_', $str)));
}