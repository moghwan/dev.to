# my_module/controllers/front/ajax.php

public function displayAjaxGetProductsByCategoryPhp()
{
  $categoryId = Tools::getValue('categoryId');

  $products = Product::getProducts($this->context->language->id, null, null, 'id_product', 'DESC', $categoryId);

  $this->context->smarty->assign(
      [
          'products'=>$products,
      ]
  );

  die(
      Tools::jsonEncode(
          [
              'ajaxTpl' => $this->context->smarty->fetch('module:your_module/views/templates/front/ajax/productslist.tpl')
          ]
      )
  );
}
