<?php
/**
 * Created by PhpStorm.
 * User: KozminVA
 * Date: 06.12.2016
 * Time: 15:39
 */

namespace app\components;

use yii;

class Imagefile {

    public $filename = null;
    public $origFilename = null;

    public $validator = null;

    public $nameGenerator = null;

    public $errors = [];


    function __construct($filename, $origFilename, callable $validator, callable $nameGenerator) {
//        Yii::info('validator = ' . print_r($validator, true));
        $this->filename = $filename;
        $this->origFilename = $origFilename;

        $this->validator = $validator;
//        Yii::info('this->validator = ' . print_r($this->validator, true));
        $this->nameGenerator = $nameGenerator;
    }

    public function validate() {
//        Yii::info('this->validator = ' . print_r($this->validator, true));
        $this->errors = call_user_func($this->validator, $this->filename);
        return !$this->hasErrors();
    }

    public function hasErrors() {
        return (count($this->errors) > 0);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function save() {
        if( $this->validate() ) {
            $sfDest = call_user_func($this->nameGenerator, $this->origFilename);
            $this->createDir(dirname($sfDest));
            copy($this->filename, $sfDest);
            return true;
        }
        return false;
    }

    public function createDir($sDir) {
        if( !is_dir(dirname($sDir)) ) {
            $this->createDir(dirname($sDir));
        }

        if( !is_dir($sDir) ) {
            mkdir($sDir, 0777);
        }
    }


}