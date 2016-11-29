# alconSeek

---

## Synopsis  

> 尔康搜索是一个让你及其方便地开发全文检索Api的应用骨架。

## Install & Deploy  

> 一. 依赖: 

> 1. LNMP环境  
`搭建可参考：https://github.com/farwish/delicateShell/tree/master/lnmp`

> 2. Composer工具  
````shell
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
````

> 3. Phalcon框架  
`文档：https://docs.phalconphp.com/en/latest/reference/install.html`     
`搭建可参考：https://github.com/farwish/delicateShell/blob/master/lnmp/installPhalcon.sh`  

> 4. Xunsearch服务  
`文档：http://www.xunsearch.com/doc/php/guide/start.installation`  
`搭建可参考：https://github.com/farwish/delicateShell/blob/master/support/installXunsearch.sh`  

> 二. 部署:   
````shell
sh deploy  
vi ./app/config/config.ini  #数据库配置  
````

> 三. nginx 配置部分:  

````shell
server {
    listen 80; 
    server_name alconseek.farwish.com;

    root /home/www/alconSeek/public;

    location / { 
        index index.html index.htm index.php;
        try_files $uri $uri/ /index.php?_url=$uri&$args;
    }   

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
````

```
别忘了：
/etc/hosts 中加入 127.0.0.1   alconseek.farwish.com   
```

> 四. 数据库  
  `你可以用phpmyadmin等软件导入我准备好的数据库进行测试, 文件是 alconseek.sql。`  
  `索引管理界面初始登录账号密码: admin / admin`  

> 五. 访问  
  `http://www.demo.com/s?q=`  


## Overview   

> 项目特点(feature):  
`1. 搜索数据配置化, 即插即用, 马上拥有360搜索般的服务`  
`2. 架构松耦合, 只需专注特色功能的快速开发(TraitAction)`  

> 项目结构(structure):  
`由phalcon开发工具(phalcon-devtools)生成的Simple类型项目改进而来; 修改点:`    
`1.config.php加载ini配置;`  
`2.services.php注册xunsearch服务.`  

> 功能概述(functional)：  
`1.索引管理: http://www.demo.com/m`  
`2.通用搜索API: http://www.demo.com/s?q=`  

> 搜索配置放置(search config):  
`./app/xsconfig/xxx.ini`  

> 搜索数据目录(data directory):  
`/usr/local/xunsearch/data/xxx`  

## How to develop your application?  

> 首先你得建一个表, 根据迅搜文档编辑自己的ini搜索配置文件 并 放在xsconfig目录中; 索引管理处生成数据, 然后就可以通过Api访问了.  
> 配置文件详解: http://www.xunsearch.com/doc/php/guide/ini.guide  


## Join  

> Qq group: 377154148  