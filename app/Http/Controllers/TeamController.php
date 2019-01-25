<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 17.01.2019
 * Time: 15:34
 */

namespace App\Http\Controllers;


use Contentful\Delivery\Client as DeliveryClient;
use Contentful\RichText\Renderer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private $client;
    private $options;
    private $renderer;

    public function __construct(DeliveryClient $client, Renderer $renderer)
    {
        $this->client = $client;
        $this->renderer = $renderer;
        $this->options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);
        parent::__construct($client);
    }

    /**
     *
     */
    public function teams()
    {
        // @todo: There's no need for a teams view at the moment - but we keep it for future reference
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('team');
            //->orderBy('fields.price')
            //->setLocale('*');
        $entries_senioren = $this->client->getEntries($query->where('fields.kategorie','Senioren'));
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('team');
        $entries_junioren = $this->client->getEntries($query->where('fields.kategorie','Junioren'));

        /*foreach($entrys as $entry){
            dd($entry->Mannschaft);
        }*/
        return;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTeam($id)
    {
        $entry = $this->client->getEntry($id);

        if (!$entry) {
            abort(404);
        }
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('news');
        //$query->where('fields.verknpfung',$entry->getMannschaft());
        $query->linksToEntry($entry->getId());
        $query->orderBy('sys.createdAt',true);
        $query->setLimit(4);
        $news = $this->client->getEntries($query);

        return view('team',['title' => $entry->getMannschaft(), 'entry' => $entry,'options' => $this->options,'renderer' => $this->renderer,'news' => $news]);

    }
}