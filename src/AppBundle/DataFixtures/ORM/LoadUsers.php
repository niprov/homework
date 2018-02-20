<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;


class LoadUsers implements ORMFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('test@gmail.com');
        $user->setPlainPassword('1234');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);
        $manager->flush();
    }
}