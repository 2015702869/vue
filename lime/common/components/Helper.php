<?php
namespace app\common\components;
class Helper
{
    public function encryption ($password)
    {
        return $password = password_hash($password,PASSWORD_DEFAULT);
    }
    public function decryption ($password,$hash)
    {
		if (password_verify($password, $hash)) {
		    return true;
		} else {
		    return false;
		}
    }
}