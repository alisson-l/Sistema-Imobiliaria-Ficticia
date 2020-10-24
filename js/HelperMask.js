$(function(){
    $('[name=CPF]').mask('999.999.999-99');
    $('[name=CNPJ]').mask('99.999.999/9999-99');

    $('[name=tipo_cliente]').change(function(){
        var val = $(this).val();
        if(val == 'fisico'){
            $('[name=CPF]').parent().show();
            $('[name=CNPJ').parent().hide();
        }else{
            $('[name=CPF]').parent().hide();
            $('[name=CNPJ').parent().show();
        }
    })
})