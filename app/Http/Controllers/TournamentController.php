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

    /**
     * TournamentController constructor.
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $entry = $this->client->getEntry($id);
        if (!$entry) {
            abort(404);
        }
        return view('tournament',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $this->options]);
    }
}