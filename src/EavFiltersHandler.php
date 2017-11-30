<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 13.11.2017
 */

namespace v3project\yii2\productfilter;

use yii\base\DynamicModel;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * Interface IFiltersHandler
 * @package v3project\yii2\productfilter
 */
class EavFiltersHandler extends DynamicModel
    implements IFiltersHandler
{
    public $id;

    public $eavAttributes = [];
    public $eavAttributeClass = '';

    protected $_attributes = [];

    public function initEavAttributes()
    {
        /*foreach ($props as $prop) {
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
        }*/
    }

    /**
     * @param $name
     * @return EavAttribute
     */
    public function getEavAttribute($code)
    {
        return ArrayHelper::getValue($this->eavAttributes, $name);
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
    public function initQuery(ActiveQuery $activeQuery)
    {
        return $this;
    }

    /**
     * @param DataProviderInterface $dataProvider
     * @return $this
     */
    public function initDataProvider(DataProviderInterface $dataProvider)
    {
        return $this->initQuery($dataProvider->query);
    }

    public function renderByAttribute($code, ActiveForm $form) {
        return $code;
    }
}
