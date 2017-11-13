<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 13.11.2017
 */
namespace v3project\yii2\filter;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * Class FilterWidget
 * @package v3project\yii2\filter
 */
class FilterWidget extends Widget {

    /**
     * @var ActiveQuery
     */
    public $activeQuery;

    /**
     * @var
     */
    public $view_file = '@v3project/yii2/filter/views/default';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->activeQuery) {
            throw new InvalidConfigException("Ошибка конфигурации виджета");
        }
        
        if (!$this->activeQuery instanceof ActiveQuery) {
            throw new InvalidConfigException("Ошибка конфигурации виджета");
        }
        
        parent::init();
    }
    
    public function run() {
        return $this->render($this->view_file);
    }
}