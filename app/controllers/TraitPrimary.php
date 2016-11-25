<?php
/**
 * 基础trait, 提供调用.
 *
 * 可在 Trait 或 Controller 中使用, 外部访问没有数据.
 *
 */
trait TraitPrimary
{
    /**
     * 搜索建议词.
     *
     * `?q=something` for ajax request.
     *
     * @param string $project
     *
     * @return string
     *
     * @farwish
     */
    protected function suggests($project = '')
    {   
        if (! $project) return;

        $expand = []; 
        if ( $q = parent::makeup() ) { 
            $expand = parent::fuzzy($q)[$project]->getExpandedQuery($q, static::$limit);
        }
        return $expand;
    }

    /**
     * 纠错词.
     *
     * `您是不是要找：`
     *
     * @param string $project
     *
     * @return string
     *
     * @farwish
     */
    protected function corrected($project = '')
    {
        if (! $project) return;

        $corrected = [];
        if ( $q = parent::makeup() ) {
            $corrected = parent::fuzzy($q)[$project]->getCorrectedQuery($q);
        }
        return $corrected;
    }

    /**
     * 相关搜索词.
     *
     * `推荐：`
     *
     * @param string $project
     *
     * @return string
     *
     * @farwish
     */
    protected function related($project = '')
    {
        if (! $project) return;

        $related = [];
        if ( $q = parent::makeup() ) {
            $related = parent::fuzzy($q)[$project]->getRelatedQuery($q, static::$limit);
        }
        return $related;
    }

    /**
     * 热门搜索词.
     *
     * `热门：`
     *
     * @param string $project
     *
     * @return string
     *
     * @farwish
     */
    protected function hot($project = '')
    {
        if (! $project) return;

        $hot = [];
        if ( $q = parent::makeup() ) {
            $related = parent::fuzzy($q)[$project]->getHotQuery(static::$limit, 'total');
        }
        return $hot;
    }

}
