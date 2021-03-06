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

namespace Ballybran\Database\Drives;

use Ballybran\Database\Drives\iDatabase;
use PDO;

abstract class Postgroul implements AbstractDatabaseInterface
{

    public function __construct()
    {

    }

    /**
     * @param $sql
     * @param array $array
     * @param int $fetchMode
     * @return mixed
     */
    public function selectManager($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        // TODO: Implement selectManager() method.
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($table, $fields = "*", $where = ' ', $order = '', $limit = null, $offset = null, $array = array(), $fetchMode)
    {
        // TODO: Implement select() method.
    }

    /**
     * @param $table da base de dados
     * @param $data recebido do array
     * @return bool
     */
    public function insert($table, array $data)
    {
        // TODO: Implement insert() method.
    }

    /**
     * @param $table
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($table, $data, $where)
    {
        // TODO: Implement update() method.
    }

    public function delete($table, $where, $limit)
    {
        // TODO: Implement delete() method.
    }

    public function get_Data_definition($db)
    {
        // TODO: Implement get_Data_definitin() method.
    }

    public function createTable(String $table, array $fileds)
    {
        // TODO: Implement createTable() method.
    }
}
