<?php

namespace App\Form;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExportFilterType extends AbstractType
{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $locations = $this->entityManager->getRepository(Location::class);
        $data = array_map(function($item){return array($item->getLocation()=>$item->getId());},$locations->findAll());
        array_unshift ($data,array("all"=>"0"));
        $builder
            ->add('location', ChoiceType::class, [
                'choices'=>$data
            ])
            ->add('from', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime('-4 days')

            ])
            ->add('To', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime('now')

            ])
            ->add("submit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
