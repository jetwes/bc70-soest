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

class TournamentController extends Controller
{
    private $client;
    private $renderer;
    private $options;

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
     * @param Request $request
     */
    public function show($id)
    {
        
         try {
            //$entry = $this->client->getEntry($id);
            $query = new \Contentful\Delivery\Query();
            $query->setContentType('turnier')
            ->where('fields.slug',$id);
            $entries = $this->client->getEntries($query);
            if ($entries->count() > 0)
                $entry = $entries[0];
            else abort(404, 'Leider wurde der Inhalt nicht gefunden. Wahrscheinlich rufen Sie einen veralteten Link auf.');
        }

        catch (\Contentful\Core\Exception\BadRequestException $exception) {
            //if (!$entry) {
                abort(404, 'Leider wurde der Inhalt nicht gefunden. Wahrscheinlich rufen Sie einen veralteten Link auf.');
            //}
        }
        return view('tournament',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }
}