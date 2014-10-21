<?php

class FoodController extends BaseController
{
    protected $resourceView = 'admin.foods';

    protected $model = 'Food';

    protected $resource = 'foods';

    protected $resourceTable = 'foods';

    protected $resourceName = '食材百科';

    public function getFoodCategory()
    {
        $resource     = $this->resource.'.category';
        $resourceName = '食材分类管理';
        $resourceDesc = '';
        return View::make($this->resourceView.'.category')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function getFoodCategoryStore() {
        $post = Input::all();

        $response = array();
        $model = App::make("Category");

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $data["parent_code"] = "FOOD_CATEGORY";
                $data["level"] = "2";
                $response = $this->saveModel($data, $model, Category::$rules, Category::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $data["parent_code"] = "FOOD_CATEGORY";
                $data["level"] = "2";
                $model = $model->find($post["id"]);
                $response = $this->saveModel($data, $model, Category::$rules, Category::$validatorMessages);
                break;
            case "remove":
                $ids = $post["id"];
                foreach($ids as $id) {
                    $data = $model->find($id);
                    $data->delete();
                }
                break;
        }
        return Response::json($response);
    }

    public function getFoodCategoryDataTables() {
        $levels = Category::where('parent_code', 'FOOD_CATEGORY')->get();
        return Datatable::collection($levels)
            ->showColumns("id", "code", "parent_code", "name", "add1", "desc", "created_at")
            ->searchColumns('name')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }

    public function getFoodArea()
    {
        $resource     = $this->resource.'.area';
        $resourceName = '食材产地管理';
        $resourceDesc = '';
        return View::make($this->resourceView.'.area')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function getFoodAreaStore() {
        $post = Input::all();

        $response = array();
        $model = App::make("Category");

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $data["parent_code"] = "FOOD_AREA";
                $data["level"] = "2";
                $response = $this->saveModel($data, $model, Category::$rules, Category::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $data["parent_code"] = "FOOD_AREA";
                $data["level"] = "2";
                $model = $model->find($post["id"]);
                $response = $this->saveModel($data, $model, Category::$rules, Category::$validatorMessages);
                break;
            case "remove":
                $ids = $post["id"];
                foreach($ids as $id) {
                    $data = $model->find($id);
                    $data->delete();
                }
                break;
        }
        return Response::json($response);
    }

    public function getFoodAreaDataTables() {
        $levels = Category::where('parent_code', 'FOOD_AREA')->get();
        return Datatable::collection($levels)
            ->showColumns("id", "code", "parent_code", "name", "add1", "desc", "created_at")
            ->searchColumns('name')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }
}
