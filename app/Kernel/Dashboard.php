<?php

namespace Orchid\Kernel;

use Illuminate\Support\Collection;
use Orchid\Access\Permissions;
use Orchid\Field\FieldStorage;
use Orchid\Filters\ContentFilterStorage;
use Orchid\Filters\FilterStorage;
use Orchid\Filters\Transformer\PlaceListTransformer;
use Orchid\Filters\Transformer\TransformerStorage;
use Orchid\Menu\Menu;
use Orchid\Menu\RouteMenu;
use Orchid\Type\TypeStorage;

class Dashboard
{
    /**
     * Orchid Version.
     */
    const VERSION = '0.0.1';

    /**
     * @var
     */
    public $menu = null;

    /**
     * @var null
     */
    public $permission = null;

    /**
     * @var array
     */
    public $types = [];

    /**
     * Dashboard constructor.
     */
    public function __construct()
    {
        $this->menu = new Menu();
        $this->permission = new Permissions();
        $this->types = new TypeStorage();
        $this->fields = new FieldStorage();
        $this->routeMenu = new RouteMenu();

        $this->fieldFilters = new FilterStorage();
        $this->contentFilters = new ContentFilterStorage();
        $this->transformers = new TransformerStorage();
    }

    /**
     * @return null|Menu
     */
    public function menu() : Menu
    {
        return $this->menu;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPermission() : Collection
    {
        return $this->permission->get();
    }

    /**
     * @return TypeStorage
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @return FieldStorage|FilterStorage
     */
    public function getFieldFilters()
    {
        return $this->fieldFilters;
    }

    /**
     * @return PlaceListTransformer|TransformerStorage
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * @return ContentFilterStorage
     */
    public function getContentFilters()
    {
        return $this->contentFilters;
    }

    /**
     * @param bool $sort
     *
     * @return array
     */
    public function types($sort = false) : array
    {
        return $this->types->all($sort);
    }

    /**
     * @return mixed
     */
    public function fields() : array
    {
        return $this->fields->all();
    }

    /**
     * @return RouteMenu
     */
    public function routeMenu() : RouteMenu
    {
        return $this->routeMenu;
    }

    /**
     * Get the class name for a given Spark model.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public static function model($key, $default = null) : object
    {
        return array_get(static::$options, 'models.'.$key, $default);
    }
}