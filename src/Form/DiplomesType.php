<?php

namespace App\Form;

use App\Entity\DiplomeFull;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DiplomesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $diplomeType = [];
        foreach ($options['datas'] as $data) {
            $diplomeType[$data['diplomeType']] = $data['diplomeType'];
        }
        $diplomeName = [];
        foreach ($options['datas'] as $data) {
            $diplomeName[$data['diplomeName']] = $data['diplomeName'];
        }

        $builder

            ->add('diplomeType', ChoiceType::class, [
                'choices' => $diplomeType,
                'label' => 'Type de diplome',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
            ])
            ->add('diplomeName', ChoiceType::class, [
                'choices' => $diplomeName,
                'label' => 'Nom du diplome',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DiplomeFull::class,
            'datas' => null,
            'numero' => null,
        ]);
    }
}
