<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 22.01.2019
 * Time: 10:27
 */

namespace App\Http\Controllers;

use Contentful\Delivery\Client as DeliveryClient;
use Contentful\RichText\Renderer;

class ContactController extends Controller
{
    protected $client;
    protected $renderer;
    protected $options;

    public function __construct(DeliveryClient $client, Renderer $renderer)
    {
        $this->client = $client;
        $this->renderer = $renderer;
        $this->options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);
        parent::__construct($client);
    }

    public function index()
    {
        $entry = $this->getSingleEntry('Kontakt');
        if (!$entry) {
            abort(404);
        }
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }

    public function impress()
    {
        $entry = $this->getSingleEntry('Impressum');
        if (!$entry) {
            abort(404);
        }
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }

    public function privacy()
    {
        $entry = $this->getSingleEntry('Datenschutzerklärung');
        if (!$entry) {
            abort(404);
        }
        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }

    /**
     * @param $name
     * @return bool|\Contentful\Delivery\Resource\Entry
     */
    protected function getSingleEntry($name)
    {
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('seite');
        $query->where('fields.titel',$name);
        $entries = $this->client->getEntries($query);
        if ($entries) {
            $entry = $this->client->getEntry($entries[0]->getSystemProperties()->getId());
            return $entry;
        }
        return false;
    }
}