<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductHistoryType;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('code'),
            TextField::new('name'),
            DateTimeField::new('createdAt')->onlyOnIndex(),
            CollectionField::new('productHistories')
                ->setEntryType(ProductHistoryType::class)
                ->allowAdd()
                ->allowDelete(),
        ];
    }

    public function createEntity(string $entityFqcn): Product
    {
        /** @var Product $product */
        $product = parent::createEntity($entityFqcn);
        $product->setCreatedAt(new DateTimeImmutable());

        return $product;
    }

}
