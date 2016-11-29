<?php
/**
 * 操作扩充.
 * 
 * @farwish
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
        return "Welcome to use alconSeek.";
    }

    /**
     * 默认主检索.
     *
     * @farwish
     */
    protected function major()
    {
        return self::demo();
    }

    /**
     * 自定义检索方法.
     *
     * @farwish
     */
    protected function demo()
    {
        $docs = $data = []; 

        $seek = parent::fuzzy()['article'];
        $docs = $seek->search();
        $count = $seek->lastCount;

        if ($docs) {
            $data['total'] = $count;
            foreach ($docs as &$doc) {
                $data['data'][] = [ 
                    'title' => $doc->title,
                    'content' => $doc->content,
                    'author' => $doc->author,
                ];
            }
            $data['p'] = static::$p;
        }

        return $data;
    }
}
