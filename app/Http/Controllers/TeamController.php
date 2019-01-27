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
    public function teams(Request $request)
    {
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('team');
            //->orderBy('fields.price')
            //->setLocale('*');
        $senioren = $this->client->getEntries($query->where('fields.kategorie','Senioren')->orderBy('fields.sortierung'));
        $junioren = $this->client->getEntries($query->where('fields.kategorie','Junioren')->orderBy('fields.sortierung'));
        if ($request->has('kategorie'))
            $teams = $this->client->getEntries($query->where('fields.kategorie',$request->get('kategorie'))->orderBy('fields.sortierung'));
        else $teams = ['senioren' => $senioren,'junioren' => $junioren];

         try {
            //$entry = $this->client->getEntry($id);
            $query = new \Contentful\Delivery\Query();
            $query->setContentType('seite')
            ->where('fields.titel','Teams');
            $entries = $this->client->getEntries($query);
            if ($entries->count() > 0)
                $entry = $entries[0];
            else return redirect(route('home'), 301);
        }

        catch (\Contentful\Core\Exception\BadRequestException $exception) {
            //if (!$entry) {
                abort(404, 'Leider wurde der Inhalt nicht gefunden. Wahrscheinlich rufen Sie einen veralteten Link auf.');
            //}
        }
        /*foreach($entrys as $entry){
            dd($entry->Mannschaft);
        }*/
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options, 'teams' => $teams]);    
    }

    /**
     * @param Request $request
     */
    public function showTeam($id)
    {
        
         try {
            //$entry = $this->client->getEntry($id);
            $query = new \Contentful\Delivery\Query();
            $query->setContentType('team')
            ->where('fields.slug',$id);
            $entries = $this->client->getEntries($query);
            if ($entries->count() > 0)
                $entry = $entries[0];
            else return redirect(route('home'), 301);
        }

        catch (\Contentful\Core\Exception\BadRequestException $exception) {
            //if (!$entry) {
                abort(404, 'Leider wurde der Inhalt nicht gefunden. Wahrscheinlich rufen Sie einen veralteten Link auf.');
            //}
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