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

        public function __construct()
        {
            if (static::$DISPLAY_ERROR) {
                error_reporting(E_ALL & ~E_DEPRECATED);
            } else {
                ini_set('display_errors', 0);
                ini_set('error_reporting', 0);
                error_reporting(0);
            }
        }

        public function invoke($dir)
        {
            require_once("RudraX.php");
            try {
                RudraX::invoke(array(
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


