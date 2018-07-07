<?php
	$oauth_params = [
		'oauth_consumer_key'     => '3l4fKpPWSX3qrrb8faCma76EM',
		'oauth_signature_method' => 'HMAC-SHA1',
		'oauth_timestamp'        => time(),
		'oauth_version'          => '1.0',
		'oauth_nonce'            => bin2hex(openssl_random_pseudo_bytes(16)),
		'oauth_token'            => '3225228042-hjuTXoV3eIJIMhj06HYB7WK2MgvVT9jSDOWww5n',
	];
	// oauth_signature生成まで使われる追加パラメータ
	$additional_params = [
		'status'                => file_get_contents('C:\TV\EDCB\twitterbot\tweet.txt')
	];
	// ベース
	$base = $oauth_params + $additional_params;
	// キー
	$key = ['MC0jlwZmYaJXcGQoB6JFaBgtU5rymXFHveWoucPB7IB64kyKEN', 'XYVe3CaEV5zEUllrHsw8SftRAxjnBw9oIoD37KzBU1xgR'];
	uksort($base, 'strnatcmp');
	$oauth_params['oauth_signature'] = base64_encode(hash_hmac(
		'sha1',
		implode('&', array_map('rawurlencode', [
			'POST',
			'https://api.twitter.com/1.1/statuses/update.json',
			http_build_query($base, '', '&', PHP_QUERY_RFC3986)
		])),
		implode('&', array_map('rawurlencode', $key)),
		true
	));
	foreach ($oauth_params as $name => $value) {
		$items[] = sprintf('%s="%s"', urlencode($name), urlencode($value));
	}
	$header = 'Authorization: OAuth ' . implode(', ', $items);
	// cURLを使ってリクエスト
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/update.json');
	curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($additional_params, '', '&'));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [$header]);
	$res1 = curl_exec($curl);
	$res2 = curl_getinfo($curl);
	curl_close($curl);
	// 取得したデータ
	$json = substr($res1, $res2['header_size']);
	$header = substr($res1, 0, $res2['header_size']);
	var_dump($json);
