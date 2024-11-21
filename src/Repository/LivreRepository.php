<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // Question 8 => livre prix<200
    public function findLivresByPrixInferieur (float $prix): array
    {
       $query = $this->createQueryBuilder('l')
           ->andWhere('l.prix < :p')
            ->setParameter('p', $prix)
            ->getQuery()
            ->getResult();
       return $query;
    }

   //Question 9 => prix>200, qte<5 triés par ordre décroissante de titre
    public function findLivresByPrixSupAndQteInfAndOrdTitre (float $prix, int $nbExemplaire): array
    {
        $query = $this->createQueryBuilder('l')
            ->andWhere('l.prix > :p')
            ->andWhere( 'l.nbExemplaire < :q')
            ->setParameter('p', $prix)
            ->setParameter('q', $nbExemplaire)
            ->orderBy('l.titre', 'DESC')
            ->getQuery()
            ->getResult();
        return $query;
    }

    //Question 10 => prix<200 ou prix>500 et qte>10 triés par ordre croissante du prix
    public function findLivresByPrixSupOrInfAndQteSupAndOrdPrix (float $prixInf, float $prixSup, int $nbExemplaire): array
    {
        $query = $this->createQueryBuilder('l')
            ->orWhere('l.prix > :p1 OR  l.prix < :p2')
            ->andWhere( 'l.nbExemplaire > :q')
            ->setParameter('p2', $prixInf)
            ->setParameter('p1', $prixSup)
            ->setParameter('q', $nbExemplaire)
            ->orderBy('l.prix', 'ASC')
            ->getQuery()
            ->getResult();
        return $query;
    }

    //Question 11 => meme rq de qte10, recuperer uniquement les cinq premier résultat
    public function findLivresByPrixSupOrInfAndQteSupAndOrdPrixCinqPremRes (float $prixInf, float $prixSup, int $nbExemplaire): array
    {
        $query = $this->createQueryBuilder('l')
            ->orWhere('l.prix > :p1 OR  l.prix < :p2')
            ->andWhere( 'l.nbExemplaire > :q')
            ->setParameter('p2', $prixInf)
            ->setParameter('p1', $prixSup)
            ->setParameter('q', $nbExemplaire)
            ->orderBy('l.prix', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
        return $query;
    }


    //Question 12 => Recuperer les prix des livres dont le titre commence par' Mat'
    public function findPrixEtTitreLivresByTitreCommenceParMat(): array
    {
        $query = $this->createQueryBuilder('l')
            ->select('l.prix')  // Sélectionner uniquement le prix
            ->where('l.titre LIKE :titre')
            ->setParameter('titre', 'Mat%')  // Filtrer les titres qui commencent par 'Mat'
            ->getQuery()
            ->getResult();

        return $query;
    }

    //Question 13 => Recuperer le titre du livre ayant le prix Maximale
    public function findPrixMaxLivre(): ?float
    {
        $query = $this->createQueryBuilder('l')
            ->select('MAX(l.prix)')  // Sélectionner le prix maximal
            ->getQuery()
            ->getSingleScalarResult();  // Retourner un seul résultat

        return $query;  // Retourne le prix maximal ou null
    }


//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
