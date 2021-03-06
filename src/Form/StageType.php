<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Entreprise;
use App\Entity\Formation;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Repository\FormationRepository;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description', TextareaType::class)
            ->add('email')
            ->add('nomEntreprise', EntrepriseType::class)
            ->add('formations', EntityType::class, array(

                'class' => Formation::class,
                /*'query_builder' => function(FormationRepository $repoFormation){
                    return $repoFormation->createQueryBuilder('f')
                        ->andWhere('f.nomCourt LIKE \'DU%\'')
                        ->orderBy('f.nomCourt', 'ASC');
                },*/
                'choice_label' => function(Formation $formation){
                    return $formation->getNomCourt()." ".$formation->getNomLong();
                },

                'multiple' => true,
                'expanded' => true,
            )
            );
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
