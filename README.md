hyperf-http-server服务

1、ORM添加remember缓存机制
    $this->model()->where(['id' => $id])->remember(10)->first();
    $this->model()->where(['id' => $id])->remember(10)->get();