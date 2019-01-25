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
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $client;
    private $options;
    private $renderer;

    /**
     * NewsController constructor.
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
    public function showNews($id)
    {
        $entry = $this->client->getEntry($id);

        if (!$entry) {
            abort(404);
        }

        $options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);

        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $options]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewsCategory(Request $request)
    {
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('news')
            ->where('fields.typ',$request->get('kategorie'))
            ->orderBy('sys.createdAt',true);
        $news = $this->client->getEntries($query);
        return view('news',['news' => $news, 'options' => $this->options, 'renderer' => $this->renderer, 'title' => 'News '.$request->get('kategorie')]);
    }

}