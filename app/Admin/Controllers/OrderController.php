<?php

namespace App\Admin\Controllers;

use App\Model\OrderModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OrderModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderModel());

        $grid->column('rec_id', __('Rec id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_name', __('Goods name'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('product_id', __('Product id'));
        $grid->column('goods_number', __('Goods number'));
        $grid->column('market_price', __('Market price'));
        $grid->column('goods_price', __('Goods price'));
        $grid->column('goods_attr', __('Goods attr'));
        $grid->column('send_number', __('Send number'));
        $grid->column('is_real', __('Is real'));
        $grid->column('extension_code', __('Extension code'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('is_gift', __('Is gift'));
        $grid->column('goods_attr_id', __('Goods attr id'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(OrderModel::findOrFail($id));

        $show->field('rec_id', __('Rec id'));
        $show->field('order_id', __('Order id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('product_id', __('Product id'));
        $show->field('goods_number', __('Goods number'));
        $show->field('market_price', __('Market price'));
        $show->field('goods_price', __('Goods price'));
        $show->field('goods_attr', __('Goods attr'));
        $show->field('send_number', __('Send number'));
        $show->field('is_real', __('Is real'));
        $show->field('extension_code', __('Extension code'));
        $show->field('parent_id', __('Parent id'));
        $show->field('is_gift', __('Is gift'));
        $show->field('goods_attr_id', __('Goods attr id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderModel());

        $form->number('order_id', __('Order id'));
        $form->number('goods_id', __('Goods id'));
        $form->text('goods_name', __('Goods name'));
        $form->text('goods_sn', __('Goods sn'));
        $form->number('product_id', __('Product id'));
        $form->number('goods_number', __('Goods number'))->default(1);
        $form->decimal('market_price', __('Market price'))->default(0.00);
        $form->decimal('goods_price', __('Goods price'))->default(0.00);
        $form->textarea('goods_attr', __('Goods attr'));
        $form->number('send_number', __('Send number'));
        $form->switch('is_real', __('Is real'));
        $form->text('extension_code', __('Extension code'));
        $form->number('parent_id', __('Parent id'));
        $form->number('is_gift', __('Is gift'));
        $form->text('goods_attr_id', __('Goods attr id'));

        return $form;
    }
}
