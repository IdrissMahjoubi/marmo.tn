<?php

namespace BackBundle\Controller;

use FrontBundle\Entity\Socialmedia;
use FrontBundle\Form\SocialmediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SocialMediaController extends Controller
{

    public function showContactAction(Request $request)
    {
        $socialmedia=$this->getDoctrine()->getRepository(Socialmedia::class)->find(1);

        $form = $this->createForm(SocialmediaType::class,$socialmedia, array(
            'attr' => array('class'=>'form-horizontal'),
        ));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {

            $this->getDoctrine()->getManager()->flush();

        }

        return $this->render('@Back/SocialMedia/social_show.html.twig', array(
            'socialmedia' => $socialmedia,
            'form' => $form->createView(),
        ));
    }

}
