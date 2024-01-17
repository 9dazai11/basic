<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "medical_records".
 *
 * @property int $id
 * @property int $client_id
 * @property string $record_date
 * @property string $notes
 *
 * @property Clients $client
 */
class MedicalRecords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'record_date', 'notes'], 'required'],
            [['client_id'], 'integer'],
            [['record_date'], 'safe'],
            [['notes'], 'string'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Пациент',
            'record_date' => 'Дата',
            'notes' => 'Запись',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::class, ['id' => 'client_id']);
    }

    public static function getDropDownList()
    {
        return ArrayHelper::map(Clients::find()->all(),'id','FIO');
    }
}
