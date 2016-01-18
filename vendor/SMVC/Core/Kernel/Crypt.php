<?php

namespace SMVC\Core\Kernel;

class Crypt
{

    /**
     * Правила сдвигов порядковых символов
     * @var array
     */
    protected $shift = [
        4, 15, 3, 6, 11, 18, 14, 15, 17, 7, 4, 12
    ];

    /**
     * Допустимые знаки для пароля
     * @var array
     */
    protected $alphabet = [
        "e","d","u","g","c","K","Z","5","M",
        "R","v","T","I","l","j","D","1","t",
        "V","O","N","B","7","n","C","@","i",
        "_","E","p","4","6","h","m","0","S",
        "2","8","b","3","Y","k","x","!","o",
        "s","G","H","X","A","P","L","y","r",
        "f","F","a","J","w","9","z","W","q",
        "U","Q"
    ];

    public $crypted; //Шифрованный пароль

    public $decrypted; //Дешифрованный пароль

    public function __construct()
    {
    }

    /**
     * Метод шифрования пароля
     * @param $password
     * @return $this|bool
     */
    public function crypt($password)
    {
        if(empty($password))
            return false;
        $this->crypted = '';
        $this->decrypted = '';
        //Пробегаемся в цикле по паролю
        for($i = 0; $i < strlen($password); $i++)
        {
            //берем ключ из нашего алфавита текущего символа пароля и применяем сдвиг
            $pointer = array_search($password[$i], $this->alphabet) + $this->shift[$i];
            //Проверяем, что если сдвиг больше длины нашего справочника, то перемещаемся в начало алфавита
            $pointer = ((count($this->alphabet) - 1) < $pointer) ? $pointer - count($this->alphabet) : $pointer;
            $this->crypted .= $this->alphabet[$pointer];
        }
        return $this;
    }

    /**
     * Дешифровка пароля
     * @param $password
     * @return $this|bool
     */
    public function decrypt($password)
    {
        if(empty($password))
            return false;
        $this->crypted = '';
        $this->decrypted = '';
        for($i = 0; $i < strlen($password); $i++)
        {
            //Обратный алгоритм. Получаем ключ символа в справочнике
            $current = array_search($password[$i], $this->alphabet) - $this->shift[$i];
            //Если ключ меньше нуля, берем  разницу длины справочника и ключа по модулю.
            $pointer = $current < 0 ? count($this->alphabet) - abs($current) : $current;
            //Возвращаем расшифрованный символ
            $this->decrypted .= $this->alphabet[$pointer];
        }
        return $this;
    }
}