c:\windows\sysWOW64/regsvr32 C:\TV\TVTest\TvtAudioStretchFilter.ax
sc create "EpgTimer Service" start= auto binPath= "C:\TV\EDCB\EpgTimerSrv.exe"
sc start "EpgTimer Service"
