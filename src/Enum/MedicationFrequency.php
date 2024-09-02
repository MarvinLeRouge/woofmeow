<?php
namespace App\Enum;

enum MedicationFrequency: string {
    case Once = "1 fois et 1 seule";
    case OnceAWeek = "1 fois / semaine";
    case TwiceAweek = "2 fois / semaine";
    case OnceADay = "1 fois / jour";
    case TwiceADay = "2 fois / jour";
    case ThreeADay = "3 fois / jour";
    case FourADay = "4 fois / jour";
    case EveryFourHours = "toutes les 4 heures";
    case EveryThreeHours = "toutes les 3 heures";
    case EveryTwoHours = "toutes les 2 heures";
    case EveryHour = "toutes les heures";
}