<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('genre')->setChoices([
                'Monsieur' => 'Monsieur',
                'Madame' => 'Madame',
                'Mademoiselle' => 'Mademoiselle',
            ]),
            TextField::new('nom'),
            TextField::new('prenom'),
            ChoiceField::new('poste')->setChoices([
                'Fontainier' => 'Fontainier',
                'Chef d\'equipe Chauffagiste' => 'Chef d\'equipe Chauffagiste', 
                'CHEF DE CHANTIER CVC' => 'CHEF DE CHANTIER CVC',
                'Chauffagiste' => 'Chauffagiste',
                'CAMION ATELIER' => 'CAMION ATELIER',
                'ELECTRICIEN' => 'ELECTRICIEN',
                'Chef de chantier' => 'Chef de chantier', 
                'Conducteur d\'engins' => 'Conducteur d\'engins',
                'Technicien de maintenance' => 'Technicien de maintenance',
                'Camion atelier Maintenance' => 'Camion atelier Maintenance',
                'Chef d\'atelier' => 'Chef d\'atelier',
                'Chef de chantier' => 'Chef de chantier',
                'Electricien' => 'Electricien',
                'Charge d\'affaires Maintenance' => 'Charge d\'affaires Maintenance', 
                'Electricien Chef de chantier' => 'Electricien Chef de chantier',
                'Automaticien' => 'Automaticien',
                'CHAUFFEUR ASPIRATRICE ET POLYVALENT' => 'CHAUFFEUR ASPIRATRICE ET POLYVALENT',
                'Plombier Chauffagiste' => 'Plombier Chauffagiste',
                'Assitante Administrative' => 'Assitante Administrative',
                'Chef de chantier' => 'Chef de chantier', 
                'Responsable et Gestionnaire de Parc' => 'Responsable et Gestionnaire de Parc',
                'Charge d\'affaires Industrie / Automatismes' => 'Charge d\'affaires Industrie / Automatismes',
                'Chauffeur Camion' => 'Chauffeur Camion',
                'Electricien Chef de chantier' => 'Electricien Chef de chantier',
                'Conducteur de travaux' => 'Conducteur de travaux',
                'Plombier Chauffagiste' => 'Plombier Chauffagiste',
                'Apprenti Monteur Installations Thermiques' => 'Apprenti Monteur Installations Thermiques',
                'Assistante de gestion' => 'Assistante de gestion', 
                'Plombier Chauffagiste' => 'Plombier Chauffagiste',
                'Technicien en regulation electrique' => 'Technicien en regulation electrique', 
                'Responsable de departement' => 'Responsable de departement', 
                'Chef d\'Equipe' => 'Chef d\'Equipe',
                'Technicien Bureau d\'Etude' => 'Technicien Bureau d\'Etude', 
                'Charge d\'affaires / Chiffrage' => 'Charge d\'affaires / Chiffrage',
                'ELECTRICIEN' => 'ELECTRICIEN',
                'CHAUFFEUR POIDS LOURDS' => 'CHAUFFEUR POIDS LOURDS',
                'TECHNICIEN BE CVC' => 'TECHNICIEN BE CVC',
                'Chef de chantier' => 'Chef de chantier', 
                'Chauffeur Camion / Terrassier' => 'Chauffeur Camion / Terrassier',
                'TUYAUTEUR' => 'TUYAUTEUR',
                'Responsable QSE' => 'Responsable QSE',
                'AIDE CANALISATEUR' => 'AIDE CANALISATEUR',
                'Terrassier / Fontainier / Enrobe' => 'Terrassier / Fontainier / Enrobe',
                'Fontainier' => 'Fontainier',
                'Technicien de maintenance' => 'Technicien de maintenance',
                'METTEUR AU POINT CVC' => 'METTEUR AU POINT CVC',
                'Plombier Chauffagiste' => 'Plombier Chauffagiste',
                'Conducteur de travaux' => 'Conducteur de travaux',
                'Chef d\'Equipe Plombier Chauffagiste' => 'Chef d\'Equipe Plombier Chauffagiste',
                'Technicien Bureau d\'Etude' => 'Technicien Bureau d\'Etude', 
                'Electricien Chef d\'Equipe' => 'Electricien Chef d\'Equipe',
                'Technicien Bureau d\'Etude' => 'Technicien Bureau d\'Etude', 
                'Charge d\'affaires Industrie / Automatismes' => 'Charge d\'affaires Industrie / Automatismes',
                'Electricien Chef de chantier' => 'Electricien Chef de chantier',
                'Apprenti' => 'Apprenti',
                'Chargee de Projet Activite TDF' => 'Chargee de Projet Activite TDF',
                'Directrice Service TP' => 'Directrice Service TP',
                'Directeur de Service CVC' => 'Directeur de Service CVC',
                'GESTIONNAIRE DISPATCHEUR' => 'GESTIONNAIRE DISPATCHEUR',
                'Fontainier Qualifie' => 'Fontainier Qualifie',
                'CHARGE D AFFAIRES CVC' => 'CHARGE D AFFAIRES CVC',
                'Chef d\'Equipe' => 'Chef d\'Equipe',
                'RESPONSABLE CHANTIER FRIGORISTE' => 'RESPONSABLE CHANTIER FRIGORISTE',
                'CHAUFFEUR PL/SPL CONDUCTEUR ENGINS' => 'CHAUFFEUR PL/SPL CONDUCTEUR ENGINS',
                'Electricien Chef d\'Equipe cableur' => 'Electricien Chef d\'Equipe cableur',
                'RESPONSABLE D EXPLOITATION MAINTENANCE' => 'RESPONSABLE D EXPLOITATION MAINTENANCE',
                'SOUDEUR QUALIFIE' => 'SOUDEUR QUALIFIE',
                'Electricien cableur qualifie' => 'Electricien cableur qualifie', 
                'TECHNICIEN MAINTENANCE' => 'TECHNICIEN MAINTENANCE',
                'Chauffeur Camion / Enrobe / Terrassier' => 'Chauffeur Camion / Enrobe / Terrassier', 
                'Assistante RH' => 'Assistante RH',
                'Assistante de gestion' => 'Assistante de gestion', 
                'Conducteur de Travaux' => 'Conducteur de Travaux',
                'CHARGE DE PROJET AUTOMATISME' => 'CHARGE DE PROJET AUTOMATISME',
                'TECHNICIENNE DE MAINTENANCE' => 'TECHNICIENNE DE MAINTENANCE',
                'Comptable' => 'Comptable',
                'Technicien de maintenance' => 'Technicien de maintenance',
                'Magasinier Achats Appro' => 'Magasinier Achats Appro',
                'Digital Support' => 'Digital Support',
                'Directeur General' => 'Directeur General',
            ]),
            ChoiceField::new('departement')->setChoices([
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
                '10' => '10',
            ]),
            ImageField::new('photo')
            ->setBasePath('uploads/employes/')
            ->setUploadDir('public/uploads/employes/')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
            DateField::new('amco')
        ];
    }
}
