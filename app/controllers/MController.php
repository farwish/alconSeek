<?php
/**
 * 管理索引
 *
 * @farwish
 */
class MController extends ControllerBase
{
    use Alcon\Traits\ControllerTrait;

    public function initialize()
    {
    }

    /**
     * Dashboard.
     *
     * @farwish
     */
    public function indexAction()
    {
        if ( self::checkSignin() ) {
            
        }
    }

    /**
     * Signin.
     *
     * @farwish
     */
    public function signinAction()
    {
        if ( isset($_POST['sub']) ) {
            if ( SpManager::checkSignin($_POST['u'], $_POST['p']) ) {
                setCookie('im', $_POST['u'], time() + 60, '/');
                $url = 'http://' . $_SERVER['SERVER_NAME'] . '/m';
                $this->response->redirect($url, true);
            }
        }
    }

    /**
     * Check.
     *
     * @farwish
     */
    protected function checkSignin()
    {
        if ( $_COOKIE['im'] ) {
            return true;
        } else {
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/m/signin';
            $this->response->redirect($url, true);
        }
    }
}
