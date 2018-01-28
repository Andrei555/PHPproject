<?php

namespace Model;

use Library\Cookie;

class Favorites
{
    /**
     * Products array
     *
     * @var array|mixed
     */
    private $products;
    /**
     *  Constructor
     */
    function __construct()
    {
        $this->products = Cookie::get('books') == null ? array() : json_decode(Cookie::get('books'));
    }
    /**
     * products getter
     *
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }
    /**
     * adding product
     *
     * @param $id
     */
    public function addProduct($id)
    {
        $id = (int)$id;

        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }

        Cookie::set('books', json_encode($this->products));
    }
    /**
     * deleting product
     *
     * @param $id
     */
    public function deleteProduct($id)
    {
        $id = (int)$id;

        $key = array_search($id, $this->products);

        if ($key !== false){
            unset($this->products[$key]);
        }

        Cookie::set('books', json_encode($this->products));
    }
    /**
     *  clear cart
     */
    public function clear()
    {
        Cookie::delete('books');
    }
    /**
     * check if empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->products;
    }

}