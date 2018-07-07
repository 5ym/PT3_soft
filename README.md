# 自分用
## PT3専用に設定済みの関連ソフトウェアです。物理cas用に設定してあります。EDCBPluginを用いてTVTestでEDCBを置き換えてます。
### 使い方等
Cドライブ直下にTVフォルダを作りそこにEDCB、Spinel、TVTestフォルダを入れるように設定してあります  
変更する場合  
- EdcbPlugIn.iniの内容変更
- EpgTimerSrvの設定を変更
- TVTestのEPG読み込みフォルダを変更
- 準備.batの記載内容変更
- PostRecStart.batの内容変更
- tweet.phpの内容変更
- 後述レジストリディレクトリを変更

準備.batを管理者権限で実行  
TVTestの音声フィルタをTvAudioStretchFilterに変更する

ここで一回spinelとtvtestを起動して録画保存先を設定して録画テストをするspinelにチューナーオープンをはじかれる場合があるがその場合はbondriverフォルダ内のpt3ctrl.exeを起動してみて開けないdllがあるというエラーがでるのでそのdllを含むランタイムなどを調べていれる

.tsファイルとTVTestを紐づける  
レジストリエディタでコンピューター\HKEY_CLASSES_ROOT\Applications\TVTest.exe\shell\open\commandを開き"C:\TV\TVTest\TVTest.exe" /d BonDriver_Pipe.dll "%1"に変更する

Spinelをスタートアップに登録、EpgTimer設定からEpgTimerをスタートアップに追加

TVTestでチャンネルスキャンを実施チャンネルデータをsettingフォルダ内のch2chset.vbsにぶち込む

#### Twitter投稿機能に関して
まずPHPを入れてパスを通す(PHP Curl等でエラー出る可能性あり別途要設定)  
tweet.phpにCK/CS/AT/ASを記述  
ツイートされる内容は  
録画開始がPostRecStart.batを編集  
録画終了がPostRecEnd.batを編集  
通知(Epg取得開始、予約情報更新、録画情報更新)がPostNorify.batを編集

#### httppublicのアクセス制限について
EpgTimerSrv.iniのHttpAccessControlListの部分をアクセスを許可するipアドレスを記載

#### 視聴について
そのままedcb自体が入っているpcで視聴するとtvtestを録画に使用(bondriverが排他要求を出すため)しているため視聴中に録画が開始した際録画に失敗するため排他要求を出さないように設定したbondriverで視聴するようにしてください尚driverと視聴用batファイルは準備済みなのでtvtestフォルダ内のチャンネルファイル(.ch2)をviewフォルダにコピーしてくださいあとはt1.batファイルを実行するとt1ドライバー(一般的に地デジ)で視聴s1.batで視聴するとs1ドライバー(一般的に衛星放送)で視聴できます
