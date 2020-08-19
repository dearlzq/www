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
        $grid->column('goods_id', __('商品ID'));
        $grid->column('cat_id', __('分类ID'));
        $grid->column('goods_sn', __('商品货号'));
        $grid->column('goods_name', __('商品名称'));
        $grid->column('goods_number', __('商品数量'));
        $grid->column('shop_price', __('商品价格'));
        $grid->column('keywords', __('商品关键字'));
//        $grid->column('goods_desc', __('Goods desc'));
        $grid->column('goods_img', __('商品图片'))->image();
        $grid->column('add_time', __('添加时间'));
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

        $form->select('cat_id',__('分类ID'))->options(CategoryModel::selectOptions());
        $form->text('goods_sn', __('商品货号'));
        $form->text('goods_name', __('商品名称'));
        $form->number('goods_number', __('商品数量'));
        $form->decimal('shop_price', __('商品价格'))->default(0.00);
        $form->text('keywords', __('商品关键字'));
        $form->textarea('goods_desc', __('商品介绍'));
        $form->image('goods_img', __('商品图片'));
        $form->text('is_new', __('是否新品'));
        $form->text('is_img', __('是否轮播图'));
        $form->text('is_show', __('是否推荐'));
        return $form;
    }
}
