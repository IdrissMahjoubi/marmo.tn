<?php

namespace BackBundle\Controller;

use FrontBundle\Entity\Realisation;
use FrontBundle\Form\RealisationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RealisationController extends Controller
{




    public function addRealisationAction(Request $request)
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation, array(
            'attr' => array('class' => 'form-horizontal'),
        ));


        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid() && $realisation->getImage() !== null ){
                $em = $this->getDoctrine()->getManager();
                $em->persist($realisation);
                $em->flush();
                return $this->redirectToRoute('realisation_show');
            }else{
                return $this->render('@Back/Realisation/realisation_add.html.twig', ['message'=>'Choisir une image','form' => $form->createView()]);

            }
        }

        return $this->render('@Back/Realisation/realisation_add.html.twig', ['form' => $form->createView()]);
    }

    public function showRealisationAction()
    {
        $em=$this->getDoctrine()->getRepository(Realisation::class);
        $realisation=$em->findAll();

        return $this->render('@Back/Realisation/realisation_show.html.twig',['realisation' => $realisation]);
    }


    public function editRealisationAction(Request $request,Realisation $realisation)
    {
        $form = $this->createForm(RealisationType::class, $realisation, array(
            'attr' => array('class' => 'form-horizontal'),
        ));
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())

                $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('realisation_show');
        }

        return $this->render('@Back/Realisation/realisation_edit.html.twig', array(
            'realisation' => $realisation,
            'form' => $form->createView(),
        ));
    }



    public function deleteRealisationAction(Request $request,Realisation $realisation)
    {

        $em=$this->getDoctrine()->getManager();
        $em->remove($realisation->getImage());
        $em->remove($realisation);
        $em->flush();

        return $this->redirectToRoute('realisation_show');
    }






}
