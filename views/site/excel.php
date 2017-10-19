<?php

/* @var $this yii\web\View */

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
        $data = \moonland\phpexcel\Excel::import('uploads/000.xlsx', [
                'columns' => 'code',
        ]);
        var_dump($data);
        foreach ($data as $row){
	        $html = \garyjl\simplehtmldom\SimpleHTMLDom::file_get_html('http://www.cma-cgm.com/ebusiness/tracking/search?SearchBy=Container&Reference=' . $row['code']);
	        var_dump($html->find('tr.date-provisional'));
        }
        //
        ?>
    </div>
</div>
