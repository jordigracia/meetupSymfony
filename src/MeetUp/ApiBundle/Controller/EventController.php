<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use DMS\Service\Meetup\MeetupKeyAuthClient;

use AppBundle\Entity\DTOs\Location;
use AppBundle\Entity\DTOs\Event;

class EventController extends Controller
{
    /**
     * @Rest\View
     */
    public function locationsAction()
    {
        $key        = $this->getParameter('app.meetup.apikey');
        $client     = MeetupKeyAuthClient::factory(array('key' => $key));
        $response   = $client->getFindLocations();
        $currentLocation = json_decode($response->getBody());

        return new jsonResponse(array('currentLocation'=> $currentLocation));
    }


    public function currentLocationAction()
    {
        $key        = $this->getParameter('app.meetup.apikey');
        $client     = MeetupKeyAuthClient::factory(array('key' => $key));

        $response   = $client->getFindLocations();
        $currentLocations = json_decode($response->getBody());
        $currentLocation = reset($currentLocations);

        return new JsonResponse(array('currentLocation'=>$currentLocation));
    }


    /**
     * @Rest\View
     */
    public function allEventsAction()
    {
        $currentLocation = $this->currentLocationAction()->getContent();
        $key        = $this->getParameter('app.meetup.apikey');
        $serializer = $this->get('jms_serializer');

        foreach (json_decode($currentLocation) as $loc)
        {
            $location = $serializer->deserialize(json_encode($loc),Location::class, 'json');
        }

        $client     = MeetupKeyAuthClient::factory(array('key' => $key));
        $response   = $client->getOpenEvents(array(
            'lat'   =>  $location->getLat(),
            'lon'   =>  $location->getLon(),
            'zip'   =>  $location->getZip(),
            'city'  =>  $location->getCity(),
        ));

        $data       = json_decode($response->getBody(), true);
        return new JsonResponse (array('events'=>$data['results']));
    }
}