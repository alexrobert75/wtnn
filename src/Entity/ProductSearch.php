<?php

namespace App\Entity;

class ProductSearch {

    private $category;

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($cat) {
        $this->category = $cat;
        return $this;
    }
     
}






?>