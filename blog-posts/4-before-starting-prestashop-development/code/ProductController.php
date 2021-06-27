<?php
# controllers/front/ProductController.php
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
...

class ProductControllerCore extends ProductPresentingFrontControllerCore
{

  public function anyFunction()
  {
    // function shouldn't be private or it won't work

    return 'parent value';
  }

}
