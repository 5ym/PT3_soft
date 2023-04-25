# PT3_soft

## 概要

PT3専用に設定済みの関連ソフトウェアです。物理cas用に設定してあります。

## 使い方等

Cドライブ直下にTVフォルダを作りそこにEDCBフォルダを入れるように設定してあります  
変更する場合

- EdcbPlugIn.iniの内容変更
- EpgTimerSrvの設定を変更
- 準備.batの記載内容変更
- 後述レジストリディレクトリを変更

準備.batを管理者権限で実行  

ここで一回録画保存先を設定して録画テストをするチューナーオープンをはじかれる場合があるがその場合はbondriverフォルダ内のpt3ctrl.exeを起動してみて開けないdllがあるというエラーがでるのでそのdllを含むランタイムなどを調べていれる

.m2tsファイルとVLCを紐づける  

EpgTimer設定からEpgTimerをスタートアップに追加

TVTestでチャンネルスキャンを実施チャンネルデータをsettingフォルダ内のch2chset.vbsにぶち込むこの時排他要求を出すドライバーを使用してください(viewがついていないもの)

### httppublicのアクセス制限について

EpgTimerSrv.iniのHttpAccessControlListの部分をアクセスを許可するipアドレスを記載

## 視聴アプリ

リアルタイム視聴は下記推奨  
https://github.com/tsukumijima/KonomiTV