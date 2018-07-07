<?php
  $api_key = "3l4fKpPWSX3qrrb8faCma76EM";
  $api_secret = "MC0jlwZmYaJXcGQoB6JFaBgtU5rymXFHveWoucPB7IB64kyKEN";
  $request_url = 'https://api.twitter.com/1.1/statuses/update.json';
  $request_method = 'POST';
  $contents = file_get_contents('C:\TV\EDCB\twitterbot\tweet.txt');
  // パラメータA (リクエストのオプション)
  $params_a = array('status' => $contents);
  // キーを作成する (URLエンコードする)
  $signature_key = rawurlencode($api_secret).'&'.rawurlencode('XYVe3CaEV5zEUllrHsw8SftRAxjnBw9oIoD37KzBU1xgR');
  // パラメータB (署名の材料用)
  $params_b = array(
    'oauth_token' => '3225228042-hjuTXoV3eIJIMhj06HYB7WK2MgvVT9jSDOWww5n',
    'oauth_consumer_key' => $api_key,
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => time(),
    'oauth_nonce' => microtime(),
    'oauth_version' => '1.0'
  );
  // パラメータAとパラメータBを合成してパラメータCを作る
  $params_c = array_merge($params_a, $params_b);
  // 連想配列をアルファベット順に並び替える
  ksort($params_c);
  // パラメータの連想配列を[キー=値&キー=値...]の文字列に変換する
  $request_params = http_build_query($params_c);
  // 一部の文字列をフォロー
  $request_params = str_replace(array('+', '%7E'), array('%20', '~'), $request_params);
  // 変換した文字列をURLエンコードする
  $request_params = rawurlencode($request_params);
  // リクエストメソッドをURLエンコードする
  $encoded_request_method = rawurlencode($request_method);
  // リクエストURLをURLエンコードする
  $encoded_request_url = rawurlencode($request_url);
  // リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
  $signature_data = $encoded_request_method.'&'.$encoded_request_url.'&'.$request_params;
  // キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
  $hash = hash_hmac('sha1', $signature_data, $signature_key, TRUE);
  // base64エンコードして、署名[$signature]が完成する
  $signature = base64_encode($hash);
  // パラメータの連想配列、[$params]に、作成した署名を加える
  $params_c['oauth_signature'] = $signature;
  // パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
  $header_params = http_build_query($params_c, '', ',');
  // リクエスト用のコンテキスト
  $context = array(
    'http' => array(
      'method' => $request_method,
      'header' => array('Authorization: OAuth '.$header_params)
    )
  );
  // パラメータがある場合、URLの末尾に追加
  if ($params_a) {
  	$request_url .= '?'.http_build_query($params_a);
  }
  // cURLを使ってリクエスト
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $request_url);
  curl_setopt($curl, CURLOPT_HEADER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $context['http']['method']);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $context['http']['header']);
  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
  $res1 = curl_exec($curl);
  $res2 = curl_getinfo($curl);
  curl_close($curl);
  // 取得したデータ
  $json = substr($res1, $res2['header_size']);
  $header = substr($res1, 0, $res2['header_size']);
