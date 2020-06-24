//Скрипт отменяет отпраку формы по нажатию кнопки энтер

$(document).ready(function() {
    $("input[type=text]").keydown(function(event){
      if(event.keyCode == 13){
        event.preventDefault();
          return false;
          }
      });
 });