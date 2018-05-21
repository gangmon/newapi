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


}