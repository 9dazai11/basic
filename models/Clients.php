<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property int $user_id
 * @property string $FIO
 * @property string $date_of_birth
 * @property string $sex
 * @property int $serial_passport
 * @property int $number_passport
 * @property int $phone
 * @property string $address
 * @property int $medical_policy
 * @property int $insurance_policy
 *
 * @property MedicalRecords[] $medicalRecords
 * @property Reception[] $receptions
 * @property User $user
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'FIO', 'date_of_birth', 'sex', 'serial_passport', 'number_passport', 'phone', 'address', 'medical_policy', 'insurance_policy'], 'required'],
            [['user_id', 'serial_passport', 'number_passport', 'phone', 'medical_policy', 'insurance_policy'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['sex'], 'string'],
            [['FIO', 'address'], 'string', 'max' => 63],
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
            'user_id' => 'ID пользователя',
            'FIO' => 'ФИО',
            'date_of_birth' => 'Дата рождения',
            'sex' => 'Пол',
            'serial_passport' => 'Серия паспорта',
            'number_passport' => 'Номер паспорта',
            'phone' => 'Телефон',
            'address' => 'Адрес регистрации',
            'medical_policy' => 'Медполис',
            'insurance_policy' => 'СНИЛС',
        ];
    }

    /**
     * Gets query for [[MedicalRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecords::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Receptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceptions()
    {
        return $this->hasMany(Reception::class, ['client_id' => 'id']);
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
}
