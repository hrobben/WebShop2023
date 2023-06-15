<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class InvoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            /*IdField::new('id'),*/
            AssociationField::new('user'),
            DateTimeField::new('moment'),
            AssociationField::new('invoiceRows'),
        ];
    }

}
