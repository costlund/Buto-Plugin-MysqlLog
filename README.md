# Buto-Plugin-MysqlLog
Log all database changes like insert, update and delete from PluginWfMysql::execute method.
## Event
```
events:
  wf_mysql_execute_after:
    -
      plugin: 'mysql/log'
      method: log
```
## Settings
```
plugin:
  mysql:
    log:
      settings:
        mysql: 'yml:/../buto_data/_mysql_.yml'
```
## Avoid log
One could avoid loggin by set event flag to false for PluginWfMysql.
```
wfPlugin::includeonce('wf/mysql');
$mysql = new PluginWfMysql();
/**
  * Skip log.
  */
$mysql->event = false;
/**
  * 
  */
$mysql->open($data->get('settings/mysql'));
```

## Schema
- /plugin/mysql/log/sql/schema.yml