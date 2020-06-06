<?php
/**
 * Created by IntelliJ IDEA.
 * User: LT
 * Date: 25/06/17
 * Time: 12:48 PM
 */

namespace bootphp\rudrax {

    use bootphp\loader\Loader;

    class AppLoader extends Loader
    {
        public static $RX_MODE_DEBUG = FALSE;
        public static $DISPLAY_ERROR = FALSE;

        public function invoke($dir)
        {
            
            if (static::$DISPLAY_ERROR) {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                error_reporting(E_ALL & ~E_DEPRECATED);
                //\bootphp\fn::println("DISPLAYING ERROR");
            } else {
                ini_set('display_errors', 0);
                ini_set('error_reporting', 0);
                error_reporting(0);
            }
            
            require_once("lib/rudrax/boot/RudraX.php");
            try {
                \RudraX::invoke(array(
                    'RX_MODE_DEBUG' => static::$RX_MODE_DEBUG,
                    'PROJECT_ROOT_DIR' => $dir . "/"
                ));
            } catch (Exception $e) {
                $this->controller_exception_handler($e);
            }
        }

        public function controller_exception_handler($exception)
        {
            echo "Uncaught exception: ", $exception->getMessage(), "\n";
        }

    }

}


