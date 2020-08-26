<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ISN_ACADEMY
 */

?>

</div><!-- #page -->

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<script >
    "use strict";

    var Dashboard = function () {
        var global = {
            tooltipOptions: {
                placement: "right"
            },
            menuClass: ".c-menu"
        };

        var menuChangeActive = function menuChangeActive(el) {
            var hasSubmenu = jQuery(el).hasClass("has-submenu");
            jQuery(global.menuClass + " .is-active").removeClass("is-active");
            jQuery(el).addClass("is-active");

            // if (hasSubmenu) {
            // 	$(el).find("ul").slideDown();
            // }
        };

        jQuery('#dashboard .c-header-icon.has-dropdown').click(function () {
            jQuery(this).find('.c-dropdown').toggleClass("c-dropdown-show");
        });

        if (jQuery("sidebar").hasClass("sidebar-is-expanded")) {
            jQuery('#dashboard main.l-main').addClass("move-left");
        }

        var sidebarChangeWidth = function sidebarChangeWidth() {
            var $menuItemsTitle = jQuery("li .menu-item__title");

            jQuery("sidebar").toggleClass("sidebar-is-reduced sidebar-is-expanded");
            jQuery(".hamburger-toggle").toggleClass("is-opened");

            if (jQuery("sidebar").hasClass("sidebar-is-expanded")) {
                jQuery('[data-toggle="tooltip"]').tooltip("destroy");
                jQuery('#dashboard main.l-main').addClass("move-left");
            } else {
                jQuery('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
                jQuery('#dashboard main.l-main').removeClass("move-left");
            }
        };

        return {
            init: function init() {
                jQuery(".js-hamburger").on("click", sidebarChangeWidth);

                jQuery(".js-menu li").on("click", function (e) {
                    menuChangeActive(e.currentTarget);
                });

                jQuery('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
            }
        };
    }();

    Dashboard.init();
</script>
</body>

</html>