<?php

namespace Bbs;

class AppnameMTagClass extends \Phalcon\Mvc\Model
{
    /**
     * 多库操作初始化.
     *
     */
    public function initialize()
    {
        $this->setConnectionService('bbsDb');
    }

    /**
     * 查找.
     *
     * <code>
     *  \Bbs\AppnameMTagClass::find();
     * </code>
     *
     * @farwish
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
}
