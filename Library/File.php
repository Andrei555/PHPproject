<?php

namespace Library;

class File
{
    private $suporttedFormats = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'application/pdf'];

    public function uploadFile($file){

        if(in_array($file['type'], $this->suporttedFormats)){
            move_uploaded_file($file['tmp_name'], '../webroot/books/' . $file['name']);
            return true;
        }else{
            return false;
        }
    }
}