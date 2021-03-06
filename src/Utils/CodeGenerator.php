<?php


namespace App\Utils;

class CodeGenerator {

    /** generate the a code using the first carcater from each word in a label
     * @param $zone
     * @return string
     */
    public static function entityCodeGenerator($entity) {
        $zoneLabelParts = preg_split("/[\s]+/u", $entity->getLabel());
        $generatedCode = '';
        foreach ($zoneLabelParts as $zoneLabelPart) {
            $zoneLabelPart = mb_substr($zoneLabelPart, 0, 1,'UTF-8');
            $generatedCode.= mb_strtoupper($zoneLabelPart,'UTF-8');
        }
        return $generatedCode;
    }
    /** generate the subject code using the first carcater from each word
     * @param $zone
     * @return string
     */
    public static function subjectCodeGenerator($subject) {
        //Create the code from the last inserted Id
        $number = sprintf('%04d',$subject->getId());
        // Generated Code
        $generatedCode = "M".$number;

        return $generatedCode;
    }

    /**
     * generate a random string based on length
     * @param int $length
     *
     * @return string
     * @throws \Exception
     */
    public static function randomCodeGenerator($length = 10) {
        return (string) random_bytes($length);
    }

    /**
     * generateur de mot de passe
     * @param $nb_car
     * @param string $chaine
     * @return string
     */
    public static function passwordGenerator($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN123456789@-*$#/')
    {
        $nb_lettres = strlen($chaine) - 1;
        $generation = '';
        for ($i = 0; $i < $nb_car; $i++) {
            $pos        = mt_rand(0, $nb_lettres);
            $car        = $chaine[$pos];
            $generation .= $car;
        }

        return $generation;
    }

    /**
     * generateur de chaine de caractères
     * @param $nb_car
     * @param string $chaine
     * @return string
     */
    public static function randomeStringGenerator($nb_car = 8, $chaine = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN123456789') {
        $nb_lettres = strlen($chaine) - 1;
        $generation = '';
        for ($i = 0; $i < $nb_car; $i++) {
            $pos = mt_rand(0, $nb_lettres);
            $car = $chaine[$pos];
            $generation .= $car;
        }
        return $generation;
    }
    /** generate the subject code using the first carcater from each word
     * @param $zone
     * @return string
     */
    public static function trainingTypeCodeGenerator($trainingType) {
        //Create the code from the last inserted Id
        $number = sprintf('%04d',$trainingType->getId());
        // Generated Code
        $generatedCode = "T".$number;

        return $generatedCode;
    }

    /**
     * @return string
     */
    public static function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    public static function eventCodeGenerator($event) {
        //Create the code from the last inserted Id
        $number = sprintf('%04d',$event->getId());
        // Generated Code
        $generatedCode = "C".$number;

        return $generatedCode;
    }
    public static function hotelCodeGenerator($hotel) {
        //Create the code from the last inserted Id
        $number = sprintf('%04d',$hotel->getId());
        // Generated Code
        $generatedCode = "H".$number;

        return $generatedCode;
    }

}
