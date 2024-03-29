<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Student::class);
    }


    /**
     * @param $marks
     * @param $course
     * @param $branch
     * @param $institute
     * @param $gender
     * @param $district
     * @return Student[]
     */
    public function findStudents($marks, $course, $branch, $institute, $gender, $district): array {

        if( $gender == "Any") {

            $qb = $this->createQueryBuilder('s')
                ->andWhere('s.SemesterMarks > :marks')
                ->andWhere('s.Course = :course')
                ->andWhere('s.Branch = :branch')
                ->andWhere('s.Institute = :institute')
                ->andWhere('s.NativeDistrict= :district')
                ->setParameter('marks', $marks)
                ->setParameter('course', $course)
                ->setParameter('branch', $branch)
                ->setParameter('institute', $institute)
                ->setParameter('district', $district)
                ->getQuery();

        } else {

            $qb = $this->createQueryBuilder('s')
                ->andWhere('s.SemesterMarks > :marks')
                ->andWhere('s.Course = :course')
                ->andWhere('s.Branch = :branch')
                ->andWhere('s.Institute = :institute')
                ->andWhere('s.Gender = :gender')
                ->andWhere('s.NativeDistrict= :district')
                ->setParameter('marks', $marks)
                ->setParameter('course', $course)
                ->setParameter('branch', $branch)
                ->setParameter('institute', $institute)
                ->setParameter('gender', $gender)
                ->setParameter('district', $district)
                ->getQuery();

        }

        return $qb->execute();

    }

    // /**
    //  * @return Student[] Returns an array of Student objects
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
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
