<?php

function cache_set($key, $value, $expire=300) {
	$redis = new Redis();
	$redis->connect('192.168.199.249',6379);
	$value = serialize($value);
	return $redis->setex($key, $expire, $value);
}

function cache_get($key) {
	$redis = new Redis();
	$redis->connect('192.168.199.249',6379);
	$value = $redis->get($key);
	$value = unserialize($value);
	return $value;
}