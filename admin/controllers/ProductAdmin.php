<?php
class ProductAdmin extends CoreAdmin
{
    public function fetch()
    {
        $product = new stdClass();
        $product->visible = 0;
        $products = new Products();
        $request = new Request();

        if($request->method() == 'POST') {
            $product->name = $request->post('name');
            $product->description = $request->post('description');
            $product->visible = $request->post('visible');
            $product->image = $request->post('image');
            if(empty($request->post('url'))) {
                $product->url = CoreAdmin::translit($request->post('name'));
            } else {
                $product->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                $id = $products->updateProduct($request->post('id','integer'),$product);

            } else {
                //Добавление товара
                $id = $products->addProduct($product);
            }

            $product = $products->getProduct($id);
        }

        if ($product->visible) {
            $visibleChecked = ' checked';
        } else {
            $visibleChecked = '';
        }

        $array_vars = array(
            'product' => $product,
            'visibleChecked' => $visibleChecked,
        );

        return $this->view->render('product.html',$array_vars);
    }
}