<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use AppBundle\Entity\PhoneType;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class Contact Type
 *
 * Form for adding a new contact
 */
class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('lastName', TextType::class, array(
            'label' => 'Last Name',
            'constraints'   => array(new NotBlank(array('message' => 'Last name is mandatory'))),
        ));

        $builder->add('firstName', TextType::class, array(
            'label'          => 'First Name',
            'constraints'   => array(new NotBlank(array('message' => 'First Name is mandatory'))),
        ));

        $builder->add("phoneType", EntityType::class, array(
            'class'         => PhoneType::class,
            'label'         => 'Phone Type',
            'choice_label'  => 'type',
            'constraints'   => array(new NotBlank(array('message' => 'Phone Type is mandatory'))),
        ));

        $builder->add('number', PhoneNumberType::class, array(
            'default_region' => 'CA',
            'format' => PhoneNumberFormat::NATIONAL,
            'constraints'   => array(
                new NotBlank(array('message' => 'Phone Type is mandatory')),
                new PhoneNumber(array('message' => 'Provide a valid CA number', 'defaultRegion' => 'CA')),
                ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => Contact::class,
            'csrf_token_id'     => 'contact_type',
        ));
    }
}
