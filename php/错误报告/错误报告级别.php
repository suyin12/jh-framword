<?php
////报告所有除了用户导致的错误
//error_reporting('E_ALL&~(E_USER_ERROR|E_USER_WARNING|E_USER_NOTICE)');
////抛出任何非注意的错误,默认值
//error_reporting('E_ALL&~E_NOTICE');
////值考虑致命错误,解析错误和核心错误
//error_reporting('E_ERROR|E_CORE_ERROR|E_PARSE');
////除了注意和警告外的所有错误信息
//error_reporting('E_ALL&~(E_WARNING|E_NOTICE)');

//trigger_error('a error',E_WARNING);