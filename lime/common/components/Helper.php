<?php
namespace app\common\components;
class Helper
{
	/**
	 * [encryption description]
	 * @param  [str] $password [密码]
	 * @return [str]           [加密后密码]
	 */
    public function encryption ($password)
    {
        return $password = password_hash($password,PASSWORD_DEFAULT);
    }
    /**
     * [decryption description]
     * @param  [str] $password [密码]
     * @param  [str] $hash     [解密密码]
     * @return [bool]           [真假状态]
     */
    public function decryption ($password,$hash)
    {
		if (password_verify($password, $hash)) {
		    return true;
		} else {
		    return false;
		}
    }
}