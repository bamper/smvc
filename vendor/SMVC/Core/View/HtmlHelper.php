<?php

namespace SMVC\Core\View;

use Symfony\Component\HttpFoundation\Request;

class HtmlHelper
{

    public static $storage = '/../view/public/templates/layout/';

    public static $layout_app_head = 'layout/app_head.php';

    public static $layout_app_footer = 'layout/app_footer.php';

    public static $layout_app_sidebar = 'layout/app_sidebar.php';

    public static $layout_app_error = 'layout/app_error.php';

//    public static function drawAppHead()
//    {
//        self::draw(self::$layout_app_head);
//    }
//
//    public static function drawAppFooter()
//    {
//        self::draw(self::$layout_app_footer);
//    }
//
//    public static function drawAppSidebar()
//    {
//        self::draw(self::$layout_app_sidebar);
//    }
//
////    public static function drawAppError($error)
////    {
////        extract('_error', $error);
////        self::draw(self::$layout_app_error);
////    }
//
//    private static function draw($template)
//    {
//        $request = Request::createFromGlobals();
//        $app = $request->server->get('DOCUMENT_ROOT').self::$storage.$template;
//        include $app;
//    }

}