<?php

class BaseController extends Controller {

    /**
     * 消息对象
     * @var Illuminate\Support\MessageBag
     */
    protected $messages = null;

    /**
     * 初始化
     * @return void
     */
    public function __construct()
    {
        // CSRF 保护
        $this->beforeFilter('csrf', array('on' => 'post|put|delete'));
        // 实例化 消息对象
        $this->messages = new Illuminate\Support\MessageBag;
    }

    /**
     * 当负责响应的方法没有返回值，或返回值为 null 时，
     * 系统将判断 layout 属性是否为空，
     * 若不为空，则根据 layout 属性，返回一个视图响应。
     * @return void
     */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function saveModel(array $data, $model, array $rules, array $validatorMessages, $response = array()) {

        $validator = Validator::make($data, $rules, $validatorMessages);

        if ($validator->passes()) {

            $keys = array_keys($data);
            foreach($keys as $key) {
                $model->setAttribute($key, $data[$key]);
            }

            if ($model->save()) {
                $data["id"] = $model->id;
                $response["row"] = $data;
            } else {
                $response["error"] = "操作失败，请联系管理员";
            }
        } else {
            $failed = $validator->messages();
            $messages = $failed->getMessages();
            $keys = array_keys($messages);
            $fieldErrors = array();
            foreach ($keys as $key)
            {
                $error = array();
                $error["name"] = $key;
                $error["status"] = $messages[$key][0];
                array_push($fieldErrors,$error);
            }
            $response["fieldErrors"] = $fieldErrors;
        }

        return $response;
    }
}