<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/4
 * Time: 下午5:50
 */
namespace App\Functions;
/**
 * 图片类
 * @version 1.0
 *
 * PHP默认只识别application/x-www.form-urlencoded标准的数据类型。
 * 因此，对型如text/xml 或者 soap 或者 application/octet-stream 之类的内容无法解析，如果用$_POST数组来接收就会失败！
 * 故保留原型，交给$GLOBALS['HTTP_RAW_POST_DATA'] 来接收。
 * 另外还有一项 php://input 也可以实现此这个功能
 * php://input 允许读取 POST 的原始数据。和 $HTTP_RAW_POST_DATA 比起来，它给内存带来的压力较小，并且不需要任何特殊的 php.ini 设置。php://input和 $HTTP_RAW_POST_DATA 不能用于 enctype="multipart/form-data"。
 */
class imageUpload {
    const ROOT_PATH = './';
    const FAIL_WRITE_DATA = 'Fail to write data';
    //没有数据流
    const NO_STREAM_DATA = 'The post data is empty';
    //图片类型不正确
    const NOT_CORRECT_TYPE = 'Not a correct image type';
    //不能创建文件
    const CAN_NOT_CREATE_FILE = 'Can not create file';
    //最大文件大小
    const MAX_SIZE = 1000000;
    //定义允许上传的文件扩展名
    const EXT_ARR= array('image/png','image/jpg','image/jpeg','image/gif');
    //上传图片名称
    public $image_name;
    //图片保存名称
    public $save_name;
    //图片保存路径
    public $save_dir;
    //目录+图片完整路径
    public $save_fullpath;
    /**
     * 构造函数
     * @param String $save_name 保存图片名称
     * @param String $save_dir 保存路径名称
     */
    public function __construct($save_name, $save_dir) {
        //set_error_handler ( $this->error_handler () );
        //设置保存图片名称，若未设置，则随机产生一个唯一文件名
        $this->save_name = $save_name ? $save_name :time().rand(0,'99999999');
        //设置保存图片路径，若未设置，则使用年/月/日格式进行目录存储
        $this->save_dir = $save_dir ? self::ROOT_PATH .$save_dir : self::ROOT_PATH .date ( 'Y/m/d' );
        //创建文件夹
        @$this->create_dir ( $this->save_dir );
        //设置目录+图片完整路径
        $this->save_fullpath = $this->save_dir . '/' . $this->save_name;
    }
    //兼容PHP4
    public function image($save_name) {
        $this->__construct ( $save_name );
    }
    public function stream2Image($data) {
        //二进制数据流
        if(!$data){
            $data = file_get_contents ( 'php://input' ) ? file_get_contents ( 'php://input' ) : gzuncompress ( $GLOBALS ['HTTP_RAW_POST_DATA'] );
        }
        $this->save_fullpath = $this->save_fullpath.'.png';
        //数据流不为空，则进行保存操作
        if (! empty ( $data )) {
            //创建并写入数据流，然后保存文件
            if (@$fp = fopen ( $this->save_fullpath, 'w' )) {
                $data = base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $data)));
                fwrite ( $fp, $data);
                fclose ( $fp );
                return $this->save_fullpath;
            }
        } else {
            //没有接收到数据流
            echo ( self::NO_STREAM_DATA );
        }
    }
    /**
     * 创建文件夹
     * @param String $dirName 文件夹路径名
     */
    public function create_dir($dirName, $recursive = 1,$mode=0777) {
        ! is_dir ( $dirName ) && mkdir ( $dirName,$mode,$recursive );
    }
    /**
     * 获取图片信息，返回图片的宽、高、类型、大小、图片mine类型
     * @param String $imageName 图片名称
     */
    public function getimageInfo($imageName = '') {
        $imageInfo = getimagesize ( $imageName );
        if ($imageInfo !== false) {
            $imageType = strtolower ( substr ( image_type_to_extension ( $imageInfo [2] ), 1 ) );
            $imageSize = filesize ( $imageInfo );
            return $info = array ('width' => $imageInfo [0], 'height' => $imageInfo [1], 'type' => $imageType, 'size' => $imageSize, 'mine' => $imageInfo ['mine'] );
        } else {
            //不是合法的图片
            return false;
        }
    }

    public function saveImage($uploadedFile){
        if (!empty($uploadedFile->getError())) {
            switch($uploadedFile->getError()){
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            $this->setInfo($errorCode = 1,$error);

        }
        //原文件名
        $fileName = $uploadedFile->getClientOriginalName();
        //服务器上临时文件名
        $tmpName = $uploadedFile->getPathname();
        //文件大小
        $fileSize =  $uploadedFile->getSize();
        //文件大小
        $dirName =  $uploadedFile->getMimeType();
        //检查文件名
        if (!$fileName) {
            $this->setInfo($errorCode = 1,"请选择文件。");
        }
        //检查目录
        if (@is_dir($this->save_dir) === false) {
            $this->setInfo($errorCode = 1,"上传目录不存在。");
        }
        //检查目录写权限
        if (@is_writable($this->save_dir) === false) {
            $this->setInfo($errorCode = 1,"上传目录没有写权限。");
        }
        //检查是否已上传
        if (@is_uploaded_file($tmpName) === false) {
            $this->setInfo($errorCode = 1,"上传失败。");
        }
        //检查文件大小
        if ($fileSize > self::MAX_SIZE) {
            $this->setInfo($errorCode = 1,"上传文件大小超过限制。");
        }
        //检查扩展名
        if (in_array($dirName, self::EXT_ARR) === false) {
            $this->setInfo($errorCode = 1,"图片格式错误");

        }
        //获得文件扩展名
        $tempArr = explode(".", $fileName);
        $fileExt = strtolower(trim(array_pop($tempArr)));

        if (move_uploaded_file($tmpName, $this->save_fullpath.'.'.$fileExt) === false) {
            $this->setInfo($errorCode = 1,"上传文件失败。");
        }
        $this->setInfo($errorCode = 0,asset($this->save_fullpath.'.'.$fileExt));
    }


    function setInfo($errorCode,$msg) {
        $result = array('errorCode'=>$errorCode,'msg'=>$msg);
        echo response()->json([
            'error' => $result['errorCode'],
            'message' => $result['msg'] ,
            'url' =>$result['msg']
        ]);
        exit();
    }
}
?>