<?php

return [
    'adminEmail' => 'admin@example.com',
    'uploadPath' => '/uploads/',//后台上传文件保存路径
    'saveMode' => 'seesion',//系统信息保存方式，比如登录数据 seesion radis file 3中保存方式
    'pageSize' => 10,//每页显示10条
    'imgSize' => [
        'mini_img' => 70, //MINI图
        'thumb_img' => 300, //缩略图
        'big_img' => 750 //大图
    ],//上传的图片尺寸
];
