<?php

namespace FrontBundle\Twig\Extension;

    use Doctrine\ORM\EntityManager;
    use Twig_Extension;

    class DatabaseGlobalsExtension extends Twig_Extension
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getGlobals()
    {
        return array (
            "socialMedia" => $this->em->getRepository('FrontBundle:Socialmedia')->find(1));
    }

    public function getName()
    {
        return "FrontBundle:ProfileExtension";
    }

}
