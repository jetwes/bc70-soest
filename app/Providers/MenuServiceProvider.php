<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 18.01.2019
 * Time: 09:53
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Contentful\Delivery\Client as DeliveryClient;
use Spatie\Menu\Menu;

class MenuServiceProvider extends ServiceProvider
{
    protected $client;

    /**
     * @param DeliveryClient $client
     */
    public function boot(DeliveryClient $client)
    {
        $this->client = $client;
        $this->app->booted(function () {
            $teams_senior = $this->generateMenu('team',['fields.kategorie','Senioren']);
            $teams_junior = $this->generateMenu('team',['fields.kategorie','Junioren']);

            //$news =  $this->generateMenu('news');
            $camps =  $this->generateMenu('camps');
            $turniere =  $this->generateMenu('turnier');

            $menu = Menu::new()
                ->addClass('sm sm-blue')
                ->setAttribute('id', 'main-menu')
                ->link(route('home'), 'Home')
                ->submenu('<a class="has-submenu" href="#">Verein</a>', function (Menu $menu) {
                    $menu->addClass('sm-nowrap')
                        ->link(route('verein'),'Über den Verein')
                        ->link(route('vorstand'),'Vorstand')
                        ->link(route('trainer'),'Trainer')
                        ->link(route('schiedsrichter'),'Schiedsrichter')
                        ->link(route('downloads'),'Downloads');
                })
                ->submenu('<a class="has-submenu" href="/teams?kategorie=Senioren">Senioren</a>', function (Menu $menu) use($teams_senior) {
                    $menu
                        ->addClass('sm-nowrap');
                    foreach ($teams_senior as $team)
                        $menu->link(route('team.show',['id' => $team->getSlug()]),$team->mannschaft);
                })
                ->submenu('<a class="has-submenu" href="/teams?kategorie=Junioren">Junioren</a>', function (Menu $menu) use($teams_junior) {
                    $menu
                        ->addClass('sm-nowrap');
                    foreach ($teams_junior as $team)
                        $menu->link(route('team.show',['id' => $team->getSlug()]),$team->mannschaft);
                })
                ->submenu('<a class="has-submenu" href="/news">News</a>', function (Menu $menu) {
                    $menu->addClass('sm-nowrap')
                        ->link(route('news.showCategory',['kategorie' => 'Verein']),'Vereinsnews')
                        ->link(route('news.showCategory',['kategorie' => 'Senioren']),'News für Senioren')
                        ->link(route('news.showCategory',['kategorie' => 'Junioren']),'News für Junioren');

                })
                ->submenu('<a class="has-submenu" href="#">Camps</a>',function (Menu $menu) use($camps) {
                    $menu
                        ->addClass('sm-nowrap');
                    foreach ($camps as $camp)
                        $menu->link(route('camp.show',['id' => $camp->getSlug()]),$camp->titel);
                })
                ->submenu('<a class="has-submenu" href="#">Academy</a>',function (Menu $menu) {
                    $menu
                        ->addClass('sm-nowrap')
                        ->link(route('bc70-academy'),'BC70 Academy')
                        ->link(route('kinder-academy'),'Kinder+Sport Academy');

                })
                ->submenu('<a class="has-submenu" href="#">Wappen von Soest</a>',function (Menu $menu) use($turniere) {
                    $menu->addClass('sm-nowrap');
                    foreach ($turniere as $turnier)
                        $menu->link(route('tournament.show',['id' => $turnier->getSlug()]),$turnier->titel);
                })

                ->link(route('contact'), 'Kontakt')
                ->link(route('impress'), 'Impressum')
            ;
            //->setActiveFromRequest();

            $header_menu = Menu::new()
                ->addClass('ritekhed-user-section')
                ->link(route('home'),'Home')
                ->link(route('privacy'),'Datenschutz')
                ->link(route('impress'),'Impressum');

            view()->composer('layouts.header', function (View $view) use($menu,$header_menu) {
                $view->with('menu', $menu);
                $view->with('header_menu', $header_menu);
            });
        });
        /*view()->share('header_menu',$header_menu);
        view()->share('menu',$menu);*/
    }

    /**
     * @param $type
     * @param null $filter
     * @return \Contentful\Core\Resource\ResourceArray
     */
    protected function generateMenu($type,$filter = null)
    {
        //get Teams
        $query = new \Contentful\Delivery\Query();
        $query->setContentType($type);
        if($type == 'team')
            $query->orderBy('fields.sortierung');
        if ($filter) $query->where($filter[0],$filter[1]);
        //->orderBy('fields.price')
        //->setLocale('*');
        $teams = $this->client->getEntries($query);
        return $teams;
    }

}