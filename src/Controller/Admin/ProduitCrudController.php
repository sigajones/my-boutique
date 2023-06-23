<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Symfony\Component\Validator\Constraints\DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            ImageField::new('photo')->setBasePath('images/produit')->setUploadDir('public/images/produit'),
            TextEditorField::new('description')->onlyOnForms(),
            TextField::new('couleur'),
            TextField::new('taille'),
            ChoiceField::new('collection')->setChoices([
                'Homme' => 'H',
                'Femme' => 'F'
            ]),
            MoneyField::new('prix')->setCurrency('EUR'),
            IntegerField::new('stock'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $produit = new $entityFqcn;
        $produit->setDateEnregistrement(new \DateTime);
        return $produit;
    }
}
