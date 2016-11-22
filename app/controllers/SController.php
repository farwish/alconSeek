<?php
/**
 * 搜索文件.
 *
 */
class SController extends ControllerBase
{
    /**
     * 入口.
     *
     * @farwish
     */
    public function indexAction()
    {
        $typ = $this->request->get('typ', 'string');

        $data = [];
        if ( empty($typ) ) {

            $data = self::answers(); 

        } else if ( method_exists(__CLASS__, $typ)
            && ! in_array($typ, parent::blacklist() )
        ) {
            $data = self::$typ();
        }

        $this->respond($data);

        fastcgi_finish_request();

        parent::spoor();
    }

    /**
     * 搜索建议词.
     *
     * `?q=st` for ajax request.
     *
     * @farwish
     */
    protected function suggests()
    {
        $expand = [];

        if ( $q = parent::makeup() ) {
            $expand = parent::fuzzy($q)->getExpandedQuery($q, static::$limit);
        }

        return $expand;
    }

    /**
     * 纠错词.
     *
     * `您是不是要找：`
     *
     * @farwish
     */
    protected function corrected()
    {
        $corrected = [];

        if ( $q = parent::makeup() ) {
            $corrected = parent::fuzzy($q)->getCorrectedQuery($q);
        }

        return $corrected;
    }

    /**
     * 相关搜索词.
     *
     * `推荐：`
     *
     * @farwish
     */
    protected function related()
    {
        $related = [];

        if ( $q = parent::makeup() ) {
            $related = parent::fuzzy($q)->getRelatedQuery($q, static::$limit);
        }

        return $related;
    }

    /**
     * 热门搜索词.
     *
     * `热门：`
     *
     * @farwish
     */
    protected function hot()
    {
        $hot = [];

        if ( $q = parent::makeup() ) {
            $related = parent::fuzzy($q)->getHotQuery(static::$limit, 'total');
        }

        return $hot;
    }
    

    protected function answers()
    {
        $docs = $data = [];

        $seek = parent::fuzzy();

        $docs = $seek->search();
        $total = $seek->dbTotal;
        $count = $seek->lastCount;

        if ($docs) {
            foreach ($docs as &$doc) {
                $data[] = [
                    'content' => $doc->content,
                ];
            }
        }

        return $data;
    }

}
