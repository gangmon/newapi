<?php
namespace api\controllers;

use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use frontend\models\User;
use Yii;


class AppidController extends Controller
{
//    public $modelClass = 'frontend/model/User';

    public function getcurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        $content = curl_exec($ch);
        $statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        if ($statusCode == 404)
        {
            return "404";
        }
        curl_close($ch);
        $conArr = ArrayHelper::toArray($content);
        $conJson = json_encode($conArr,true);

        return $content;
    }

    public function actionIndex()
    {
//        $code = isset($_REQUEST['code']);
        //获取前端传来的code
        $code = Yii::$app->request->get('code');
        if ($code)
        {
            $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx2f44d41564140f7f&secret=de27bae6891e039c3b67909ddb645b57&js_code=".$code."&grant_type=authorization_code";
            $res = $this->getcurl($url);
            echo $res;
            return;
//            print_r($res);
            print_r("--------------------------------------------------");
        }
        else
            {
                $openid = Yii::$app->request->get('info');
                print_r("oooook");
//                die();
//                $userInfo = $_REQUEST['userInfo'];
//                $quResult = Yii::$app->db
//                    ->createCommand("SELECT * FROM test_user where openid=:openid")
//                    ->bindValue(':openid',$openid)
//                    ->queryOne();
                if ($openid)
                {
                    print_r('ok');
                    print_r($openid);
                }else{print_r('not ok');}

            }



    }

    public function actionTest(){
        $code = Yii::$app->request->get('code');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx2f44d41564140f7f&secret=de27bae6891e039c3b67909ddb645b57&js_code=".$code."&grant_type=authorization_code";
        $contents = file_get_contents($url);
        $data = json_decode($contents,true);
//        $user = Yii::$app->applet
//            ->makeSession($data['data'])
//            ->getUser($data['encryptedData'],$data['iv']);
        return $data;
    }

//        $resStr = json_decode($res,true);
//        $resArr = json_encode($resStr,true);
//        print_r($resArr['data']);
//        $resArr =
//        $openid = $resStr['openid'];


//        print_r($resarray);

//        echo json_encode($res);
//        if ($res.data.openid)

//        return $res;


    public function actionSearch()
    {

        $open = Yii::$app->request->post('info');
//                die();
//                $userInfo = $_REQUEST['userInfo'];
//                $quResult = Yii::$app->db
//                    ->createCommand("SELECT * FROM test_user where openid=:openid")
//                    ->bindValue(':openid',$openid)
//                    ->queryOne();
        if ($open)
        {
            $arr = ArrayHelper::toArray($open);
            $openHs = json_encode($open);
            $openArr = ArrayHelper::toArray($openHs);

            print_r('ok');
            print_r($arr);
            print_r($openArr);
        }else{print_r('not ok');}
//        die();
        $openid = $_POST['openid'];
        $userInfo = $_REQUEST['userInfo'];

        $quResult = Yii::$app->db
            ->createCommand("SELECT * FROM test_user where openid=:openid")
            ->bindValue(':openid',$openid)
            ->queryOne();
        if (!$quResult)
        {
            return json_encode('ok',true);
        }else{return json_encode("not ok",true);}

    }



    public function actionTemplate()
    {
        /*
        $url_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx2f44d41564140f7f&secret=de27bae6891e039c3b67909ddb645b57";
//        $access_token = $this->getcurl($url_token);
        $access_token = $this->get_access_token();
        print_r($access_token);
        */

        $appid = 'wx2f44d41564140f7f';
        $secret = 'de27bae6891e039c3b67909ddb645b57';


        $url_access_token = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;

        $json_access_token = $this -> sendCmd($url_access_token,array());

        $arr_access_token = json_decode($json_access_token,true);

        $access_token = $arr_access_token['access_token'];
        $url = "https://api.weixin.qq.com/cgi-bin/wxopen/template/library/list?access_token=".$access_token;
//
        $data = array();
        $data['offset'] = Yii::$app->request->post('offset');
        $data['count'] = Yii::$app->request->post('count');
        $data = json_encode($data);
////        print_r($data);
//        $data = '{"offset":0,"count":5}';

        $result = $this -> sendCmd($url,$data);

        return $result;


    }
    public function actionSendmsg()
    {
        $appid = 'wx2f44d41564140f7f';
        $secret = 'de27bae6891e039c3b67909ddb645b57';


        $url_access_token = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;

        $json_access_token = $this -> sendCmd($url_access_token,array());

        $arr_access_token = json_decode($json_access_token,true);

        $access_token = $arr_access_token['access_token'];

        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=".$access_token;
        $data = array();
        $data['form_id'] = Yii::$app->request->post('form_id');
        $data['touser'] = Yii::$app->request->post('touser');
        $data['template_id'] = Yii::$app->request->post('template_id');
        $data['data'] = Yii::$app->request->post('data');


        $data = json_encode($data);

        $result = $this -> sendCmd($url,$data);

        return $result;

    }






    public function get_access_token(){
        $appid = "wx2f44d41564140f7f";
        $secret = "de27bae6891e039c3b67909ddb645b57";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
        return $data = $this->curl_get($url);
    }
    public function get_http_array($url,$post_data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //没有这个会自动输出，不用print_r();也会在后面多个1
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $out = json_decode($output);
        return $out;
    }


    public function curl_get($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $data;
    }
    //获得二维码
    public function get_qrcode() {
        header('content-type:image/gif');
        //header('content-type:image/png');格式自选，不同格式貌似加载速度略有不同，想加载更快可选择jpg
        //header('content-type:image/jpg');
        $uid = 6;
        $data = array();
        $data['scene'] = "uid=" . $uid;
//        $data['scene'] = "uid=" . $uid;

        $data['page'] = "pages/index";
//        print_r($data);
//        $data = json_encode($data);
//        print_r($data);
        $access = json_decode($this->get_access_token(),true);
//        print_r($access);
        $access_token = $access['access_token'];
//        print_r($access_token);
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        return $data = $this->curl_get($url);
//        $da = $this->get_http_array($url,$data);

//        return $da;
        //这里强调显示二维码可以直接写该访问路径，同时也可以使用curl保存到本地，详细用法可以加群或者加我扣扣
    }

//    public function actionQrcode()
//    {
//        return $this->get_qrcode();
//    }


    /**
     * @param  $is_weixin bool true表示从微信中获取false表示从数据库中获取
     */
    public function actionGettoken()
    {
        $is_weixin = Yii::$app->request->get('code');
        if ($is_weixin)
        {
//            $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx2f44d41564140f7f&secret=de27bae6891e039c3b67909ddb645b57&js_code=".$code."&grant_type=client_credential";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx2f44d41564140f7f&secret=de27bae6891e039c3b67909ddb645b57";
            $res = $this->getcurl($url);
            echo $res;
            return;
//            print_r($res);
            print_r("--------------------------------------------------");
        }
        else
        {
            $openid = Yii::$app->request->get('info');
            print_r("oooook");
//                die();
//                $userInfo = $_REQUEST['userInfo'];
//                $quResult = Yii::$app->db
//                    ->createCommand("SELECT * FROM test_user where openid=:openid")
//                    ->bindValue(':openid',$openid)
//                    ->queryOne();
            if ($openid)
            {
                print_r('ok');
                print_r($openid);
            }else{print_r('not ok');}

        }
    }

    public function actionQrcode()
    {
        //拿到wxid和uid  查找经销商表内是否有该用户  没有则拒绝生成二维码   有则查看是否已生成二维码   有生成则发送数据   没有则生成
//        $where = array('wxid'=>$_REQUEST['wxid'],'uid'=>$_REQUEST['uid']);
//        $dealer = M('r') -> where($where) -> find();


        $appid = 'wx2f44d41564140f7f';
        $secret = 'de27bae6891e039c3b67909ddb645b57';
//                $wxid = $_REQUEST['wxid'];
        $wxid = 13;

        $url_access_token = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;

        $json_access_token = $this -> sendCmd($url_access_token,array());

        $arr_access_token = json_decode($json_access_token,true);

        $access_token = $arr_access_token['access_token'];

        if(!empty($access_token)) {

//            $url = 'https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token='.$access_token;
            $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$access_token;

//                    $data = '{"path": "pages/my/my?superwxid='.$dealer['superior_level_wxid'].'&topwxid='.$dealer['top_level_wxid'].'", "width": 430}';
            $data = '{"scene":6,"path": "pages/my/my", "width": 430}';

            $result = $this -> sendCmd($url,$data);
            $name = $wxid.time();
            file_put_contents('./qrcode/code-'.$name.'.jpg',$result);

            //存储二维码路径

            $arr = array('code'=>1,'msg'=> 'newapi/api/web/qrcode/code-'.$name.'.jpg');
            return($arr);

        } else {

            $arr = array('code'=>0,'msg'=>'ACCESS TOKEN为空！');
//            $this -> ajaxReturn($arr);
            return $arr;
        }

/*
        if($dealer){

            if($dealer['qrcode'] == ''){

                $appid = 'wx2f44d41564140f7f';
                $secret = 'de27bae6891e039c3b67909ddb645b57';
//                $wxid = $_REQUEST['wxid'];
                $wxid = 13;

                $url_access_token = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;

                $json_access_token = $this -> sendCmd($url_access_token,array());

                $arr_access_token = json_decode($json_access_token,true);

                $access_token = $arr_access_token['access_token'];

                if(!empty($access_token)) {

                    $url = 'https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token='.$access_token;

//                    $data = '{"path": "pages/my/my?superwxid='.$dealer['superior_level_wxid'].'&topwxid='.$dealer['top_level_wxid'].'", "width": 430}';
                    $data = '{"path": "pages/my/my", "width": 430}';

                    $result = $this -> sendCmd($url,$data);
                    $name = $wxid.time();
                    file_put_contents('./Uploads/qrcode/code-'.$name.'.jpg',$result);

                    //存储二维码路径

                    $arr = array('code'=>1,'msg'=>'/Uploads/qrcode/code-'.$name.'.jpg');
                    $this -> ajaxReturn($arr);

                } else {

                    $arr = array('code'=>0,'msg'=>'ACCESS TOKEN为空！');
                    $this -> ajaxReturn($arr);
                }


            }else{
                echo '获取二维码';
            }


        }else{
            $arr = array('code'=>0,'msg'=>'');
            $this -> ajaxReturn($arr);
        }


        */

    }

    /**
     * 发起请求
     * @param  string $url  请求地址
     * @param  string $data 请求数据包
     * @return   string      请求返回数据
     */
    function sendCmd($url,$data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:')); //解决数据包大不能提交
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    }


}