<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id
 * @property int $user_id
 * @property string $FIO
 * @property int $profession_id
 * @property int $cabinet
 *
 * @property Professions $profession
 * @property Reception[] $receptions
 * @property User $user
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'FIO', 'profession_id', 'cabinet'], 'required'],
            [['user_id', 'profession_id', 'cabinet'], 'integer'],
            [['FIO'], 'string', 'max' => 63],
            [['profession_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professions::class, 'targetAttribute' => ['profession_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'FIO' => 'ФИО',
            'profession_id' => 'Специализация',
            'cabinet' => 'Кабинет',
        ];
    }

    /**
     * Gets query for [[Profession]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(Professions::class, ['id' => 'profession_id']);
    }

    /**
     * Gets query for [[Receptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceptions()
    {
        return $this->hasMany(Reception::class, ['doctor_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public static function getDropDownList()
    {
        return ArrayHelper::map(Professions::find()->all(), 'id', 'name');
    }

    public static function getDoctorList()
    {
        return ArrayHelper::map(self::find()->joinWith('profession')->all(), 'id', function ($model) {
            return $model->FIO . ' - ' . $model->profession->name;
        });
    }
}
