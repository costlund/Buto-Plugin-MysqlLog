<?php
class PluginMysqlLog{
  public function event_log($data, $data2){
    /**
     * 
     */
    if(isset($data2['sql_script'])){
      $sql_script = $data2['sql_script'];
    }else{
      return null;
    }
    /**
     * Only log insert, update, delete.
     */
    if(
            strtolower(wfPhpfunc::substr($sql_script, 0, 12)) !='insert into ' && 
            strtolower(wfPhpfunc::substr($sql_script, 0, 7))  !='update ' && 
            strtolower(wfPhpfunc::substr($sql_script, 0, 12)) !='delete from '
            ){
      return null;
    }
    /**
     * Get mysql connection data.
     */
    $plugin_settings = wfPlugin::getPluginSettings('mysql/log', true);
    /**
     * Sql.
     */
    $sql = new PluginWfArray();
    $sql->set('sql', "insert into mysql_log_log (id, sql_script, created_by) values (uuid(), ?, '[user_id]');");
    $sql->set('params/0', array('type' => 's', 'value' => $sql_script));
    /**
     * Put into db.
     * Set event to false to avoid a loop with insert into.
     */
    wfPlugin::includeonce('wf/mysql');
    $mysql = new PluginWfMysql();
    $mysql->event = false;
    $mysql->open($plugin_settings->get('settings/mysql'));
    $mysql->execute($sql->get());
    return null;
  }
}