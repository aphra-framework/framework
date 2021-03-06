<?php

/**
 * KNUT7 K7F (https://marciozebedeu.com/)
 * KNUT7 K7F (tm) : Rapid Development Framework (https://marciozebedeu.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      https://github.com/knut7/framework/ for the canonical source repository
 * @copyright (c) 2015.  KNUT7  Software Technologies AO Inc. (https://marciozebedeu.com/)
 * @license   https://marciozebedeu.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.2
 */

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 08/12/16
 * Time: 14:19
 */

namespace Ballybran\Core\Variablesssss;

use ArrayObject;

class Variable extends ArrayObject
{

    private $___class = null;

    public function __construct(array $variables = array())
    {
        parent::__construct(
            $variables, ArrayObject::ARRAY_AS_PROPS, 'ArrayIterator'
        );
//        $this->importObj($user, $variables);
    }

    public function __get($key)
    {
        return $this[$key];
    }

    public function __set($key, $value)
    {
        $this[$key] = $value;
    }

    public function __call($key, $args)
    {
        if (is_object($this->___class) && is_callable([$this->___class, $key])) {
            return call_user_func_array([$this->___class, $key], $args);
        }
        return is_callable($c = $this->__get($key)) ? call_user_func_array($c, $args) : null;
    }

    public function importObj($class = null, $array = [])
    {
        $this->___class = $class;
        if (count($array) > 0) {
            $this->import($array);
        }
        return $this;
    }

    public function import($input)
    {
        $this->exchangeArray($input);
        return $this;
    }

    public function export()
    {
        return $this->objectToArray($this->getArrayCopy());
    }

    public function objectToArray($object)
    {
        $o = [];
        foreach ($object as $key => $value) {
            $o[$key] = is_object($value) ? (array)$value : $value;
        }
        return $o;
    }

}
