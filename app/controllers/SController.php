<?php
/**
 * 搜索主类.
 *
 * 个性查询请在 TraitAction 扩充.
 *
 * @farwish
 */
class SController extends ControllerBase
{
    use TraitAction;

    /**
     * 进入.
     *
     * `/s?typ=welcome` 
     * `/s?q=something` 默认主检索
     * `/s?q=something&typ=answers` 指定检索方法
     *
     * @farwish
     */
    public function indexAction()
    {
        $typ = $this->request->get('typ', 'string');

        $data = [];
        if ( empty($typ) ) {
            $data = self::major(); 
        } else if ( method_exists(__CLASS__, $typ)
            && ! in_array($typ, parent::blacklist() )
        ) {
            $data = self::$typ();
        }

        $this->respond($data);

        // fastcgi_finish_request();

        // parent::spoor();
    }
}
