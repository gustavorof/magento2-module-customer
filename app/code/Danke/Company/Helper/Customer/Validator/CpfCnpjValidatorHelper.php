<?php
/**
 * @author      Gustavo Rodrigues Francisco <gustavor.francisco@gmail.com>
 * @copyright   2019 Gustavo Rodrigues Francisco (http://www.gustavofrancisco.com.br)
 * @license     http://www.gustavofrancisco.com.br  Copyright
 *
 * @link        http://www.gustavofrancisco.com.br
 */
namespace Danke\Company\Helper\Customer\Validator;


class CpfCnpjValidatorHelper
{

    public function isValidCnpj($taxvat)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string)$taxvat);

        if (strlen($cnpj) != 14) {
            return false;
        }

        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj{12} != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        return $cnpj{13} == ($rest < 2 ? 0 : 11 - $rest);
    }

    public function isValidCpf($taxvat)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string)$taxvat);

        if (strlen($cpf) != 11) {
            return false;
        }

        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $cpf{$i} * $j;
        }
        $rest = $sum % 11;
        if ($cpf{9} != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $cpf{$i} * $j;
        }
        $rest = $sum % 11;
        return $cpf{10} == ($rest < 2 ? 0 : 11 - $rest);
    }

}