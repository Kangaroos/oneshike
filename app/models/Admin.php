<?php
/**
 * 管理员
 */
class Admin extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'admins';

    public function hasLogin(array $credentials = array(), $remember = false, $login=true)
    {
        $admin = $this::where('account', $credentials['account'])->find(1);
        if ($this->hasValidCredentials($admin, $credentials))
        {
            if ($login) $this->login($admin, $remember);

            return true;
        }
        return false;
    }

    protected function hasValidCredentials(Admin $admin, array $credentials)
    {
        return ! is_null($admin) && $this->validateCredentials($admin, $credentials);
    }

    public function validateCredentials(Admin $admin, array $credentials)
    {
        $plain = $credentials['pwd'];

        return Hash::check($plain, $admin->pwd);
    }

    public function login(Admin $admin, $remember = false)
    {
        $this->updateSession($admin);

        if ($remember)
        {
//            $this->createRememberTokenIfDoesntExist($admin);
//
//            $this->queueRecallerCookie($admin);
        }
    }

    protected function createRememberTokenIfDoesntExist(Admin $admin)
    {
        if (is_null($admin->getRememberToken()))
        {
            $this->refreshRememberToken($admin);
        }
    }

    protected function refreshRememberToken(Admin $user)
    {
        $user->setRememberToken($token = str_random(60));

        $this->provider->updateRememberToken($user, $token);
    }

    public function updateRememberToken(Admin $admin, $token)
    {
        $admin->setAttribute($admin->getRememberTokenName(), $token);

        $admin->save();
    }

    protected function updateSession(Admin $admin)
    {
        Session::put("admin", $admin);

        Session::migrate(true);
    }


    /**
     * 调整器：密码
     * @param  string $value 未处理的密码字符串
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // 若传入的字符串已经进行了 Hash 加密，则不重复处理
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}