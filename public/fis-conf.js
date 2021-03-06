fis.config.set('pack', {
    'packages/lib.js': [
        '/static/library/jquery-1.11.1/jquery.js'
    ]
});

//静态资源域名，使用pure release命令时，添加--domains或-D参数即可生效
//fis.config.set('roadmap.domain', 'http://127.0.0.1:8080');

//如果要兼容低版本ie显示透明png图片，请使用pngquant作为图片压缩器，
//否则png图片透明部分在ie下会显示灰色背景
//使用spmx release命令时，添加--optimize或-o参数即可生效
//fis.config.set('settings.optimzier.png-compressor.type', 'pngquant');

//设置jshint插件要排除检查的文件，默认不检查lib、jquery、backbone、underscore等文件
//使用pure release命令时，添加--lint或-l参数即可生效
fis.config.set('settings.lint.jshint.ignored', [ 'static/library/**']);

//csssprite处理时图片之间的边距，默认是3px
fis.config.set('settings.spriter.csssprites.margin', 20);

//file : fis-conf.js
//开启autoCombine可以将零散资源进行自动打包
fis.config.set('settings.postpackager.simple.autoCombine', true);

//为所有样式资源开启csssprites
//fis.config.set('roadmap.path', [{
//    reg: '**.css',
//    useSprite: true
//}]);

//后缀名的less的文件使用fis-parser-less编译
//modules.parser.less表示设置后缀名为less的文件的parser，第二个less表示使用fis-parser-less进行编译
//fis.config.set('modules.parser.less', 'less');
//将less文件编译为css
//fis.config.set('roadmap.ext.less', 'css');