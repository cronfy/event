<?php
/**
 * Created by PhpStorm.
 * User: cronfy
 * Date: 19.10.17
 * Time: 9:48
 */

namespace cronfy\event\models;

use yii\db\ActiveQuery;

class EventQuery extends ActiveQuery {

    public function init()
    {
        /** @var Event $active_record_class */
        $active_record_class = $this->modelClass;
        parent::init();
        $this->andWhere(['namespace' => $active_record_class::getNamespace()]);
    }

    public function where($condition, $params = []) {
        return parent::andWhere($condition, $params);
    }

}