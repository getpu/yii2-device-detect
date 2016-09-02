<?php

/**
 * Created by getpu on 16/9/2.
 */
 
namespace getpu\devicedetect;

use getpu\devicedetect\models\Mobile_Detect;

class Devicedetect extends \yii\base\Component
{
    private $_mobileDetect;

    public $setParams = true;

    public function __call($name, $parameters)
    {
        return call_user_func_array(
            array($this->_mobileDetect, $name),
            $parameters
        );
    }

    public function __construct($config = [])
    {
        return parent::__construct($config);
    }

    public function init()
    {
        $this->_mobileDetect = new Mobile_Detect;
        parent::init();

        if ($this->setParams) {
            \Yii::$app->params['devicedetect'] = [
                'isMobile' => $this->_mobileDetect->isMobile(),
                'isTablet' => $this->_mobileDetect->isTablet()
            ];
            \Yii::$app->params['devicedetect']['isDesktop'] =
                !\Yii::$app->params['devicedetect']['isMobile'] &&
                !\Yii::$app->params['devicedetect']['isTablet'];
        }
    }
}