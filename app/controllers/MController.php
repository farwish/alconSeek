<?php
/**
 * 管理索引.
 *
 * 简化复杂度, 统一此处管理.
 *
 * @farwish
 */
class MController extends ControllerBase
{
    use \Alcon\Projects\Alconseek\Controllers\TraitM;

    /**
     * Overload any functions.
     *
     * redirect to /m/index
     *
     * @farwish
     */ 
    public function signinAction()
    {
        if ( isset($_POST['sub']) ) { 
            $expire = $this->config['env']['debug'] ? 300 : 60; 
            if ( Manager::checkSignin($_POST['u'], $_POST['p']) ) { 
                setCookie('alconSeek', $_POST['u'], time() + $expire, '/');
                $this->response->redirect('/m/', true);
            }
        } 
    }

    /** 
     * Check.
     *
     * TODO security.
     *
     * @farwish
     */
    protected function checkSignin()
    {   
        if ( empty($_COOKIE['alconSeek']) ) { 
            $this->response->redirect("/m/signin", true);
            return false;
        }
        return true;
    } 
}
