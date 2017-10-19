<?php

/* @var $this yii\web\View */

use moonland\phpexcel\Excel;

require_once 'simple_html_dom.php'; // библиотека для парсинга
//$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1></h1>

        <p class="lead"></p>

    </div>

    <div class="body-content">
        <?php
        /** @var array $data */
        $data = Excel::import('uploads/000.xlsx', [
                'columns' => 'code',
        ]);
        $res = [];
        foreach ($data as $k => $row){
	        $html = file_get_html('http://www.cma-cgm.com/ebusiness/tracking/search?SearchBy=Container&Reference=' . $row['code'], false, null, 0);
	        if($date = $html->find('tr.date-provisional', -1)){
		        $date = $date->find('td', 0);
		        $res[$k] = $date->plaintext;
	        }
        }
        var_dump($res);
        ?>
    </div>
</div>
