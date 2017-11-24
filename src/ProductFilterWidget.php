<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 13.11.2017
 */

namespace v3project\yii2\productfilter;

use common\models\V3pFeature;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;

/**
 * @var V3pFeature[] $features
 *
 * Class ProductFilterWidget
 * @package v3project\yii2\productfilter
 */
class ProductFilterWidget extends Widget
{

    /**
     * @var ActiveQuery
     */
    public $query;

    /**
     * @var
     */
    public $view_file = '@v3project/yii2/productfilter/views/product-filter';

    /**
     * @var null|EavSearchModel
     */
    public $eavSearchModel = null;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->query) {
            throw new InvalidConfigException("Ошибка конфигурации виджета");
        }

        if (!$this->query instanceof ActiveQuery) {
            throw new InvalidConfigException("Ошибка конфигурации виджета");
        }

        parent::init();
    }

    public function run()
    {
        return $this->render($this->view_file);
    }


}