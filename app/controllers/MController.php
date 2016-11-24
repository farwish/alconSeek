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
    const HAS_BUILD = '已生成, 数秒后生效!';
    const HAS_REBUILD = '已平滑重建, 数秒后生效!';
    const HAS_CLEAN_AND_REBUILD = '清空并重建完成, 数秒后生效!';
    const HAS_CLEAN = '清空完成!';
    const NOT_EXISTS = '项目不存在';
    const NOT_SIGNIN = '未登陆';

    protected $php;
    protected $indexer;
    protected $config;
    protected $projects;
    protected $home;
    protected $projectPath;

    public function initialize()
    {
        global $config;

        $this->php = '/usr/local/php5.6.25/bin/php';
        $this->indexer = realpath('../') . 
            '/vendor/hightman/xunsearch/util/Indexer.php';
        $this->config = $config;
        $this->projects = array_keys($config->xs->toArray());
        $this->home = 'http://' . $_SERVER['SERVER_NAME'] . '/m/';
        $this->projectPath = APP_PATH . '/app/xsconfig/';
    }

    /**
     * Dashboard.
     *
     * @farwish
     */
    public function indexAction()
    {
        self::checkSignin();
        
        $this->view->setVars([
            'projects' => $this->projects,
        ]);
    }

    /**
     * 生成.
     *
     * @farwish
     */
    public function buildAction()
    {
        if (! self::checkSignin() ) die(self::NOT_SIGNIN);

        if ( ($project = $this->request->getPost('project')) && in_array($project, $this->projects) ) {

            $table = $this->request->getPost('table');
            
            $cmd = "{$this->php} {$this->indexer} --source={$this->config->database->adapter}://{$this->config->database->username}:{$this->config->database->password}@{$this->config->database->host}:3306/{$this->config->bbs->dbname} --sql=\"SELECT * FROM {$table}\" --project={$this->projectPath}{$project}.ini";

            echo self::HAS_BUILD;

            fastcgi_finish_request();

            shell_exec($cmd);
        } else {
            echo self::NOT_EXISTS;
        }
    }

    /**
     * 平滑重建.
     *
     * `./Indexer.php --rebuild --source=mysql://root:123456@localhost:3306/dbname --sql="SELECT * FROM tablename" --project=speed`
     *
     * @farwish
     */
    public function rebuildAction()
    {
        if (! self::checkSignin() ) die(self::NOT_SIGNIN);

        if ( ($project = $this->request->getPost('project')) && in_array($project, $this->projects) ) {

            $table = $this->request->getPost('table');

            $cmd = "{$this->php} {$this->indexer} --rebuild --source={$this->config->database->adapter}://{$this->config->database->username}:{$this->config->database->password}@{$this->config->database->host}:3306/{$this->config->bbs->dbname} --sql=\"SELECT * FROM {$table}\" --project={$this->projectPath}{$project}.ini";

            echo self::HAS_REBUILD;

            fastcgi_finish_request();

            shell_exec($cmd);
        } else {
            echo self::NOT_EXISTS;
        }
    }

    /**
     * 清空并重建.
     *
     * @farwish
     */
    public function cleanAndRebuildAction()
    {
        if (! self::checkSignin() ) die(self::NOT_SIGNIN);

        if ( ($project = $this->request->getPost('project')) && in_array($project, $this->projects) ) {

            $table = $this->request->getPost('table');

            $cmd = "{$this->php} {$this->indexer} --source={$this->config->database->adapter}://{$this->config->database->username}:{$this->config->database->password}@{$this->config->database->host}:3306/{$this->config->bbs->dbname} --sql=\"SELECT * FROM {$table}\" --project={$this->projectPath}{$project}.ini --clean {$project}";

            echo self::HAS_CLEAN_AND_REBUILD;

            fastcgi_finish_request();

            shell_exec($cmd);
        } else {
            echo self::NOT_EXISTS;
        }
    }

    /**
     * 清空.
     *
     * @farwish
     */
    public function cleanAction()
    {
        if (! self::checkSignin() ) die(self::NOT_SIGNIN);

        if ( ($project = $this->request->getPost('project')) && in_array($project, $this->projects) ) {

            $cmd = "{$this->php} {$this->indexer} -p {$project} --clean";

            echo self::HAS_CLEAN;

            fastcgi_finish_request();

            shell_exec($cmd);
        } else {
            echo self::NOT_EXISTS;
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
            $expire = $this->config->env->debug ? 180 : 60;
            if ( SpManager::checkSignin($_POST['u'], $_POST['p']) ) {
                setCookie('im', $_POST['u'], time() + $expire, '/');
                $this->response->redirect($this->home, true);
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
        if ( empty($_COOKIE['im']) ) {
            $this->response->redirect("{$this->home}signin", true);
            return false;
        }
        return true;
    }
}
