<?php

namespace App\Form;

use App\Entity\Plan;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('gouvernorat', EntityType::class, [
                'class' => 'App\Entity\Gouvernorat',
                'mapped' => false
            ]);

        $builder->get('gouvernorat')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                //var_dump($form->getData());


                $form->getParent()->add('city', EntityType::class, [
                    'class' => 'App\Entity\City',
                    'placeholder' => 'Please select a sub category',
                    'choices' => $form->getData()->getCities()
                ]);


            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                dump($data);
                $sub_cat = $data->getCity();


                if ($sub_cat) {
                    $form->get('gouvernorat')->setData($sub_cat->getGouvernorat());

                    $form->add('city', EntityType::class, [
                        'class' => 'App\Entity\City',
                        'placeholder' => 'Please select a sub category',
                        'choices' => $sub_cat->getGouvernorat()->getCities()
                    ]);
                } else {
                    $form->add('city', EntityType::class, [
                        'class' => 'App\Entity\City',
                        'placeholder' => 'Please select a sub category',
                        'choices' => []
                    ]);
                }



            }
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plan::class,
        ]);
    }
}
