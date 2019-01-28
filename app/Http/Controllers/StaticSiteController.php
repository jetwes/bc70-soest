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

class StaticSiteController extends Controller
{
    protected $client;
    protected $renderer;
    protected $options;

    /**
     * StaticSiteController constructor.
     * @param DeliveryClient $client
     * @param Renderer $renderer
     */
    public function __construct(DeliveryClient $client, Renderer $renderer)
    {
        $this->client = $client;
        $this->renderer = $renderer;
        $this->options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);
        parent::__construct($client);
    }

    public function kinder()
    {
        $entry = $this->getSingleEntry('Kinder+Sport Academy');
        if (!$entry) {
            abort(404);
        }
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }

    public function bc70()
    {
        $entry = $this->getSingleEntry('BC70 Academy');
        if (!$entry) {
            abort(404);
        }
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }

    public function showVerein()
    {
        $entry = $this->getSingleEntry('Verein');
        if (!$entry) {
            abort(404);
        }
        $picture = $this->client->getAsset('6cmRXX3risrqDJSoUs7O53');
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options,'picture' => $picture]);
    }

    public function showVorstand()
    {
        $entry = $this->getSingleEntry('Vorstand');
        if (!$entry) {
            abort(404);
        }

        $query = new \Contentful\Delivery\Query();
        $query->setContentType('person');
        $query->where('fields.typ','Vorstand');
        $query->orderBy('fields.name');
        //->setLocale('*');
        $vorstand = $this->client->getEntries($query);

        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options, 'personen' => $vorstand]);
    }

    public function showSchiedsrichter()
    {
        $entry = $this->getSingleEntry('Schiedsrichter');
        if (!$entry) {
            abort(404);
        }

        $picture = $this->client->getAsset('tfinEcnvrVHr6Bs9r8MsQ');

        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options,'picture' => $picture]);
    }

    public function showTrainer()
    {
        $entry = $this->getSingleEntry('Trainer');
        if (!$entry) {
            abort(404);
        }

        $query = new \Contentful\Delivery\Query();
        $query->setContentType('person');
        $query->where('fields.typ','Trainer');
        $query->orderBy('fields.sortierung');
        //->setLocale('*');
        $trainer = $this->client->getEntries($query);



        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options, 'personen' => $trainer]);
    }

    /**
     * @param $name
     * @return bool|\Contentful\Delivery\Resource\Entry
     */
    protected function getSingleEntry($name)
    {
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('seite');
        $query->where('fields.titel', $name);
        $entries = $this->client->getEntries($query);
        if ($entries) {
            $entry = $this->client->getEntry($entries[0]->getSystemProperties()->getId());
            return $entry;
        }
        return false;
    }
}