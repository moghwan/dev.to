<?php
# overrides/controllers/front/ProductController.php

class ProductController extends ProductControllerCore
{

  public function anyFunction()
  {
    // use parent::anyFunction() to get parent class value

    return 'new value';
  }
}
