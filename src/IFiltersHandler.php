<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 13.11.2017
 */

namespace v3project\yii2\productfilter;

use yii\db\ActiveQuery;
use yii\widgets\ActiveForm;

/**
 * Interface IFiltersHandler
 * @package v3project\yii2\productfilter
 */
interface IFiltersHandler
{
    /**
     * @return mixed
     */
    public function init();

    /**
     * @param ActiveQuery $activeQuery
     * @return static
     */
    public function search(ActiveQuery $activeQuery);

    /**
     * @param $data
     */
    public function load($data);

    /**
     * @param string $code
     * @return string
     */
    public function renderByAttribute($code, ActiveForm $form);
}