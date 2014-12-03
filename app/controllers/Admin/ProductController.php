<?php
/**
 * Created by PhpStorm.
 * User: guojinlong
 * Date: 14/10/27
 * Time: 下午9:28
 */

class AdminProductController extends BaseController{
    protected $resourceView = 'admin.products';

    protected $model = 'Product';

    protected $resource = 'products';

    protected $resourceTable = 'products';

    protected $resourceName = '导购商品';

    public function __construct()
    {
        parent::__construct();
        // 实例化资源模型
        $this->model  = App::make($this->model);
    }

    public function index(){
        $resource     = $this->resource.'.index';
        $resourceName = '商品管理';
        $resourceDesc = '';
        return View::make($this->resourceView.'.index')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function getProductCategory(){
        $resource     = $this->resource.'.category';
        $resourceName = '商品分类管理';
        $resourceDesc = '';
        return View::make($this->resourceView.'.category')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function dataTables(){
        return Datatable::collection(Product::all())
            ->showColumns("id", "name", "identifier","category","import","source_area","brand","price","desc","created_at")
            ->addColumn('products_category',function($model){
                return Category::where('parent_code', 'PRODUCT_CATEGORY')->where('code', $model->category)->select('name as label', 'code as value')->first();
            })
            ->addSelect('products_category', function(){
                return Category::where('parent_code', 'PRODUCT_CATEGORY')->select('name as label', 'code as value')->get();
            })
            ->searchColumns(array('name'))
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }

    public function store(){
        $post = Input::all();

        $response = array();

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $model = $this->model;
                $response = $this->saveModel($data, $model, Product::$rules, Product::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $model = $this->model->find($post["id"]);
                $response = $this->saveModel($data, $model, Product::$rules, Product::$validatorMessages);
                break;
            case "remove":
                $ids = $post["id"];
                foreach($ids as $id) {
                    $data = $this->model->find($id);
                    $data->delete();
                }
                break;
        }
        return Response::json($response);
    }

    public function getProductCategoryStore() {
        $post = Input::all();

        $response = array();
        $model = App::make("Category");

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $data["parent_code"] = "PRODUCT_CATEGORY";
                $data["level"] = "2";
                $response = $this->saveModel($data, $model, Category::$rules, Category::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $data["parent_code"] = "PRODUCT_CATEGORY";
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

    public function getProductCategoryDataTables() {
        $levels = Category::where('parent_code', 'PRODUCT_CATEGORY')->get();
        return Datatable::collection($levels)
            ->showColumns("id", "code", "parent_code", "name", "add1", "desc", "created_at")
            ->searchColumns('name')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }
} 