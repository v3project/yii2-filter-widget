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
use yii\helpers\ArrayHelper;

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
        $this->registerAssets();
        return $this->render($this->viewFile);
    }

    public function registerAssets()
    {
        return $this;
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

    public $filtersParamName = 'f';

    protected $_data = [];

    public function loadFromRequest() {

        $data = \Yii::$app->request->post();
        if ($data = \Yii::$app->request->post()) {
            //Чистить незаполненные
            if (isset($data[$this->filtersParamName])) {
                foreach ($data[$this->filtersParamName] as $key => $value) {
                    if (!$value) {
                        unset($data[$this->filtersParamName][$key]);
                    }
                }
            }

            $this->_data = $data;
            $this->load($data);

            \Yii::$app->response->redirect($this->getFilterUrl());

        } elseif ($data = \Yii::$app->request->get($this->filtersParamName)) {
            $data = (array) unserialize(base64_decode($data));
            $this->_data = $data;
            $this->load($data);
        }

        return $this;
    }

    public function getFilterUrl() {
        return \Yii::$app->request->pathInfo . "?" . http_build_query([
            $this->filtersParamName => base64_encode(serialize($this->_data))
        ]);
    }

    /**
     * @param $data
     * @return $this
     */
    public function load($data)
    {
        if ($this->filtersHandlers) {
            foreach ($this->filtersHandlers as $searchHandler) {
                $searchHandler->load($data);
            }
        }

        return $this;
    }

}