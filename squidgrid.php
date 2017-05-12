<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class SquidGridPlugin
 * @package Grav\Plugin
 */
class SquidGridPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onGetPageBlueprints'  => ['onGetPageBlueprints', 0]
        ];
    }

    /**
     * Add page blueprints
     *
     * @param Event $event
     */
    public function onGetPageBlueprints(Event $event)
    {
        /** @var Types $types */
        $types = $event->types;
        $types->scanBlueprints('plugins://squidgrid/blueprints/pages/');
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onAssetsInitialized' => ['onAssetsInitialized', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0]
        ]);
    }

    public function onAssetsInitialized() {
        $assets = $this->grav['assets'];
        $assets->addCss('user/plugins/squidgrid/css/mediaBoxes.css');
        $assets->addJs('jquery', 101);

        $assets->addJs('user/plugins/squidgrid/js/vendor/Isotope/jquery.isotope.min.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/imagesLoaded/jquery.imagesLoaded.min.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/Transit/jquery.transit.min.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/jQuery Easing/jquery.easing.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/Waypoints/waypoints.min.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/Modernizr/modernizr.custom.min.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/vendor/Magnific Popup/jquery.magnific-popup.min.js', ['loading' => 'defer', 'group' => 'bottom']);

        $assets->addJs('user/plugins/squidgrid/js/jquery.mediaBoxes.dropdown.js', ['loading' => 'defer', 'group' => 'bottom']);
        $assets->addJs('user/plugins/squidgrid/js/jquery.mediaBoxes.js', ['loading' => 'defer', 'group' => 'bottom']);

    }
}
