<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\User;
use App\Entity\Order;
use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\UserAuth;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
         // Création d'un user "normal"
         $userAuth = new User();
         $userAuth ->setfirstName("User");
         $userAuth ->setlastName("Client");
         $userAuth->setEmail("user@venteapi.com");
         $userAuth ->setPhone("2233445");
         $userAuth->setRoles(["ROLE_USER"]);
         $userAuth->setPassword($this->userPasswordHasher->hashPassword($userAuth, "password"));
         $userAuth->setCreatedAt(new DateTimeImmutable());
         $userAuth->setUpdatedAt(new DateTimeImmutable());
         $manager->persist($userAuth);
         
         // Création d'un user admin
         $userAdmin = new User();
         $userAdmin ->setfirstName("Admin");
            $userAdmin ->setlastName("Admin");
            $userAdmin->setPhone('1234567890');
         $userAdmin->setEmail("admin@venteapi.com");
         $userAdmin->setRoles(["ROLE_ADMIN"]);
         $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
         $userAdmin->setCreatedAt(new DateTimeImmutable());
         $userAdmin->setUpdatedAt(new DateTimeImmutable());
         $manager->persist($userAdmin);
        $listUser = [];
        for ($i=0; $i < 20; $i++){
            $user = new User();
            $user ->setfirstName("firstName". $i);
            $user ->setlastName("lastName". $i);
            $user ->setemail("user". $i ."@gmail.com");
            $user ->setpassword($this->userPasswordHasher->hashPassword($userAuth, "password"));
            $user ->setPhone("2233445". $i);
            $user->setRoles(["ROLE_USER"]);
            $user->setCreatedAt(new DateTimeImmutable());
            $user->setUpdatedAt(new DateTimeImmutable());
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
             $order->setCreatedAt(new DateTimeImmutable());
             $order->setUpdatedAt(new DateTimeImmutable());
             $manager ->persist($order);
             $listOrder[] = $order;
         }

         //Add Categories
         $listCat = [];
         for ($i=0; $i < 20; $i++){
            $cat = new Cat();
            $cat ->setName("Category". $i);
            $cat->setCreatedAt(new DateTimeImmutable());
            $cat->setUpdatedAt(new DateTimeImmutable());
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
            $product->setCreatedAt(new DateTimeImmutable());
            $product->setUpdatedAt(new DateTimeImmutable());
            $manager ->persist($product);

        }

        $manager->flush();
    }
}
