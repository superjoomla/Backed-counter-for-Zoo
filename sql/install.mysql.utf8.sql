 update #__modules
 set position = 'icon', published = 1
 where module = 'mod_sj_backend_counter_for_zoo';

 insert into #__modules_menu (moduleid, menuid)
 SELECT id, '0' from #__modules WHERE module = "mod_sj_backend_counter_for_zoo"
 ON DUPLICATE KEY UPDATE menuid='0';
