<?php

namespace api\controllers;
use app\common\models\Uploadfile;
use yii\rest\ActiveController;
class UploadfileController extends ActiveController
{


    public function actionIndex()
    {
        if(!empty($_FILES['file'])){
            //获取扩展名
            $exename  = $this->getExeName($_FILES['file']['name']);
            if($exename != 'png' && $exename != 'jpg' && $exename != 'gif'){
                exit('不允许的扩展名');
            }
            $imageSavePath = uniqid().'.'.$exename;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $imageSavePath)){
                echo $imageSavePath;
            }
        }
    }

    public function getExeName($fileName)
    {
        $pathinfo      = pathinfo($fileName);
        return strtolower($pathinfo['extension']);
    }


}
