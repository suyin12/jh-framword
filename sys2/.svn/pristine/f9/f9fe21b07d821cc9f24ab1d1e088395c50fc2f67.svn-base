<?php

/*
 * *	@desc:		PHP ajax login form using jQuery
 * *	@author:	programmer@chazzuka.com
 * *	@url:		http://www.chazzuka.com/blog
 * *	@date:		15 August 2008
 * *	@license:	Free!, but i'll be glad if i my name listed in the credits'
 */
//@ validate inclusion

require_once sysPath . 'common.function.php';
if (!defined('VALID_ACL_'))
    exit('非法登录,禁止!!');

class Authorization
{

    public function check_status()
    {
        if (empty($_SESSION [SESSION_NAME]) || @$_SESSION [SESSION_NAME] ['expires'] < time()) {
            return false;
        }
        else {
            return true;
        }
    }

    public function form()
    {
        global $ACL_LANG;
        $icp = httpPath . PATH_PRE . "/login/identifyCode.php?tag=1";
        $htmlForm = '<form id="frmlogin">' . '<label>';
        switch (LOGIN_METHOD) {
            case 'both' :
                $htmlForm .= $ACL_LANG ['USERNAME'] . '/' . $ACL_LANG ['MID'];
                break;
            case 'email' :
                $htmlForm .= $ACL_LANG ['EMAIL'];
                break;
            default :
                $htmlForm .= $ACL_LANG ['USERNAME'];
                break;
        }
        $htmlForm .= ':</label>' . '<input type="text" name="u" id="u" class="textfield" />' . '<label>' . $ACL_LANG ['PASSWORD'] . '</label>' . '<input type="password" name="p" id="p" class="textfield" />' . '<label>验证码:<input type="text" id="iCode" name="iCode" size="5"  />' . "<img id='imCode' style='vertical-align: middle;margin-left:10px;' src='" . $icp . "'/>" . '</label><input type="submit" name="btn" id="btn" class="buttonfield" value="' . $ACL_LANG ['LOGIN'] . '" />' . '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../manage/forgot-password.php">忘记密码?</a>' . '</form>';
        return $htmlForm;
    }

    public function pwMcrypt($v)
    {
        require_once sysPath . 'class/mCrypt.class.php';
        $m = new mCrypt();
        $mCryptVal = $m->encrypt($v);
        return $mCryptVal;
    }

    public function signin($u, $p, $iCode)
    {
        global $pdo;
        $return = false;
        if (USEDB) {
            if ($u && $p) {
                $mCryptP = $this->pwMcrypt($p);
                //这里选择用户数据表
                $sql = "SELECT * FROM  " . LOGIN_Table . " WHERE ";
                switch (LOGIN_METHOD) {
                    case 'both' :
                        $sql .= "(mName = :userName OR mID= :mID)";
                        $bindArr = array(":userName" => $u, "mID" => $u);
                        break;
                    case 'email' :
                        $sql .= "Email= :email";
                        $bindArr = array(":email" => $u);
                        break;
                    case 'mID' :
                        $sql .= " mID= mID";
                        $bindArr = array("mID" => $u);
                    default :
                        $sql .= "mName= :userName";
                        $bindArr = array(":userName" => $u);
                        break;
                }
                $sql .= " AND mPW = '" . $mCryptP . "' AND status='1'";

                $rs = $pdo->prepare($sql);
                $rs->execute($bindArr);

                if (!$rs)
                    return false;
                if ($rs->rowCount() && strtolower($_SESSION['iCode']) == strtolower($iCode)) {
                    $ret = $rs->fetch(PDO::FETCH_ASSOC);
                    $this->set_session(array_merge($ret, array('expires' => time() + (60 * 60))));
                    $return = true;
                }
                unset($rs, $sql);
            }
        }
        else {
            $return = false;
        }

        return $return;
    }

    private function set_session($a = false)
    {
        if (!empty($a)) {
            $_SESSION [SESSION_NAME] = $a;

            //同时更新其登陆时间,及其登陆相关信息
            global $pdo;
            $now = timeStyle("dateTime");
            $ip = getRealIpAddr();
            $loginSql = "update `" . LOGIN_Table . "` set `lastLoginTime`='$now',`lastLoginIP`='$ip' where `wID`='".$a['wID']."'";
            $pdo->query($loginSql);
        }
    }

}

?>