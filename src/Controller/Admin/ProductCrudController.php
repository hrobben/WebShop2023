<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $filename = ImageField::new('imageName', 'Afbeelding')
            ->setBasePath('uploads/images/products')
            ->setUploadDir('public/uploads/images/products')
            ->setRequired(false)
            ->setFormTypeOptions(
                [
                    'required' => false,
                ]
            );

        return [
            TextField::new('description'),
            TextareaField::new('longdescription'),
            MoneyField::new('price')->setCurrency('EUR'),
            AssociationField::new('category'),
            $filename,
        ];
    }

}
