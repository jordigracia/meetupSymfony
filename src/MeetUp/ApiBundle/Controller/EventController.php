<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MeetUp\CoreDomain\Event\Event;
use MeetUp\CoreDomain\Location\Location;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use DMS\Service\Meetup\MeetupKeyAuthClient;

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

        return $this->json($currentLocation, 200);
    }


    /**
     * @Rest\View
     */
    public function allEventsAction()
    {
        /*$users = $this->get('user_repository')->findAll();
        return array('users' => $users);*/

   /*     public function eventsAction($eventId, $lat, $lon, $city)
    {*/
        $key        = $this->getParameter('app.meetup.apikey');
        $encoders   = array(new XmlEncoder(), new JsonEncoder());
        $normalizers= array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $client     = MeetupKeyAuthClient::factory(array('key' => $key));
        $response = $client->getFindEvents();
        $response   = $client->getOpenEvents(array(
            'lat'   =>  $lat,
            'lon'   =>  $lon,
            'zip'   =>  $eventId,
            'city'  =>  $city,
        ));

        $data       = json_decode($response->getBody(), true);
        $events     = array();

        foreach ($data['results'] as $result)
        {
            $eventParse = $serializer->deserialize(json_encode($result), Event::class, 'json');
            $events[] = $eventParse;
        }

        return $this->render('default/events.html.twig', [
            'events'    =>  $events,
            'city'      =>  $city,
        ]);
    }
}