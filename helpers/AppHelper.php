<?php

namespace app\helpers;

use Yii;

class AppHelper
{
    /**
     * Проверяет, является ли текущий пользователь врачом.
     *
     * @return bool
     */
    public static function isDoctor()
    {
        if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->is_doctor == 1)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет, является ли текущий пользователь главврачом.
     *
     * @return bool
     */
    public static function isMainDoctor()
    {
        if (self::isDoctor() == 1 && (Yii::$app->user->identity->id == 1)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет, является ли текущий пользователь пациентом.
     *
     * @return bool
     */
    public static function isPatient()
    {
        if (!Yii::$app->user->isGuest && self::isDoctor() == 0) {
            return true;
        }
        return false;
    }
}
