<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        /* Testing api connection */
        $client   = $this->get('eight_points_guzzle.client.api_meetup');
        //$response = $client->get('/2/cities');
        //$response = $client->get('/find/locations');
        $response = $client->get('/find/locations?photo-host=public&sig_id=241706216&sig=c769c936d88d4e9b75dddfc4c92f1c9a578b1e13');
        echo $response->getBody();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
