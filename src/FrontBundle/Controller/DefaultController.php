<?php

namespace FrontBundle\Controller;

use FrontBundle\Entity\Contact;
use FrontBundle\Entity\Gallery;
use FrontBundle\Entity\Mailer;
use FrontBundle\Entity\Realisation;
use FrontBundle\Entity\Socialmedia;
use FrontBundle\Form\MailerType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\All;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine();

        $sliders = $em->getRepository(Gallery::class)->findBy(['type'=>'slider']);
        $about = $em->getRepository(Gallery::class)->findOneBy(['type'=>'about']);
        $gallery = $em->getRepository(Gallery::class)->findBy(['type'=>'galleryfront']);
        $realisation = $em->getRepository(Realisation::class)->getLastThreeRealisation();
        $showroom = $em->getRepository(Contact::class)->findOneBy(['location'=>'showroom']);
        $usine = $em->getRepository(Contact::class)->findOneBy(['location'=>'usine']);
        $Contact = ['showroom' => $showroom,'usine' => $usine];
        $socialmedia = $em->getRepository(Socialmedia::class)->find(1);



        //MAILER
        $mailer = new Mailer();

        $form = $this->createForm(MailerType::class,$mailer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $subject=$mailer->getSubject();
            $object=$mailer->getObject();
            $email=$mailer->getMail();
            $body = 'E-mail= '.$email .' '. $subject;

            $message = (new \Swift_Message($object))
                ->setFrom($email)
                ->setTo('idris.mahjoubi@esprit.tn')
                ->setBody($body);
            $this->get('mailer')->send($message);
            return $this->redirect($request->getUri());
        }

        return $this->render('@Front/Default/index.html.twig', array(
            'sliders' => $sliders,'socialMedia' => $socialmedia,'about'=> $about,'gallery' =>$gallery,'realisation' =>$realisation,'Contact'=>$Contact,
            'form' => $form->createView()
        ));
    }

    public function workAction()
    {
        $em = $this->getDoctrine();
        $realisation=$em->getRepository(Realisation::class)->findAll();
        return $this->render('@Front/Default/work.html.twig',['realisation' =>$realisation]);
    }

    public function workDetailsAction(Request $request,Realisation $realisation)
    {
        $gallery = $realisation->getGallery();

        return $this->render('@Front/Default/work_details.html.twig',['gallery' =>$gallery,'realisation' => $realisation]);
    }

    public function ContactAction()
    {
        $em = $this->getDoctrine();
        $showroom = $em->getRepository(Contact::class)->findOneBy(['location'=>'showroom']);
        $usine = $em->getRepository(Contact::class)->findOneBy(['location'=>'usine']);
        $Contact = ['showroom' => $showroom,'usine' => $usine];
        return $this->render('@Front/Default/contact.html.twig',['Contact'=>$Contact]);
    }

    public function galleryAction($filter)
    {
        $em = $this->getDoctrine();
        if ($filter == "all")
        {
            $gallery = $em->getRepository(Gallery::class)->findBy(['type'=>'gallery']);
        }else {
            $gallery = $em->getRepository(Gallery::class)->findBy(['type' => 'gallery', 'filter' => $filter]);
        }
        return $this->render('@Front/Default/gallery.html.twig',['gallery' =>$gallery]);
    }

}
