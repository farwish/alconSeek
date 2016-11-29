# alconSeek

**Synopsis**

> alconSeek is an application skel for develop full-text search app easily.

**Install & Deploy**

> 一. 安装依赖(dependency): Phalcon, Xunsearch  
> `Phalcon Doc: https://docs.phalconphp.com/en/latest/reference/install.html`  
> `Xunsearch Doc: http://www.xunsearch.com/doc/php/guide/start.installation`  
> `推荐的安装脚本(install script):`  
> `installPhalcon.sh: https://github.com/farwish/delicateShell/blob/master/lnmp/installPhalcon.sh`  
> `installXunsearch.sh: https://github.com/farwish/delicateShell/blob/master/support/installXunsearch.sh`  

> 二. 部署: ./deploy  
> `运行完成之后, 查看配置: vi ./app/config/config.ini`  

**Overview**  

> 项目结构(structure):  
`由phalcon开发工具(phalcon-devtools)生成的Simple类型项目改进而来; 修改点:`    
`1.config.php加载ini配置;  2.services.php注册xunsearch服务.`  

> 功能概述(functional)：  
`1.索引管理: http://www.demo.com/m  2.通用搜索API: http://www.demo.com/s?q=`  

> 搜索配置放置(search config):  
`./app/xsconfig/xxx.ini`  

> 搜索数据目录(data directory):  
`/usr/local/xunsearch/data/xxx`  
