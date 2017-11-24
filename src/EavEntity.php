<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 13.11.2017
 */

namespace v3project\yii2\productfilter;

use common\models\V3pFeature;
use yii\base\DynamicModel;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class EAVModel
 * @package v3project\yii2\productfilter
 */
class EavEntity extends DynamicModel
{
    public $eavAttributes = [];
    public $eavAttributeClass = '';

    protected $_attributes = [];

    public static function create($attributes = [])
    {

    }

    public function initEavAttributes()
    {

    }

    /**
     * @param $name
     * @return mixed
     */
    public function getEavAttribute($code)
    {
        return ArrayHelper::getValue($this->_attributes, $name);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        $result = [];

        foreach ($this->attributes() as $code) {
            if ($property = $this->getEavAttribute($code)) {
                $result[$code] = $property->name;
            } else {
                $result[$code] = $code;
            }

        }

        return $result;
    }


}