<?php 
namespace App\Controllers;

class TemplateController {
    
    public function template1(){
        render('templates/sample1');
    }
    public function template2()
    {
        render('templates/sample2');
    }
}