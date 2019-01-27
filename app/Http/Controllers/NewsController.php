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
     */
    public function showNews($id)
    {
        try {
        	//$entry = $this->client->getEntry($id);
            $query = new \Contentful\Delivery\Query();
            $query->setContentType('news')
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

        

        $options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);

        return view('static_site',['title' => $entry->getTitel(),'entry' => $entry,'renderer' => $this->renderer,'options' => $options]);
    }

    /**
     * @param Request $request
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