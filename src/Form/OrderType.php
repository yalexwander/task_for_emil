<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Item;
use App\Validator\Order\TaxNum;
use App\Engine\CountryHelper;
use App\Twig\MoneyFormatFilter;

class OrderType extends AbstractType
{
    protected CountryHelper $countryHelper;
    protected MoneyFormatFilter $format;

    public function __construct(CountryHelper $countryHelper, MoneyFormatFilter $format)
    {
        $this->countryHelper = $countryHelper;
        $this->format = $format;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('item', EntityType::class, [
                'class' => Item::class,
                'choice_label' => function (Item $entity) {
                    return $entity->getName() . " " . $this->format->formatMoney($entity->getPrice());
                },
            ])
            ->add('tax_num',
                  TextType::class,
                  [ 'constraints' => [new TaxNum([ "countryHelper" => $this->countryHelper ] ) ] ],
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
