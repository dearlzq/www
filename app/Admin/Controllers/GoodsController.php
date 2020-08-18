<?php

namespace App\Admin\Controllers;

use App\Model\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Model\CategoryModel;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GoodsModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel());
        $grid->model()->orderBy('goods_id','desc');
        $grid->column('goods_id', __('Goods id'));
        $grid->column('cat_id', __('Cat id'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('goods_name', __('Goods name'));
        $grid->column('click_count', __('Click count'));
        $grid->column('goods_number', __('Goods number'));
        $grid->column('shop_price', __('Shop price'));
        $grid->column('keywords', __('Keywords'));
//        $grid->column('goods_desc', __('Goods desc'));
        $grid->column('goods_img', __('Goods img'))->image();
        $grid->column('add_time', __('Add time'));
        $grid->column('is_delete', __('Is delete'));
        $grid->column('sale_num', __('Sale num'));
        $grid->column('is_new', '是否新品')->display(function ($released) {
            return $released ? '是' : '否';
        });
        $grid->column('is_img', '是否轮播图')->display(function ($released) {
            return $released ? '是' : '否';
        });
        $grid->column('is_show', '是否推荐')->display(function ($released) {
            return $released ? '是' : '否';
        });
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
        $show = new Show(GoodsModel::findOrFail($id));

        $show->field('goods_id', __('Goods id'));
        $show->field('cat_id', __('Cat id'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('goods_name', __('Goods name'));
        $show->field('click_count', __('Click count'));
        $show->field('goods_number', __('Goods number'));
        $show->field('shop_price', __('Shop price'));
        $show->field('keywords', __('Keywords'));
        $show->field('goods_desc', __('Goods desc'));
        $show->field('goods_img', __('Goods img'));
        $show->field('add_time', __('Add time'));
        $show->field('is_delete', __('Is delete'));
        $show->field('sale_num', __('Sale num'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel());

        $form->select('cat_id',__('cart id'))->options(CategoryModel::selectOptions());
        $form->text('goods_sn', __('Goods sn'));
        $form->text('goods_name', __('Goods name'));
        $form->number('click_count', __('Click count'));
        $form->number('goods_number', __('Goods number'));
        $form->decimal('shop_price', __('Shop price'))->default(0.00);
        $form->text('keywords', __('Keywords'));
        $form->textarea('goods_desc', __('Goods desc'));
        $form->image('goods_img', __('Goods img'));
        $form->switch('is_delete', __('Is delete'));
        $form->number('sale_num', __('Sale num'));
        $form->text('is_new', __('Is new'));
        $form->text('is_img', __('Is img'));
        $form->text('is_show', __('Is show'));
        return $form;
    }
}
