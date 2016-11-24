<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    use Alcon\Traits\ControllerTrait;
    
    public function initialize()
    {
        self::init();
    }

    protected function blacklist()
    {
        return get_class_methods(__CLASS__);
    }

    /**
     * 搜索词组合.
     *
     * 如需更复杂关系检索, 在逻辑中自定义$q.
     *
     * @param $relation string
     *
     * @return string
     *
     * @farwish
     */
    protected function makeup($relation = 'OR')
    {
        $q = $this->request->get('q', 'string');
  
        $space = str_replace(' ', '', $q);
 
        if ( $space !== '' ) {
             $q = join(" {$relation} ", explode(' ', $q));
        }

        return $q;
    }

    /**
     * 模糊检索对象.
     *
     * @param $q string
     *
     * @return \XSSearch
     * 
     * @farwish
     */
    protected function fuzzy($q = '')
    {
        global $config;

        $projects = array_keys($config->xs->toArray());

        $q = $q ?: self::makeup();

        foreach ($projects as $v) {
            $this->seek[$v]->setFuzzy()
                ->setQuery($q)
                ->setLimit(static::$limit, static::$offset);
        }

        return $this->seek; 
    }

    /**
     * 搜索纪录.
     *
     * @farwish
     */
    public function spoor()
    {
        $spoor = [ 
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        SpSpoor::insertOne($spoor); 
    }
}
