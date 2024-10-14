<?php

namespace App\DataFixtures;

use App\Entity\Categori;  // Utilisation de la classe Categori
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use DateTimeImmutable;
use DateTime;
use App\Entity\Actor;
use App\Entity\Movie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        $actors = $faker->actors($gender = null, $count = 190, $duplicates = false);
        $createdActors = [];
        foreach ($actors as $item) {
            $fullname = $item; // ex: Christian Bale
            $fullnameExploded = explode(' ', $fullname);

            $firstname = $fullnameExploded[0]; // ex: Christian
            $lastname = $fullnameExploded[1]; // ex: Bale

            $actor = new Actor();
            $actor->setLastname($lastname);
            $actor->setFirstname($firstname);
            $actor->setDob($faker->dateTimeThisCentury());
            $actor->setCreateAt(new DateTimeImmutable());
            $actor->setNationality($faker->countryCode());
            $actor->setGender($faker->randomElement(['Women', 'Men']));
            $actor->setBio($faker->text(2000));
            $actor->setAwards($faker->numberBetween(0, 100));
            $actor->setCreateAT(new DateTimeImmutable());
            $actor->setUpdateAt(new \DateTime());

            $createdActors[] = $actor;

            $manager->persist($actor);
        }

        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $movies = $faker->movies(100);
        $createdMovies = [];
        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setTitle($item);
            $movie->setDirector($faker->name());
            $movie->setReleaseDate($faker->dateTimeThisCentury());
            $movie->setEntries($faker->numberBetween(0, 10000));
            $movie->setDuration($faker->numberBetween(60, 180));
            $movie->setRating($faker->randomFloat(1, 0, 5));
            $movie->setCreateAT(new DateTimeImmutable());
            $movie->setUpdateAt(new \DateTime());

            $createdMovies[] = $movie;

            shuffle($createdActors);
            $createdActorsSliced = array_slice($createdActors, 0, 4);
            foreach ($createdActorsSliced as $actor) {
                $movie->addActor($actor);
            }
            $manager->persist($movie);
        }

        foreach ($movies as $item) {
            $categori = new Categori();  // Utilisation de Categori ici
            $categori->setTitle($faker->movieGenre());
            $categori->setCreatedAT(new DateTimeImmutable());
            $categori->setUpdatedAt(new DateTime());
            shuffle($createdMovies);
            $movies = array_slice($createdMovies, 0, 5);

            foreach ($movies as $movie) {
                $categori->addMovie($movie);
            }

            $manager->persist($categori);
        }

        $manager->flush();
    }
}
