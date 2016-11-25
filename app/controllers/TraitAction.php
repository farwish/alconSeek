<?php
/**
 * 操作扩充.
 * 
 */
trait TraitAction
{
    use TraitPrimary;

    /**
     * 自定义检索方法示例.
     *
     * `typ=welcome` 调用.
     *
     * @farwish
     */
    protected function welcome()
    {
        return "Welcome to use speed.";
    }

    /**
     * 默认主检索.
     *
     * @farwish
     */
    protected function major()
    {
        return self::answers();
    }

    /**
     * Answers.
     *
     * @farwish
     */
    protected function answers()
    {   
        $docs = $data = []; 

        $seek = parent::fuzzy()['answer'];

        $docs = $seek->search();
        $total = $seek->dbTotal;
        $count = $seek->lastCount;

        if ($docs) {
            $data['total'] = $count;
            foreach ($docs as &$doc) {
                $data['data'][] = [ 
                    'content' => $doc->content,
                ];
            }
        }

        $data['p'] = static::$p;
        $data['limit'] = static::$limit;

        return $data;
    } 

}
