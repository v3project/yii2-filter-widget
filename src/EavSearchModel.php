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
class EavSearchModel extends DynamicModel
{
    public $eavAttributes = [];
    public $eavAttributeClass = '';

    protected $_attributes = [];

    public function initEavAttributes()
    {
        foreach ($props as $prop) {
            if ($prop->property_type == \skeeks\cms\relatedProperties\PropertyType::CODE_NUMBER) {
                $this->defineAttribute($this->getAttributeNameRangeFrom($prop->code), '');
                $this->defineAttribute($this->getAttributeNameRangeTo($prop->code), '');

                $this->addRule([
                    $this->getAttributeNameRangeFrom($prop->code),
                    $this->getAttributeNameRangeTo($prop->code)
                ], "safe");

            }

            $this->defineAttribute($prop->code, "");
            $this->addRule([$prop->code], "safe");

            $this->_attributes[$prop->code] = $prop;
        }
    }

    /**
     * @param $name
     * @return EavAttribute
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
            if ($eavAttribute = $this->getEavAttribute($code)) {
                $result[$code] = $eavAttribute->name;
            } else {
                $result[$code] = $code;
            }

        }

        return $result;
    }


    /**
     * @param ActiveQuery $activeQuery
     */
    public function search(ActiveQuery $activeQuery)
    {
        return $this;
    }

}