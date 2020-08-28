<sidebar class="sidebar-is-expanded">
    <header class="l-header">
        <div class="l-header__inner clearfix">
            <div class="c-search">
                <input class="c-search__input u-input" placeholder="&#128269;  Search for something" type="text"/>
            </div>
            <div class="header-icons-group">
                <div class="c-header-icon has-dropdown">
                    <span class="c-badge c-badge--header-icon animated shake">87</span>
                    <i class="fa fa-bell"></i>
                </div>
                <div class="c-header-profile d-flex align-items-center pl-4">
                    <div class="c-header-profile-avatar mr-4">
                        <?php if( ! is_user_logged_in() ) { ?>
                            <img src="<?= bloginfo('template_url');?>/images/user-avatar.jpg" alt="Profile Picture"/>
                        <?php } else {
                            $current_user = wp_get_current_user();
                            if($current_user->user_lastname){
                                $string = $current_user->user_lastname;
                                echo '<h1 class="avatar-name">' . $string[0] . '</h1>';
                            } else {
                                $string = $current_user->display_name;
                                echo '<h1 class="avatar-name">' . $string[0] . '</h1>';
                            }
                        } ?>
                    </div>
                    <div class="c-header-profile-name">Lekan Akinsaya</div>
                    <div class="c-header-icon has-dropdown">
                        <i class="fa fa-angle-down"></i>
                        <div class="c-dropdown">
                            <div class="c-dropdown__header"></div>
                            <div class="c-dropdown__content"></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="c-header-icon logout"><i class="fa fa-power-off"></i></div> -->
            </div>
        </div>
    </header>
    <div class="l-sidebar">
        <div class="logo">
            <div class="js-hamburger">
                <div class="logo__txt">
                    <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
                </div>
            </div>
        </div>
        <div class="l-sidebar__content">
            <nav class="c-menu js-menu">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'dashboard-menu',
                        'menu_id'        => 'dashboard-menu',
                        'container'      => false,
                        'menu_class'     => 'u-list',
                        'link_before'    => '<div class="c-menu__item__inner"><i>&nbsp;</i><div class="c-menu-item__title"><span>',
                        'link_after'     => '</span></div></div>'
                        // 'add_li_class'   => 'c-menu__item has-submenu',
                    )
                ); ?>
            </nav>
        </div>
    </div>
</sidebar>