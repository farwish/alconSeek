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
        return self::entry();
    }

    /**
     * 词条检索.
     *
     * @farwish
     */
    protected function entry()
    {
        $docs = $data = []; 

        $seek = parent::fuzzy()['entries'];
        $docs = $seek->search();
        $count = $seek->lastCount;

        if ($docs) {
            $data['total'] = $count;
            foreach ($docs as &$doc) {
                $data['data'][] = [ 
                    'name' => $doc->name,
                    'describe' => $doc->info,
                    'identify' => $doc->identify,
                ];
            }
            $data['p'] = static::$p;
        }

        return $data;
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
        $count = $seek->lastCount;

        if ($docs) {
            $data['total'] = $count;
            foreach ($docs as &$doc) {
                $data['data'][] = [ 
                    'content' => $doc->content,
                ];
            }
            $data['p'] = static::$p;
        }

        return $data;
    } 

}
