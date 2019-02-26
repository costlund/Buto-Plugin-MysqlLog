# Buto-Plugin-MysqlLog

Log all database changes like insert, update and delete from PluginWfMysql::execute method.

## Settings

```
events:
  wf_mysql_execute_after:
    -
      plugin: 'mysql/log'
      method: log
```

```
plugin:
  mysql:
    log:
      settings:
        mysql: 'yml:/../buto_data/_mysql_.yml'
```
