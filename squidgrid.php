<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page;
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
            'onGetPageBlueprints'  => ['onGetPageBlueprints', 0],
            'onPageInitialized ' => ['onPageInitialized ', 0],
            'onPageContentRaw'  => ['onPageContentRaw', 0]
        ];
    }

    private function getCode()
    {

        "$(document).ready(function() {
            $('#{{ unique_id }}').mediaBoxes({
                boxesToLoadStart: {{ settings.boxesToLoadStart|default(8) }},
                boxesToLoad: {{ settings.boxesToLoad|default(4) }},
                lazyLoad: {{ settings.lazyLoad|default('true') }},
                horizontalSpaceBetweenBoxes: {{ settings.horizontalSpaceBetweenBoxes|default(15) }},
                verticalSpaceBetweenBoxes: {{ settings.verticalSpaceBetweenBoxes|default(15) }},
                columnWidth: '{{ settings.columnWidth|default('auto') }}',
                columns: {{ settings.columns|default(4) }},
                multipleFilterLogic: '{{ settings.multipleFilterLogic|default('AND') }}',
                filterContainer: '{{ settings.filterContainer|default('#filter') }}',
                search: '{{ settings.search|default('.media-boxes-search') }}',
                searchTarget: '{{ settings.searchTarget|default('.media-box-content') }}',
                sortContainer: '{{ settings.sortContainer|default('') }}',
                minBoxesPerFilter: {{ settings.minBoxesPerFilter|default(0) }},
                waitUntilThumbWithRatioLoads: {{ settings.waitUntilThumbWithRatioLoads|default('true') }},
                waitForAllThumbsNoMatterWhat: {{ settings.waitForAllThumbsNoMatterWhat|default('false') }},
                thumbnailOverlay: {{ settings.thumbnailOverlay|default('true') }},
                overlayEffect: '{{ settings.overlayEffect|default('fade') }}',
                overlaySpeed: {{ settings.overlaySpeed|default(200) }},
                overlayEasing: '{{ settings.overlayEasing|default('default') }}',
                showOnlyLoadedBoxesInPopup: {{ settings.showOnlyLoadedBoxesInPopup|default('false') }},
                considerFilteringInPopup: {{ settings.considerFilteringInPopup|default('true') }},
                deepLinkingOnPopup: {{ settings.deepLinkingOnPopup|default('true') }},
                deepLinkingOnFilter: {{ settings.deepLinkingOnFilter|default('true') }},
                deepLinkingOnSearch: {{ settings.deepLinkingOnSearch|default('false') }},
                gallery: {{ settings.gallery|default('true') }},
                LoadingWord: '{{ settings.enableDrag|default('Loading...') }}',
                loadMoreWord: '{{ settings.enableDrag|default('Load More') }}',
                noMoreEntriesWord: '{{ settings.enableDrag|default('No More Entries') }}'
            });
        });";


    }

    public function onPageContentRaw()
    {
        if (isset($this->grav['page']->header()->squidgrid)) {
//            $squidgrid = $this->grav['page']->header()->squidgrid[config];
        }else {
//            $squidgrid = $this->config->get('plugins.squidgrid');
        }

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
            'onPageInitialized ' => ['onPageInitialized ', 0],
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
    public function onPageInitialized() {
        dump('test');
    }
}

//        if ($this->grav['page']->template() == 'squidgrid') {
//        }