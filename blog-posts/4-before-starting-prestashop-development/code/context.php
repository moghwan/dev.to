// returns the id of the current used language.
$this->context->language->id;

// assign variables from current controller to the view
$this->context->smarty->assign([
  'categories' => $categories,
]);

// the view
return $this->display(__FILE__, 'views/templates/admin/someadminhook.tpl');

// fetching the rendered content of a view,
$this->context->smarty->fetch('module:your_module_dir_name/views/templates/front/display.tpl')

// get current cart
$this->context->cart;
