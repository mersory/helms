<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

define('YES', 0);

return [
    // +----------------------------------------------------------------------
    // | 
    // +----------------------------------------------------------------------

    // Ӧ�������ռ�
    'app_namespace'          => 'app',
    // Ӧ�õ���ģʽ
    'app_debug'              => true,
    // Ӧ��Trace
    'app_trace'              => true,
    // Ӧ��ģʽ״̬
    'app_status'             => '',
    // �Ƿ�֧�ֶ�ģ��
    'app_multi_module'       => true,
    // ����Զ���ģ��
    'auto_bind_module'       => false,
    // ע��ĸ������ռ�
    'root_namespace'         => [],
    // ��չ�����ļ�
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // Ĭ���������
    'default_return_type'    => 'html',
    // Ĭ��AJAX ���ݷ��ظ�ʽ,��ѡjson xml ...
    'default_ajax_return'    => 'json',
    // Ĭ��JSONP��ʽ���صĴ�����
    'default_jsonp_handler'  => 'jsonpReturn',
    // Ĭ��JSONP������
    'var_jsonp_handler'      => 'callback',
    // Ĭ��ʱ��
    'default_timezone'       => 'PRC',
    // �Ƿ���������
    'lang_switch_on'         => false,
    // Ĭ��ȫ�ֹ��˷��� �ö��ŷָ����
    'default_filter'         => '',
    // Ĭ������
    'default_lang'           => 'zh-cn',
    // Ӧ������׺
    'class_suffix'           => false,
    // ���������׺
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | ģ������
    // +----------------------------------------------------------------------

    // Ĭ��ģ����
    'default_module'         => 'login',
    // ��ֹ����ģ��
    'deny_module_list'       => ['common'],
    // Ĭ�Ͽ�������
    'default_controller'     => 'login',
    // Ĭ�ϲ�����
    'default_action'         => 'index',
    // Ĭ����֤��
    'default_validate'       => '',
    // Ĭ�ϵĿտ�������
    'empty_controller'       => 'Error',
    // ����������׺
    'action_suffix'          => '',
    // �Զ�����������
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL����
    // +----------------------------------------------------------------------

    // PATHINFO������ ���ڼ���ģʽ
    'var_pathinfo'           => 's',
    // ����PATH_INFO��ȡ
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo�ָ���
    'pathinfo_depr'          => '/',
    // URLα��̬��׺
    'url_html_suffix'        => 'html',
    // URL��ͨ��ʽ���� �����Զ�����
    'url_common_param'       => false,
    // URL������ʽ 0 �����ƳɶԽ��� 1 ��˳�����
    'url_param_type'         => 0,
    // �Ƿ���·��
    'url_route_on'           => true,
    // ·��ʹ������ƥ��
    'route_complete_match'   => false,
    // ·�������ļ���֧�����ö����
    'route_config_file'      => ['route'],
    
    'URL_CASE_INSENSITIVE' =>true,
    
    'url_controller_convert' => false,
    // 关闭操作名的自动转换'
    'url_action_convert' => false,
    
    'url_route_must'=> false,
    
    'URL_MODEL'=>'2',
    
    'url_route_rules'=>array(
        'member/list'=>'Adminopt/UserList',
    ),
    
    // ��������
    'url_domain_deploy'      => false,
    // ����������thinkphp.cn
    'url_domain_root'        => '',
    // �Ƿ��Զ�ת��URL�еĿ������Ͳ�����
    'url_convert'            => false,
    // Ĭ�ϵķ��ʿ�������
    'url_controller_layer'   => 'controller',
    // ����������αװ����
    'var_method'             => '_method',
    // ��ajaxαװ����
    'var_ajax'               => '_ajax',
    // ��pjaxαװ����
    'var_pjax'               => '_pjax',
    // �Ƿ������󻺴� true�Զ����� ֧���������󻺴����
    'request_cache'          => false,
    // ���󻺴���Ч��
    'request_cache_expire'   => null,
    // ȫ�����󻺴��ų�����
    'request_cache_except'   => [],

    // +----------------------------------------------------------------------
    // | ģ������
    // +----------------------------------------------------------------------

    'template'               => [
        // 
        'type'         => 'Think',
        // 
        'view_path'    => '',
        // 
        'view_suffix'  => 'html',
        // 
        'view_depr'    => DS,
        // 
        'tpl_begin'    => '{',
        // 
        'tpl_end'      => '}',
        // 
        'taglib_begin' => '{',
        // 
        'taglib_end'   => '}',
        
    ],

    // ��ͼ����ַ��������滻
    'view_replace_str'       => [
        '_CSS_' => '/public/static/assets/css',
        '_JS_' => '/public/static/assets/js',
        '_IMG_' => '/public/static/assets/images',
    ],
    // Ĭ����תҳ���Ӧ��ģ���ļ�
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | �쳣����������
    // +----------------------------------------------------------------------

    // �쳣ҳ���ģ���ļ�
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // ������ʾ��Ϣ,�ǵ���ģʽ��Ч
    'error_message'          => 'ҳ��������Ժ����ԡ�',
    // ��ʾ������Ϣ
    'show_error_msg'         => false,
    // �쳣����handle�� ����ʹ�� \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | ��־����
    // +----------------------------------------------------------------------

    'log'                    => [
        // ��־��¼��ʽ������ file socket ֧����չ
        'type'  => 'File',
        // ��־����Ŀ¼
        'path'  => LOG_PATH,
        // ��־��¼����
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace���� ���� app_trace �� ��Ч
    // +----------------------------------------------------------------------
    'trace'                  => [
        // ����Html Console ֧����չ
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | ��������
    // +----------------------------------------------------------------------

    'cache'                  => [
        // ������ʽ
        'type'   => 'File',
        // ���汣��Ŀ¼
        'path'   => CACHE_PATH,
        // ����ǰ׺
        'prefix' => '',
        // ������Ч�� 0��ʾ���û���
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | �Ự����
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID���ύ����,���flash�ϴ�����
        'var_session_id' => '',
        // SESSION ǰ׺
        'prefix'         => 'think',
        // ������ʽ ֧��redis memcache memcached
        'type'           => '',
        // �Ƿ��Զ����� SESSION
        'auto_start'     => true,
        'path'           =>TEMP_PATH,
        'expire'         => 1800,
    ],

    // +----------------------------------------------------------------------
    // | Cookie����
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie ����ǰ׺
        'prefix'    => '',
        // cookie ����ʱ��
        'expire'    => 0,
        // cookie ����·��
        'path'      => '/',
        // cookie ��Ч����
        'domain'    => '',
        //  cookie ���ð�ȫ����
        'secure'    => false,
        // httponly����
        'httponly'  => '',
        // �Ƿ�ʹ�� setcookie
        'setcookie' => true,
    ],

    //��ҳ����
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    'upload_path' => '/opt/apps/helms/public/static/assets/images/resources',
];
