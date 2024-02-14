/*
 * jQuery isValid plugin
 *
 * Desenvolvido por Luiz Eduardo de Oliveira Fonseca
 *
 * @version 0.4 (08/04/2008)
 * @version 0.5 (15/06/2008)
 * @version 0.6 (20/10/2008)
 * @version 0.7 (28/12/2008)
 *
 * @name isValid
 * @type jQuery
 * @cat Plugins/Validation
 * @return Boolean
 * @author Luiz Eduardo de Oliveira Fonseca
 *
 * Visite http://www.designer404.com/isvalid/
 */


jQuery.fn.isRequired = function(){

    var hasError = Boolean(true);
    var checked_count = 0;

    switch ($(this).attr('type'))
    {
        case 'checkbox':
            checked_count = 0;
            $('input[name="' + $(this).attr('name') + '"]').each(function() {
                if ($(this).is(':checked')) {
                    checked_count++;
                }
            });
            if (checked_count < 1) {
                return Boolean(false);
            }
            break;
        case 'radio':
            checked_count = 0;
            $('input[name="' + $(this).attr('name') + '"]').each(function() {
                if ($(this).is(':checked')) {
                    checked_count++;
                }
            });
            if (checked_count != 1) {
                hasError = Boolean(false);
            }
            break;
        case 'text':
            if ($(this).val().length == 0)
                hasError = Boolean(false);
            break;

        default:
            if ($(this).val() == '') {
                hasError = Boolean(false);
            }
            break;
    }

    return hasError;

}

jQuery.fn.isInteger = function(){

    if ($(this).isRequired()){
        if (!/^[0-9]*$/.test($(this).val()))
        {
            return false;
        } else
        {
            return true;
        }
    } else
        {
            return false;
        }

}

jQuery.fn.isMoney = function(){

    if (!/^\d{1,3}(\.\d{3})*\,\d{2}$/.test($(this).val()))
    {
        return false;
    } else
    {
        return true;
    }
}

jQuery.fn.isFloat = function(){

    if (!/^(\+?((([0-9]+(\,)?)|([0-9]*\,[0-9]+))([eE][+-]?[0-9]+)?))$/.test($(this).val()))
    {
        return false;
    } else
    {
        return true;
    }

}

jQuery.fn.isDate = function(){

    if (!/^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/.test($(this).val()))
    {
        return false;
    } else
    {
        return true;
    }

}

jQuery.fn.isFormatCPF = function()
{
    if (!/^([0-9]{3}\.){2}[0-9]{3}-[0-9]{2}$/.test($(this).val()))
    {
        return false;
    } else
    {
        return true;
    }

}


jQuery.fn.isEmail = function(){

    if (!/^[a-zA-Z0-9]{1}([\._a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+){1,3}$/.test($(this).val()))
    {
        return false;
    } else
    {
        return true;
    }

}

// end unit