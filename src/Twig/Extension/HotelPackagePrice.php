<?php

namespace App\Twig\Extension;



use App\Entity\Devise;
use App\Entity\Event;
use App\Entity\Hotel;
use App\Entity\HotelPackage;
use App\Entity\HotelPackagePeriode;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HotelPackagePrice extends AbstractExtension
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('hotelPrice', array($this, 'getHotelPrice')),
            new \Twig_SimpleFunction('packagePrice', array($this, 'getPackagePrice')),
            new \Twig_SimpleFunction('getDevise', array($this, 'getDevise')),
            new \Twig_SimpleFunction('getPriceByDevise', array($this, 'getPriceByDevise')),
        );
    }


    public function getDevise( $currency)
    {
        $em = $this->container->get('doctrine')->getManager();
        $devise_criterias = ['code' => $currency];
        $devise = $em
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;
        if(is_null($devise)){
            return '';
        }

        return $devise->getSymbol();
    }

    public function getPriceByDevise(float $price = 0,  $currency)
    {
        $em = $this->container->get('doctrine')->getManager();
        $devise_criterias = ['code' => $currency];
        $devise = $em
            ->getRepository(Devise::class)
            ->findOneBy($devise_criterias)
        ;
        if(is_null($devise)){
            return 0 ;
        }

        return ($price * $devise->getCoeff());
    }


    public function getHotelPrice(Hotel $hotel)
    {
        $em = $this->container->get('doctrine')->getManager();
        $minimum = 0;

        $packages = $em->getRepository('App\Entity\HotelPackage')->findBy(array('enabled' => true, 'hotel' => $hotel));


        $minimTemp = 0;
        foreach ($packages as $package){

            $prix = $this->getPackagePrice($package);

            if($minimTemp == 0){
                $minimTemp = $prix;
            }else {
                if($prix < $minimTemp){
                    //$minimTemp = $prix;
                }
            }
        }

        $minimum = $minimum + $minimTemp;




        return $minimum;
    }


    public function getPackagePrice(HotelPackage $package)
    {
        $session = $this->container->get('session');
        $em = $this->container->get('doctrine')->getManager();

        $event = $em->getRepository(Event::class)->findOneBy(['enabled' => 1]);






        $eventDateDebut =  \DateTime::createFromFormat("Y-m-d", $event->getDateDebut()->format('Y-m-d'));


        $arPeriodes = [];


            $newDate = $eventDateDebut;

            $periode = $em->getRepository('App:HotelPackagePeriode')->getPackagePeriodeByDate($newDate, $package);
            array_push($arPeriodes, $periode);



        $total = 0;

        if(!empty($arPeriodes)){
            foreach($arPeriodes as $periodes){
                if(!empty($periodes)){
                    $periodeTotal = 0;
                    foreach($periodes as $periode){

                        $prix = $periode->getPrixAchat() + $periode->getCommision();
                        if($periodeTotal == 0){
                            $periodeTotal = $prix;
                        }else {
                            if($prix < $periodeTotal){
                                $periodeTotal = $prix;
                            }
                        }
                    }
                    $total = $total + $periodeTotal;
                }
            }
        }


        return $total;
    }


    public function daysBetweenDates(\DateTime $dateOne, \DateTime $dateTwo)
    {

        $d1 = strtotime($dateOne->format('Y-m-d H:i:s'));
        $d2 = strtotime($dateTwo->format('Y-m-d H:i:s'));

        $diff   = $d2 - $d1;
        $nbDays = (int)($diff / 86400);

        return $nbDays;
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hotel_package_price';
    }
}
