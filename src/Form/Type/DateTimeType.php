<?php

namespace OHMedia\TimezoneBundle\Form\Type;

use OHMedia\TimezoneBundle\Service\Timezone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as BaseDateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    private $timezone;

    public function __construct(Timezone $timezone)
    {
        $this->timezone = $timezone;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'model_timezone' => 'UTC',
            'view_timezone' => $this->timezone->get(),
        ]);
    }

    public function getParent(): ?string
    {
        return BaseDateTimeType::class;
    }
}
