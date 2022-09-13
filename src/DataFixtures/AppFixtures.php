<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listUser = [];
        for ($i=0; $i < 20; $i++){
            $user = new User();
            $user ->setfirstName("firstName". $i);
            $user ->setlastName("lastName". $i);
            $user ->setemail("user". $i ."@gmail.com");
            $user ->setpassword("**********");
            $user ->setPhone("2233445". $i);
            $manager ->persist($user);
            $listUser[] = $user;
         }
        $listOrder = [];
        $listStatut = ["valid", "in progress", "canceled"];
         for ($i=0; $i < 20; $i++){
             $order = new Order();
             $order ->setCode("123456". $i);
             $order ->setStatut($listStatut[array_rand($listStatut)]);
             $order ->setUsers($listUser[array_rand($listUser)]);
             $manager ->persist($order);
             $listOrder[] = $order;
         }

         //Add Categories
         $listCat = [];
         for ($i=0; $i < 20; $i++){
            $cat = new Cat();
            $cat ->setName("Category". $i);
            $manager ->persist($cat);
            $listCat[] = $cat;
         }

         //Add Products
      $listQuantity = [10, 20, 100, 150, 250, 300, 320, 350];
         for ($i=0; $i < 20; $i++){
            $product = new Product();
            $product ->setName("produit". $i);
            $product ->setDescription("lorem upsum lorem upsum tiprego parla di fant");
            $product ->setImage("image". $i);
            $product ->setQuantity($listQuantity[array_rand($listQuantity)]);
            $product ->setPrice($listQuantity[array_rand($listQuantity)]);
            $product ->setOrders($listOrder[array_rand($listOrder)]);
            $product ->setCategory($listCat[array_rand($listCat)]);
            $manager ->persist($product);

        }

        $manager->flush();
    }
}
