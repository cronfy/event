<?php

namespace cronfy\event\models;

use common\components\exceptions\EnsureSaveException;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * @property mixed modelData
 * @property Model model
 */
abstract class Event extends crud\Event {

    public static function find()
    {
        return new EventQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ]
        ];
    }

    public function rules()
    {
        $rules = parent::rules();

        // для основного сценария поля TimestampBehavior не требуются, они проставляются автоматически.
        // Иначе придется вешать обновление этих полей на EVENT_BEFORE_VALIDATE, а в этом случае
        // created_at будет обновляться при каждом сохранении, что вообше не то, что нужно.
        unset($rules['created_at/required']);

        return $rules;
    }

    public function init() {
        parent::init();
        $this->on(static::EVENT_BEFORE_VALIDATE, function () {
            if ($this->_model) {
                $this->setModelData($this->_model);
            } else {
                // ничего не делаем, оставляем data как есть. Если модели нет, это может означать,
                // что её просто не запрашивали, но data от этого сбрасываться не должны.
                // Если нужно именно сбросить модель, нужен отдельный метод вроде removeModel() (сейчас его нет)
                // или поддержка чего-то вроде setModel(null)
            }
        });
    }

    public function ensureSave() {
        if (!$this->save()) {
//            D($this->errors);
            throw new EnsureSaveException("Failed to save data");
        }
    }

    /**
     * @return string
     */
    abstract public function getModelClass();

    /**
     * @return string
     */
    abstract public static function getNamespace();

    protected $_model;
    public function getModel() {
        if (!$this->_model) {
            $class = $this->getModelClass();
            $this->_model = new $class($this->modelData);
        }
        return $this->_model;
    }

    public function setModel($value) {
        if ((is_object($value))) {
            $this->_model = $value;
        } else {
            $class = $this->getModelClass();
            $model = new $class($value);
            $this->_model = $model;
        }

        // не обновляем здесь properties. Это будет сделано автоматически в момент beforeValidate
//        $this->setModelData($this->_model);
    }

    protected function getModelData() {
        return Json::decode($this->data);
    }

    protected function setModelData($data) {
        $this->data = Json::encode($data);
    }


}