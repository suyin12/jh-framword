<?php
error_log('搞砸了,赶紧跑路!',1,'su_yin12@qq.com');
if(!get_cfg_var('define_syslog_variables'))
{
    define_syslog_variables();
}
openlog('php7',LOG_PID,LOG_USER);
syslog(LOG_WARNING,'向syslog发送的演示,警告时间'.date('Y-m-d H:i:s',time()));
closelog();
echo "鍚憇yslog鍙戦€佺殑婕旂ず,璀﹀憡鏃堕棿2017-12-29 14:03:02";