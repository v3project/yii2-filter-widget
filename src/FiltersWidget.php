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
 * Class FiltersWidget
 * @package v3project\yii2\productfilter
 */
class FiltersWidget extends Widget
{
    /**
     * @var
     */
    public $viewFile = '@v3project/yii2/productfilter/views/product-filter';

    /**
     * @var IFiltersHandler[]
     */
    public $filtersHandlers = [];

    /**
     *
     */
    public function init()
    {
        parent::init();

        foreach ($this->filtersHandlers as $id => $config) {
            if (is_string($config)) {
                $config = ['class' => $config];
            }
            $config['id'] = $id;
            $this->filtersHandlers[$id] = Yii::createObject($config);
            if (!$this->filtersHandlers[$id] instanceof IFiltersHandler) {
                unset($this->filtersHandlers[$id]);
            }
        }
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render($this->viewFile);
    }

    /**
     * @param ActiveQuery $activeQuery
     * @return $this
     */
    public function search(ActiveQuery $activeQuery)
    {
        if ($this->filtersHandlers) {
            foreach ($this->filtersHandlers as $searchHandler) {
                $searchHandler->search($activeQuery);
            }
        }

        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function load($data) {
        if ($this->filtersHandlers) {
            foreach ($this->filtersHandlers as $searchHandler) {
                $searchHandler->load($data);
            }
        }

        return $this;
    }

}