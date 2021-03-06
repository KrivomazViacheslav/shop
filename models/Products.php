<?php
class Products extends Database
{
    public function addProduct($product)
    {
        if(empty($product)) {
            return false;
        }

        foreach ($product as $column => $val) {
            $columns[] = $column;
            $values[]  = "'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $val_sql   = implode(',',$values);

        $query = "INSERT INTO products ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }

    public function getProduct($id)
    {
        if(empty($id)) {
            return false;
        }

        $query = "SELECT id, name, description, visible, image, url, created, updated FROM products WHERE id = $id LIMIT 1";
        $this->query($query);
        return $this->result();
    }

    public function getProducts()
    {
        $query = "SELECT id, name, description, visible, image, url, created, updated FROM products";
        $this->query($query);
        return $this->results();
    }

    public function updateProduct($id, $product)
    {
        if(empty($id)) {
            return false;
        }

        foreach ($product as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',', $columns);

        $query = "UPDATE products SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }
}