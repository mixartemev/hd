<?php

namespace app\models\form;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use yii\base\Model;
use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * Password reset form
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => Yii::t('app', 'Ava 300x400'),
        ];
    }

	/**
     * @param string $uName
     * @return bool
     */
    public function upload($uName)
    {
        if ($this->validate()) {
            $img_path = Yii::getAlias('@web/ava/') . $uName . '.' . $this->file->extension;
            $this->file->saveAs($img_path);
            $img = Image::getImagine()->open($img_path);
            $img->strip(); // облегчили фотку от мусора
            $original_size = $img->getSize();
            $w = $original_size->getWidth();
            $h = $original_size->getHeight();
            $ar = $w/$h;
            /** 300x400 preview mode */
            if($ar > (3/4)){ // если фотка более альбомная, чем нам надо, ресайзим по высоте, а ширина остается больше, и потом обрезается
                $img->resize(new Box(round(400*$ar),400));
            }else{ // если более портретная, ресайз по ширине, а лишнюю высоту обрежем
                $img->resize(new Box(300,round(300/$ar)));
            }
            $size = $img->getSize();
            //if($w>300 || $h>400){ // я сделал ресайз до 300х400 даже если оригинал был меньше, поэтому это условие можно щас опустить
                $centerCrop = new Point($size->getWidth()/2 - 300/2, $size->getHeight()/2 - 400/2);
                $img->crop($centerCrop, new Box(300,400));
            //}
            $img->interlace(ImageInterface::INTERLACE_LINE); // сделали фотку прогрессивной

            $img->save($img_path, ['quality' => 98]);
            return true;
        } else {
            return false;
        }
    }
}