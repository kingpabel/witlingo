<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Accept;
use App\Models\Category;
use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('body', __('Body'));
        $grid->column('status', __('Status'));
        $grid->column('category.name', __('Category'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function ($filter) {
            $filter->equal('category_id', 'Category')->select(Category::all()->pluck('name', 'id'));
        });
        $grid->actions(function ($actions) {
            $actions->add(new Accept);
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('body', __('Body'));
        $show->field('status', __('Status'));
        $show->field('category.name', __('Category'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->text('name', __('Name'));
        $form->textarea('body', __('Body'));
        $form->text('status', __('Status'))->default('pending');
        $form->select('category_id', 'Category')->options(Category::all()->pluck('name', 'id'));

        return $form;
    }
}
