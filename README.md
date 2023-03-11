# think-captcha

thinkphp6 验证码类库 ，适用于前后端分离模式，api接口验证码使用场景

## 安装
> composer require dysix/think-captcha



## 使用

### 注册路由

首先在你应用的路由定义文件中，注册一个验证码路由规则

~~~php
//验证码接口
Route::get('captcha', 'Login/captcha');
//验证码图形展示接口
Route::get('captcha/:id', 'Login/showCaptcha');
~~~

### 控制器输出验证码信息

首先请求获取验证码信息

~~~php
    //获取验证码信息
    public function captcha()
    {
        //验证码唯一标识
        $uniqid = uniqid((string)mt_rand(100000, 999999));
        $src = (string)\think\facade\Route::buildUrl('/manage/captcha/' . $uniqid)->domain(true);
        $data = [
            'src'    => $src,
            'uniqid' => $uniqid,
        ];
        $this->result(200, '获取成功', $data);
    }
~~~

获取到的验证码数据

```json
{
	"src": "http://domain/captcha/720807640afff8834bd",
	"uniqid": "720807640afff8834bd"
}
```

前端图片使用返回的链接展示验证码图片

```html
<img src="http://domain/captcha/720807640afff8834bd">
```

控制器输出验证码图片

~~~php
	//获取验证码图片
    public function showCaptcha($id)
    {
        return captcha($id);
    }
~~~
### 控制器里验证

需将`验证码图片内容`与`uniqid`一起提交

~~~php
	//登录
    public function index()
    {
    	$input = $this->request->post('', null, ['trim']);
    	if(!captcha_check($input['captcha'], $input['uniqid'])){
            $this->result(400, '验证码错误');
        }
    }
~~~