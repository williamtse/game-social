<?php

use Phalcon\Mvc\Controller;
use Phalcon\Image\Adapter\GD;

/**
 * Description of FileController
 *
 * @author Administrator
 */
class FileController extends Controller {

    public function imguploadAction() {
        $files = $_FILES['imgs'];
        $source_path = $files['tmp_name'][0];
        $ext = fileext($files['name'][0]);
        $filedir = ROOT . '/img/';
        $md5file = md5_file($source_path);
        $filepath = $filedir . $md5file.'.'.$ext;
        $relativeDir = '/public/img/';
        if (move_uploaded_file($source_path, $filepath)) {
            $fileModel = new UploadFiles();
            $img = $this->db->query('select * from upload_files where md5file="'.$md5file.'"')->fetch();
            if(empty($img)){
                $fileModel->create(array(
                    'md5file' => $md5file,
                    'ext'=>$ext,
                    'create_time' => date('Y-m-d H:i:s', time())
                        )
                );
                $fileId = $fileModel->id;
            }else{
                $fileId = $img['id'];
            }
            if ($fileId > 0) {
                $this->resizeImage($filepath, $filedir . 'thumb_' . $md5file.'.'.$ext, 100, 200);
                echo json_encode(array('files' => array([
                            'name' => $files['name'][0],
                            'size' => $files['size'][0],
                            'url' => $relativeDir . $md5file.'.'.$ext,
                            'thumbnailUrl' => $relativeDir . 'thumb_' . $md5file.'.'.$ext,
                            'deleteUrl' => $md5file,
                            'deleteType' => "DELETE",
                            'imgId'=>$fileId
                        ]
                )));
            }
        }
    }

    public function videouploadAction(){
        $video = $_FILES['video'];
        $name = $video['name'];
        $ext = fileext($name);
        $src = $video['tmp_name'];
        $md5file = md5_file($src);
        $dst = ROOT.'/videos/'.$md5file.'.'.$ext;
        if(move_uploaded_file($src, $dst)){
            $fileModel = new UploadFiles();
            $videoExists = $this->db->query('select * from upload_files where md5file="'.$md5file.'"')->fetch();
            if(empty($videoExists)){
                $fileModel->create(array(
                    'md5file' => $md5file,
                    'ext'=>$ext,
                    'create_time' => date('Y-m-d H:i:s', time())
                        )
                );
                $fileId = $fileModel->id;
            }else{
                $fileId = $videoExists['id'];
            }
            if ($fileId > 0) {
                echo json_encode(array('files' => array([
                            'name' => $name,
                            'size' => $video['size'][0],
                            'url' => '/public/videos/' . $md5file.'.'.$ext,
                            'thumbnailUrl' => null,
                            'deleteUrl' => $md5file,
                            'deleteType' => "DELETE",
                            'id'=>$fileId
                        ]
                )));
            }
        }
    }
    public function showImage() {
        $md5 = $this->request->getQuery('file');
        $size = getimagesize($md5); //获取mime信息 
        $fp = fopen($md5, "rb"); //二进制方式打开文件 
        if ($size && $fp) {
            header("Content-type: {$size['mime']}");
            fpassthru($fp); // 输出至浏览器 
            exit;
        } else {
            
        }
    }

    private function resizeImage($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0) {
        if (!is_file($src_img)) {
            return false;
        }
        $ot = fileext($dst_img);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;

        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if (($width > $src_w && $height > $src_h) || ($height > $src_h && $width == 0) || ($width > $src_w && $height == 0)) {
            $proportion = 1;
        }
        if ($width > $src_w) {
            $dst_w = $width = $src_w;
        }
        if ($height > $src_h) {
            $dst_h = $height = $src_h;
        }

        if (!$width && !$height && !$proportion) {
            return false;
        }
        if (!$proportion) {
            if ($cut == 0) {
                if ($dst_w && $dst_h) {
                    if ($dst_w / $src_w > $dst_h / $src_h) {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    } else {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                } else if ($dst_w xor $dst_h) {
                    if ($dst_w && !$dst_h) {  //有宽无高
                        $propor = $dst_w / $src_w;
                        $height = $dst_h = $src_h * $propor;
                    } else if (!$dst_w && $dst_h) {  //有高无宽
                        $propor = $dst_h / $src_h;
                        $width = $dst_w = $src_w * $propor;
                    }
                }
            } else {
                if (!$dst_h) {  //裁剪时无高
                    $height = $dst_h = $dst_w;
                }
                if (!$dst_w) {  //裁剪时无宽
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int) round($src_w * $propor);
                $dst_h = (int) round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        } else {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width = $dst_w = $src_w * $proportion;
        }

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if (function_exists('imagecopyresampled')) {
            imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        } else {
            imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        $otfunc($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }

}
function fileext($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}