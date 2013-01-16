<?php


class tzPlugin {
    
        public static $pluginsList;
        
        private static function getPluginsList(){
            self::$pluginsList = Spyc::YAMLLoad(ROOT.'/plugins/pluginslist.yml');

        }
        
        public static function getPlugin($pluginName, array $params = array()){
            var_dump(self::$pluginsList);
            if(is_null(self::$pluginsList)) {
                ;
                self::getPluginsList();
            }

            if(self::$pluginsList && array_key_exists($pluginName, self::$pluginsList) && is_file(ROOT.'/plugins/'.$pluginName.'/'.$pluginName.'.php')){
                require_once(ROOT.'/plugins/'.$pluginName.'/'.$pluginName.'.php');
                if(count($params)) {
                    $instance = new $pluginName($params);
                }
                else {
                    $instance = new $pluginName();
                }
                if(isset($instance)){
                    return($instance);
                }
            }
            return(FALSE); // THE PLUGIN DOES NOT EXIST OR IS NOT INITIALISED IN pluginslist.yml
	}
}