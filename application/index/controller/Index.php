<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\User;
use app\common\controller\FileUtil;
class Index extends Controller
{
    public function index()
    {
        if(Session::has('name'))
        {
            $id = Session::get('name');
            $loginModel = new User();
            $res = $loginModel->getUserInfo($id);
            $this ->assign('public',$res);
            return $this->fetch();
        }
        else{
            return $this->redirect('Index/login/login');
        }

    }

    public function test()
    {
        $fu  = new FileUtil();
        $mkdir = "public/static/images/1";
        $fu->createDir($mkdir);
        //return $this->fetch();
    }

    public function showstyle()
    {
        $xcid = $_GET['xcid'];
        $name = 'showstyle' .$xcid ;
        return $this->fetch($name);
    }

    public function uploadimg(){
        return $this->fetch();
    }

    public function upload(){
        $id = Session::get('name');
        $uid= $id[0]['userid'];
        if(empty($uid)){
            return $this->redirect('Index/login/login');
        }
        $fu  = new FileUtil();
        $mkdir = "public/static/images/".$uid;
        $fu->createDir($mkdir);
        if (!empty($_FILES)) {
            $tempFile = $_FILES['fileList']['tmp_name'];
            $tempFilename = $_FILES['fileList']['name'];
            $fileType = $this ->getImagetype($tempFile);
            if($fileType == '只能上传图片类型格式'){
                echo json_encode( ['code'=>300, 'msg'=>'只能上传图片类型格式！']);
                return ;
            }
            if(preg_match('/.+(.JPEG|.jpeg|.JPG|.jpg|.GIF|.gif|.BMP|.bmp|.PNG|.png)$/',$tempFilename)){
                $targetFile =  "static/images/".$uid."/".$_FILES['fileList']['name'];
                move_uploaded_file($tempFile, $targetFile);
                echo json_encode( ['code'=>200, 'msg'=>'上传文件成功！']);
            }
            else{
                echo json_encode( ['code'=>300, 'msg'=>'上传文件失败！']);
            }
        }


    }

    //*判断图片上传格式是否为图片 return返回文件后缀
    public function getImagetype($filename)
    {
        $file = fopen($filename, 'rb');
        $bin  = fread($file, 2); //只读2字节
        fclose($file);
        $strInfo  = @unpack('C2chars', $bin);
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        // dd($typeCode);
        $fileType = '';
        switch ($typeCode) {
            case 255216:
                $fileType = 'jpg';
                break;
            case 7173:
                $fileType = 'gif';
                break;
            case 6677:
                $fileType = 'bmp';
                break;
            case 13780:
                $fileType = 'png';
                break;
            default:
                $fileType = '只能上传图片类型格式';
        }
        // if ($strInfo['chars1']=='-1' AND $strInfo['chars2']=='-40' ) return 'jpg';
        // if ($strInfo['chars1']=='-119' AND $strInfo['chars2']=='80' ) return 'png';
        return $fileType;
    }

    public function addalbum(){
        return $this->fetch();
    }


}
