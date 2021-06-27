// preparing the ajax call inside a function
function getProductsByCategoryJs(categoryId) {
  $.ajax({
      url : AJAX_URL,
      type : 'POST',
      async: true,
      dataType : "json",
      data: {
          action: 'getProductsByCategoryPhp',
          categoryId: categoryId,
          ajax: 1
      },
      success : function (response) {
          console.log(response);
          $('#your-element').html(response.ajaxTpl);
      },
      error : function (error) {
          console.log(error);
      },
  });
}
