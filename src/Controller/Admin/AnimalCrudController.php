<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Enum\Species;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating(),
            ChoiceField::new('Espèce')->setChoices(Species::cases())->autocomplete()
            /*
            TextField::new('title'),
            TextEditorField::new('description'),
            */
        ];
    }
}
