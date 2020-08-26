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
                    <div class="c-dropdown c-dropdown--notifications">
                        <div class="c-dropdown__header"></div>
                        <div class="c-dropdown__content"></div>
                    </div>
                </div>
                <div class="c-header-profile d-flex align-items-center pl-4">
                    <div class="c-header-profile-avatar mr-4">
                        <img src="<?= bloginfo('template_url');?>/images/user-avatar.jpg" alt="Profile Picture"/>
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
                <ul class="u-list">
                    <li class="c-menu__item is-active" data-toggle="tooltip" title="Home">
                        <div class="c-menu__item__inner">
                            <i class=""><img src="<?= bloginfo('template_url');?>/images/home.svg" alt="Home Icon"/></i>
                            <div class="c-menu-item__title">
                                <span>Home</span>
                            </div>
                        </div>
                    </li>
                    <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Courses">
                        <div class="c-menu__item__inner">
                            <i class=""><img src="<?= bloginfo('template_url');?>/images/course.svg" alt="Courses Icon"/></i>
                            <div class="c-menu-item__title">
                                <span>Courses</span>
                            </div>
                            <div class="c-menu-item__expand js-expand-submenu"><i class="fa fa-angle-down"></i></div>
                        </div>
                        <ul class="c-menu__submenu u-list">
                            <li>Payments</li>
                            <li>Maps</li>
                            <li>Notifications</li>
                        </ul>
                    </li>
                    <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Assessments">
                        <div class="c-menu__item__inner">
                            <i class=""><img src="<?= bloginfo('template_url');?>/images/assessment.svg" alt="Assessments Icon"/></i>
                            <div class="c-menu-item__title">
                                <span>Assessments</span>
                            </div>
                        </div>
                    </li>
                    <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Certificates">
                        <div class="c-menu__item__inner">
                            <i class=""><img src="<?= bloginfo('template_url');?>/images/certificates.svg" alt="Certificates Icon"/></i>
                            <div class="c-menu-item__title">
                                <span>Certificates</span>
                            </div>
                        </div>
                    </li>
                    <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Log Out">
                        <div class="c-menu__item__inner">
                            <i class=""><img src="<?= bloginfo('template_url');?>/images/logout.svg" alt="Log Out Icon"/></i>
                            <div class="c-menu-item__title">
                                <span>Log Out</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</sidebar>