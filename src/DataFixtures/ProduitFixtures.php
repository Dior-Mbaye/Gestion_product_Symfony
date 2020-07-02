<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produit ;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Produit();
        $product -> setNom('Chips paysannes')
                 -> setPrix(250)
                 -> setDescription('description chocolat') 
                 ->setStock(8) 
                 ->setPhoto('https://www.monoprix.fr/assets/images/grocery/2712162/580x580.jpg?impolicy=Small_Grocery') ;
        $manager->persist($product);

        $product1 = new Produit();
        $product1 -> setNom('Jus de pomme')
                 -> setPrix(700)
                 -> setDescription('description chocolat') 
                 ->setStock(12) 
                 ->setPhoto('https://www.monoprix.fr/assets/images/grocery/1682628/580x580.jpg?impolicy=Small_Grocery') ;
        $manager->persist($product1);

        $product2 = new Produit();
        $product2 -> setNom('Confiture')
                 -> setPrix(650)
                 -> setDescription('description chocolat') 
                 ->setStock(52) 
                 ->setPhoto('https://www.monoprix.fr/assets/images/grocery/3010907/580x580.jpg?impolicy=Small_Grocery') ;
        $manager->persist($product2);

        $product3 = new Produit();
        $product3 -> setNom('Ferrero Rocher')
                 -> setPrix(1200)
                 -> setDescription('description chocolat') 
                 ->setStock(32) 
                 ->setPhoto('https://www.monoprix.fr/assets/images/grocery/289/580x580.jpg?impolicy=High_Grocery') ;
        $manager->persist($product3);

        $manager->flush();
    }
}
