<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vision;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/vision")
 */
class VisionController extends Controller
{
    /**
     * @Route("/")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Vision $vision */
        $vision = $this->get('serializer')->deserialize($request->getContent(), Vision::class, 'json');
        $vision->setDate(new \DateTime());
        if (!$vision->isValid()) {
            return new Response("vision not valid", 400);
        }

        $em->persist($vision);
        $em->flush();

        return new Response($this->get('serializer')->serialize($vision, 'json'));
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"})
     * @Method({"DELETE"})
     */
    public function removeAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Vision::class);
        $vision = $repo->find($id);
        if (empty($vision)) {
            return new Response("vision not found");
        }
        $this->getDoctrine()->getManager()->remove($vision);
        $this->getDoctrine()->getManager()->flush();
        return new Response($this->get('serializer')->serialize($vision, 'json'));
    }

    /**
     * @Route("/")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository(Vision::class)->findAll();
        return new Response($this->get('serializer')->serialize($all, 'json'));
    }

    /**
     * @Route("/leaderboard")
     */
    public function leaderboardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository(Vision::class)->groupByEmployeeName();
        return new Response($this->get('serializer')->serialize($all, 'json'));
    }

}
