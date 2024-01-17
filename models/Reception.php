<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "reception".
 *
 * @property int $id
 * @property int $client_id
 * @property int $doctor_id
 * @property string $admission_date
 * @property string $status
 *
 * @property Clients $client
 * @property Doctors $doctor
 */
class Reception extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reception';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'doctor_id', 'admission_date', 'status'], 'required'],
            [['client_id', 'doctor_id'], 'integer'],
            [['admission_date'], 'safe'],
            [['status'], 'string'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctors::class, 'targetAttribute' => ['doctor_id' => 'id']],
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
            'doctor_id' => 'Врач',
            'admission_date' => 'Дата приема',
            'status' => 'Статус',
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

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctors::class, ['id' => 'doctor_id']);
    }

    // public static function getDropDownList()
    // {
    //     return ArrayHelper::map(Professions::find()->all(),'id','name');
    // }
}
