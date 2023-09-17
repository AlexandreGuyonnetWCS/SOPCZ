<?php

namespace App\Form;

use App\Entity\DiplomeFull;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class DiplomesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $datas = $options['datas'];
        $diplomeType = [];
        foreach ($datas as $data) {
            $diplomeType[$data['diplomeType']] = $data['diplomeType'];
        }
        $diplomeName = [];
        foreach ($datas as $data) {
            $diplomeName[$data['diplomeName']] = $data['diplomeName'];
        }

        $builder

            ->add('diplomeType', ChoiceType::class, [
                'choices' => $diplomeType,
                'label' => 'Type de diplome',
                'placeholder' => 'Choisir un type de diplome',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
            ])
            ->add('diplomeName', ChoiceType::class, [
                'choices' => $diplomeName,
                'label' => 'Nom du diplome',
                'placeholder' => 'Choisir un nom de diplome',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
            ]);
        $formModifier = function (FormInterface $form, $diplomeType) {
            $datas = $form->getConfig()->getOption('datas');
            $diplomeName = [];
            foreach ($datas as $data) {
                if ($data['diplomeType'] === $diplomeType) {
                    $diplomeName[$data['diplomeName']] = $data['diplomeName'];
                }
            }
            $form->add('diplomeName', ChoiceType::class, [
                'choices' => $diplomeName,
                'label' => 'Nom du diplome',
                'placeholder' => 'Choisir un nom de diplome',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
            ]);
        };

        $builder->get('diplomeType')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $diplomeType = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $diplomeType);
            }
        );
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
