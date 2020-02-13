<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
      * @return Stage[] Returns an array of Stage objects
    */
    
    public function findByTitre()
    {
        //Récupérer le gestionnaire d'entités
        $entityManager = $this->getEntityManager();

        //Construction de la requête
        $request = $entityManager->createQuery(
            'SELECT s, f, e
             FROM App\Entity\Stage s
             JOIN s.formations f
             JOIN s.nomEntreprise e
             ORDER BY s.titre');
            
            //Exécuter la requête et retourner les résultats
            return $request->execute();
    }

    /**
      * @return Stage[] Returns an array of Stage objects
    */
    
    public function getStage($id)
    {
        //Récupérer le gestionnaire d'entités
        $entityManager = $this->getEntityManager();

        //Construction de la requête
        $request = $entityManager->createQuery(
            'SELECT s, f, e
             FROM App\Entity\Stage s
             JOIN s.formations f
             JOIN s.nomEntreprise e
             WHERE s.id = :id');

            //Associer le paramètre à la valeur recherchée
            $request->setParameter('id', $id);
            
            //Exécuter la requête et retourner les résultats
            return $request->execute();
    }

    /**
      * @return Stage[] Returns an array of Stage objects
    */

    public function findByNomEntreprise($nomEntreprise)
    {
        return $this->createQueryBuilder('s')
            ->join('s.nomEntreprise', 'e')
            ->join('s.formations', 'f')
            ->andWhere('e.nom = :nomEntreprise')
            ->setParameter('nomEntreprise', $nomEntreprise)
            ->orderBy('s.titre', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
      * @return Stage[] Returns an array of Stage objects
    */

    public function findByFormation($nomCourtFormation)
    {
        //Récupérer le gestionnaire d'entités
        $entityManager = $this->getEntityManager();

        //Construction de la requête
        $request = $entityManager->createQuery(
            'SELECT s, f, e
             FROM App\Entity\Stage s
             JOIN s.formations f
             JOIN s.nomEntreprise e
             WHERE f.nomCourt = :nomCourtFormation');
            
            //Associer le paramètre à la valeur recherchée
            $request->setParameter('nomCourtFormation', $nomCourtFormation);
            
            //Exécuter la requête et retourner les résultats
            return $request->execute();
    }
}
