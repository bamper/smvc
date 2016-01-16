<?php

namespace SMVC\Core\View;

use Symfony\Component\HttpFoundation\Request;

class HtmlHelper
{

    public static $storage = '/../view/public/templates/layout/';

    public static $layout_app_head = 'app_head.php';

    public static $layout_app_footer = 'app_footer.php';

    public static $layout_app_sidebar = 'app_sidebar.php';

    public static function drawAppHead()
    {
        self::draw(self::$layout_app_head);
    }

    public static function drawAppFooter()
    {
        self::draw(self::$layout_app_footer);
    }

    public static function drawAppSidebar()
    {
        self::draw(self::$layout_app_sidebar);
    }

    private static function draw($template)
    {
        $request = Request::createFromGlobals();
        $app = $request->server->get('DOCUMENT_ROOT').self::$storage.$template;
        include $app;
    }

}