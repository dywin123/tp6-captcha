# tp6-captcha

thinkphp6 验证码类库 ，适用于前后端分离模式，api接口验证码使用场景

## 安装
> composer require dysix/tp6-captcha



## 使用

### 注册路由

首先在应用的路由定义文件中，注册验证码路由规则

~~~php
//展示验证码图形
Route::get('captcha/:id', function(){
    return \Dysix\Tp6Captcha\facade\Captcha::create($id);
});
//验证码接口
Route::get('captcha', function (){
        //验证码唯一标识
        $uniqid = uniqid((string)mt_rand(100000, 999999));
        $src = (string)\think\facade\Route::buildUrl('/captcha/' . $uniqid)->domain(true);
        $data = [
            'src'    => $src,
            'uniqid' => $uniqid,
        ];
        return json($data);
});
~~~

### 获取验证码

首先请求`验证码接口`获取信息，获取到的验证码数据如图示

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

### 验证

需将`验证码`与`uniqid`一起提交验证

~~~php
	//登录
    public function index()
    {
    	$input = $this->request->post('', null, ['trim']);
    	if(!\Dysix\Tp6Captcha\facade\Captcha::check($input['captcha'], $input['uniqid'])){
            return json(['code' => 400, 'msg' => '验证码错误');
        }
    }
~~~