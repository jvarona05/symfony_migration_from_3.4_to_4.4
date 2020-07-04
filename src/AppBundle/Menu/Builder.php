<?php

namespace AppBundle\Menu;

use Knp\Menu\MenuFactory;

class Builder
{
    public function mainMenu(MenuFactory $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');
        $menu->addChild('Home', ['route' => 'homepage'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Cars', ['route' => 'cars'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Manage Cars', ['route' => 'car_index'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');
        return $menu;
    }
}