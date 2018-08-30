<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('frank_jewelry_store_storage_get')) {
	function frank_jewelry_store_storage_get($var_name, $default='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		return isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('frank_jewelry_store_storage_set')) {
	function frank_jewelry_store_storage_set($var_name, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		$FRANK_JEWELRY_STORE_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('frank_jewelry_store_storage_empty')) {
	function frank_jewelry_store_storage_empty($var_name, $key='', $key2='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]);
		else
			return empty($FRANK_JEWELRY_STORE_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('frank_jewelry_store_storage_isset')) {
	function frank_jewelry_store_storage_isset($var_name, $key='', $key2='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]);
		else
			return isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('frank_jewelry_store_storage_inc')) {
	function frank_jewelry_store_storage_inc($var_name, $value=1) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (empty($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = 0;
		$FRANK_JEWELRY_STORE_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('frank_jewelry_store_storage_concat')) {
	function frank_jewelry_store_storage_concat($var_name, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (empty($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = '';
		$FRANK_JEWELRY_STORE_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('frank_jewelry_store_storage_get_array')) {
	function frank_jewelry_store_storage_get_array($var_name, $key, $key2='', $default='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][$key2]) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('frank_jewelry_store_storage_set_array')) {
	function frank_jewelry_store_storage_set_array($var_name, $key, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if ($key==='')
			$FRANK_JEWELRY_STORE_STORAGE[$var_name][] = $value;
		else
			$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('frank_jewelry_store_storage_set_array2')) {
	function frank_jewelry_store_storage_set_array2($var_name, $key, $key2, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key])) $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][] = $value;
		else
			$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('frank_jewelry_store_storage_merge_array')) {
	function frank_jewelry_store_storage_merge_array($var_name, $key, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if ($key==='')
			$FRANK_JEWELRY_STORE_STORAGE[$var_name] = array_merge($FRANK_JEWELRY_STORE_STORAGE[$var_name], $value);
		else
			$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = array_merge($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('frank_jewelry_store_storage_set_array_after')) {
	function frank_jewelry_store_storage_set_array_after($var_name, $after, $key, $value='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if (is_array($key))
			frank_jewelry_store_array_insert_after($FRANK_JEWELRY_STORE_STORAGE[$var_name], $after, $key);
		else
			frank_jewelry_store_array_insert_after($FRANK_JEWELRY_STORE_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('frank_jewelry_store_storage_set_array_before')) {
	function frank_jewelry_store_storage_set_array_before($var_name, $before, $key, $value='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if (is_array($key))
			frank_jewelry_store_array_insert_before($FRANK_JEWELRY_STORE_STORAGE[$var_name], $before, $key);
		else
			frank_jewelry_store_array_insert_before($FRANK_JEWELRY_STORE_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('frank_jewelry_store_storage_push_array')) {
	function frank_jewelry_store_storage_push_array($var_name, $key, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($FRANK_JEWELRY_STORE_STORAGE[$var_name], $value);
		else {
			if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key])) $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = array();
			array_push($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('frank_jewelry_store_storage_pop_array')) {
	function frank_jewelry_store_storage_pop_array($var_name, $key='', $defa='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]) && is_array($FRANK_JEWELRY_STORE_STORAGE[$var_name]) && count($FRANK_JEWELRY_STORE_STORAGE[$var_name]) > 0) 
				$rez = array_pop($FRANK_JEWELRY_STORE_STORAGE[$var_name]);
		} else {
			if (isset($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]) && is_array($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]) && count($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('frank_jewelry_store_storage_inc_array')) {
	function frank_jewelry_store_storage_inc_array($var_name, $key, $value=1) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if (empty($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key])) $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = 0;
		$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('frank_jewelry_store_storage_concat_array')) {
	function frank_jewelry_store_storage_concat_array($var_name, $key, $value) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if (!isset($FRANK_JEWELRY_STORE_STORAGE[$var_name])) $FRANK_JEWELRY_STORE_STORAGE[$var_name] = array();
		if (empty($FRANK_JEWELRY_STORE_STORAGE[$var_name][$key])) $FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] = '';
		$FRANK_JEWELRY_STORE_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('frank_jewelry_store_storage_call_obj_method')) {
	function frank_jewelry_store_storage_call_obj_method($var_name, $method, $param=null) {
		global $FRANK_JEWELRY_STORE_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('frank_jewelry_store_storage_get_obj_property')) {
	function frank_jewelry_store_storage_get_obj_property($var_name, $prop, $default='') {
		global $FRANK_JEWELRY_STORE_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($FRANK_JEWELRY_STORE_STORAGE[$var_name]->$prop) ? $FRANK_JEWELRY_STORE_STORAGE[$var_name]->$prop : $default;
	}
}
?>