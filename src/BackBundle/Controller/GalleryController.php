<?php

namespace BackBundle\Controller;

use FrontBundle\Entity\Gallery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Form\GalleryType;




class GalleryController extends Controller
{
    public function addGalleryAction(Request $request)
    {

        $gallery = new Gallery();
        $form = $this->createForm(GalleryType::class, $gallery, array(
            'attr' => array('class' => 'form-horizontal'),
        ));


        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid() && $gallery->getImage() !== null) {

                $gallery->setType('gallery');
                $em = $this->getDoctrine()->getManager();
                $em->persist($gallery);
                $em->flush();
                return $this->redirectToRoute('gallery_show');

            }else {
                return $this->render('@Back/Gallery/gallery_add.html.twig', ['message'=>'Choisir une image','form' => $form->createView()]);
            }
        }

        return $this->render('@Back/Gallery/gallery_add.html.twig', ['form' => $form->createView()]);
    }

    public function showGalleryAction()
    {
        $em = $this->getDoctrine()->getRepository(Gallery::class);
        $gallery = $em->findBy(['type' => 'gallery']);

        return $this->render('@Back/Gallery/gallery_show.html.twig', ['gallery' => $gallery]);
    }


    public function editGalleryAction(Request $request, Gallery $gallery)
    {
        $form = $this->createForm(GalleryType::class, $gallery, array(
            'attr' => array('class' => 'form-horizontal'),
        ));
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('gallery_show');
        }

       return $this->render('@Back/Gallery/gallery_edit.html.twig', array(
           'gallery' => $gallery,
           'form' => $form->createView(),
       ));
   }



   public function deleteGalleryAction(Request $request,Gallery $gallery)
   {
       $em=$this->getDoctrine()->getManager();
       $em->remove($gallery->getImage());
       $em->remove($gallery);
       $em->flush();

       return $this->redirectToRoute('gallery_show');
   }







}
