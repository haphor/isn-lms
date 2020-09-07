<sidebar class="sidebar-is-expanded">
    <header class="l-header">
        <div class="l-header__inner clearfix">
            <div class="c-search">
            </div>
            <div>   
                <h3>Search Products</h3>
                <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
                    <input class="c-search__input u-input" name="s" placeholder="&#128269;  Search for something" type="text"/>
                    <input type="hidden" name="post_type" value="products" /> <!-- // hidden 'products' value -->
                    <!-- <input type="submit" alt="Search" value="Search" /> -->
                </form>
            </div>
            <div class="header-icons-group">
                <!-- <div class="c-header-icon has-dropdown">
                    <span class="c-badge c-badge--header-icon animated shake">87</span>
                    <i class="fa fa-bell"></i>
                </div> -->
                <div class="c-header-profile d-flex align-items-center pl-4">
                    <div class="c-header-profile-avatar mr-4">
                        <?php if( ! is_user_logged_in() ) { ?>
                            <h1 class="avatar-name">L</h1>
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
                    <?php if( is_user_logged_in() ) {
                        $current_user = wp_get_current_user(); ?>
                        <div class="c-header-profile-name"><?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname;?></div>
                        <div class="c-header-icon has-dropdown">
                            <!-- <i class="fa fa-angle-down"></i> -->
                            <div class="c-dropdown d-flex flex-column align-items-center">
                                <div class="c-dropdown__header"></div>
                                <div class="c-dropdown__content d-flex flex-column align-items-center"></div>
                            </div>
                        </div>
                    <?php }?>
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