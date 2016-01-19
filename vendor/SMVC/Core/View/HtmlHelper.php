<?php

namespace SMVC\Core\View;

class HtmlHelper
{

    private static $nav_template =
        '<li class="{ACTIVE}">
            <a href="{ROUTE}">
                <i class="menu-icon fa {FA_ICON}"></i>
                <span class="menu-text"> {NAME} </span>
            </a>

            <b class="arrow"></b>
        </li>';

    public static $storage = '/../view/public/templates/layout/';

    public static $layout_app_head = 'layout/app_head.php';

    public static $layout_app_footer = 'layout/app_footer.php';

    public static $layout_app_sidebar = 'layout/app_sidebar.php';

    public static $layout_app_error = 'layout/app_error.php';

    public static function drawSidebarMenu($menu_list =
                                            array(
                                                array(
                                                    'active' => 'active',
                                                    'route' => '/',
                                                    'name' => 'Dashboard',
                                                    'fa_icon' => 'fa-tachometer'
                                                )
                                            ))
    {
        $menu = '';
        foreach($menu_list as $key => $sidebar_menu)
        {
            $menu .= str_replace(array('{ACTIVE}', '{ROUTE}', '{NAME}', '{FA_ICON}'), $sidebar_menu, self::$nav_template);
        }
        return $menu;
    }

}