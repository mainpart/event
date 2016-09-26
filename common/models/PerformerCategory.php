<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 24.09.2016
 * Time: 13:28
 *
 * @property integer $id
 * @property string $description
 */

class PerformerCategory extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%performer_categories}}';
    }

    public function getDescription()
    {
        return $this->description;
    }


}