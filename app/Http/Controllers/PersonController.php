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

class PersonController extends Controller
{
    private $client;
    private $options;
    private $renderer;

    /**
     * PersonController constructor.
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
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('news');
        //$query->where('fields.verknpfung',$entry->getMannschaft());

        return view('person',[ 'entry' => $entry,'options' => $this->options,'renderer' => $this->renderer]);
    }
}