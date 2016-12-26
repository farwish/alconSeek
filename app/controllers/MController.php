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

    protected $home;
    protected $indexer;
    protected $config;
    protected $projectPath;
    protected $projects;
    protected $dbs = [];

    protected $actProject = '';
    protected $php;

    protected $adapter = '';
    protected $username = '';
    protected $password = '';
    protected $host = '';
    protected $dbname = '';

    protected $table = '';

    public function initialize()
    {
        global $config;

        $this->home = 'http://' . $_SERVER['SERVER_NAME'] . '/m/';
        $this->indexer = realpath('../') . 
            '/vendor/hightman/xunsearch/util/Indexer.php';
        $this->config = $config->toArray();
        $this->projectPath = APP_PATH . '/' . $this->config['application']['xsconfigDir'];
        $this->projects = $config->xs;
        foreach ($this->config as $k => $v) {
            if ( isset($v['dbname']) ) {
                $this->dbs[$k] = $v['dbname'];
            }
        }

        // 项目
        $this->actProject = $this->request->getPost('project');

        // 命令
        $this->php = $this->request->getPost('bin') ?: PHP_BINDIR . '/php';

        // 数据库
        if ( $db = $this->request->getPost('db') ) {
            $this->adapter = $this->config[$db]['adapter'];
            $this->username = $this->config[$db]['username'];
            $this->password = $this->config[$db]['password'];
            $this->host = $this->config[$db]['host'];
            $this->dbname = $this->config[$db]['dbname'];
        }

        // 表名
        $this->table = $this->request->getPost('table');
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
            'bin' => $this->php,
            'dbs' => $this->dbs,
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

        if ( ($this->actProject) && in_array($this->actProject, $this->projects) ) {
            
            $cmd = "{$this->php} {$this->indexer} --source={$this->adapter}://{$this->username}:{$this->password}@{$this->host}:3306/{$this->dbname} --sql=\"SELECT * FROM {$this->table}\" --project={$this->projectPath}{$this->actProject}.ini";

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
     * `GET` /m/rebuild
     * TODO 定时重建
     *
     * @farwish
     */
    public function rebuildAction()
    {
        if (! self::checkSignin() ) die(self::NOT_SIGNIN);

        if ( ($this->actProject) && in_array($this->actProject, $this->projects) ) {

            $cmd = "{$this->php} {$this->indexer} --rebuild --source={$this->adapter}://{$this->username}:{$this->password}@{$this->host}:3306/{$this->dbname} --sql=\"SELECT * FROM {$this->table}\" --project={$this->projectPath}{$this->actProject}.ini";

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

        if ( ($this->actProject) && in_array($this->actProject, $this->projects) ) {

            $cmd = "{$this->php} {$this->indexer} --source={$this->adapter}://{$this->username}:{$this->password}@{$this->host}:3306/{$this->dbname} --sql=\"SELECT * FROM {$this->table}\" --project={$this->projectPath}{$this->actProject}.ini --clean";

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

        if ( ($this->actProject) && in_array($this->actProject, $this->projects) ) {

            $cmd = "{$this->php} {$this->indexer} --project={$this->projectPath}{$this->actProject}.ini --clean";

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
     * TODO security.
     *
     * @farwish
     */
    public function signinAction()
    {
        if ( isset($_POST['sub']) ) {
            $expire = $this->config['env']['debug'] ? 300 : 60;
            if ( Manager::checkSignin($_POST['u'], $_POST['p']) ) {
                setCookie('alconSeek', $_POST['u'], time() + $expire, '/');
                $this->response->redirect($this->home, true);
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
            $this->response->redirect("{$this->home}signin", true);
            return false;
        }
        return true;
    }
}
