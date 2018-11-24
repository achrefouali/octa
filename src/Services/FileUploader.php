<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 18/10/2018
 * Time: 13:15
 */

namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;
    private $oldFileName = null;



    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);

            if(!empty($this->oldFileName)){
                if(file_exists($this->getTargetDirectory().'/'.$this->oldFileName)){
                    unlink($this->getTargetDirectory().'/'.$this->oldFileName);
                }
            }
        } catch (FileException $e) {

            throw new \Exception("Can't Upload File".$e->getMessage() );
        }

        return $fileName;
    }

    public function getTargetDirectory(): ?string
    {
        return $this->targetDirectory;
    }


    public function setTargetDirectory(?string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function setOldFilename($oldFileName){
        $this->oldFileName = $oldFileName;
    }
}