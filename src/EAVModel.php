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

/**
 * Class EAVModel
 * @package v3project\yii2\productfilter
 */
class EAVModel extends DynamicModel
{
    public $eavAttribute = null;
    public $eavValue = null;
    public $eavEntity = null;

    public function initEavAttributes() {

    }

}