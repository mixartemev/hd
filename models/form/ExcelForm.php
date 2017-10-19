<?php

namespace app\models\form;

use moonland\phpexcel\Excel;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

/**
 * Password reset form
 */
class ExcelForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file'/*, 'extensions' => 'xls, xlsx'*/],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => Yii::t('app', 'Загрузи сюда эксельку с кодами контейнеров'),
        ];
    }

	/**
     * @return bool
     */
    public function upload()
    {
	    if ($this->validate()) {
            $xls_path = Yii::getAlias('@webroot/uploads/') . $this->file->name/* . '.' . $this->file->extension*/;
		    if($this->file->saveAs($xls_path)){
			    require_once 'simple_html_dom.php'; // библиотека для парсинга
			    /** @var array $data */
			    $data = Excel::import($xls_path, [
				    'setFirstRecordAsKeys' => false,
			    ]);
			    $d  = [];
			    foreach ($data as $k => $row){
				    $html = file_get_html('http://www.cma-cgm.com/ebusiness/tracking/search?SearchBy=Container&Reference=' . $row['A'], false, null, 0);
				    if($date = $html->find('tr', -1)){
					    $date = $date->find('td', 0);
				    }
				    $d[$k] =['code' => $row['A'], 'date' => @$date->plaintext?:''];
			    }

			    Excel::export([
				    'models' => $d,
				    'asArray' => true,
				    'fileName' => $this->file->name,
				    'columns' => [0 => 'code', 8 => 'date'], //without header working, because the header will be get label from attribute label.
				    'headers' => ['code' => 'Контейнер №', 'date' => 'Дата прибытия'],
			    ]);
		    }
        } else {
            return false;
        }
    }
}