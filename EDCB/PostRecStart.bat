set a=録画を開始しました
set b=$STHH$:$STMM$〜$ETHH$:$ETMM$$ServiceName$
set c=$Title$
set d=@5dyui
chcp 65001
echo %a%>C:\TV\EDCB\twitterbot\tweet.txt
echo %b%>>C:\TV\EDCB\twitterbot\tweet.txt
echo %c%>>C:\TV\EDCB\twitterbot\tweet.txt
echo %d%>>C:\TV\EDCB\twitterbot\tweet.txt
php C:\TV\EDCB\twitterbot\tweet.php