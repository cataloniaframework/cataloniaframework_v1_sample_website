<?php
/**
 * User:        Carles Mateo
 * Date:        2013-02-07
 * Time:        21:11
 * Filename:    development.php
 * Description:
 */

use CataloniaFramework\Db as Db;

$st_server_config = array(  'environment' 	=> ENVIRONMENT,
							'web' 			=> array(   'http'  => 'http://develwww.cataloniafw.com/',
														'http_enabled'	=> true,
														'https' => 'https://develwww.cataloniafw.com/',
														'https_enabled' => false),
							'cdn' 			=> array(   'images' => array(	'http'  => 'http://images.cataloniafw.com/',
																			'https' => 'https://images.cataloniafw.com/'),
														'videos' => array(	'http'  => 'http://video.cataloniafw.com/',
																			'https' => 'https://video.cataloniafw.com/')
													),
							'storage'		=> array(	'web_root'          => '/home/carles/Escriptori/codi/cataloniaweb/www/',
                                                        'catfw_root'        => '/home/carles/Escriptori/codi/cataloniaweb/',
                                                        'classes_root'      => '/home/carles/Escriptori/codi/cataloniaweb/classes/',
                                                        'cache'             => '/home/carles/Escriptori/codi/cataloniaweb/cache/',
												 		'tmp'               => '/tmp/',
												 		'logs'              => '/var/logs/www/'
												 	),
                            'node'          => array(   'name'              => 'WEB01',
                                                        'setcookie'         => true,
                                                        'ttl_cookie'        => 0,
                                                        'cookie_name'       => 'BALANCER_ID',
                                                        'cookie_value'      => 'WEB01')
						  );

// Languages Supported
$p_st_languages = array ( 'ca' => array('default'   => true,
                                        'active'    => true,
                                        'http_img_flag' =>  'img/flag_ca.png',
                                        'browser_detection' => array(   0 => 'ca',
                                                                        1 => 'ca_es',
                                                                        2 => 'ca_ca',
                                                                        3 => 'ca_en')
                                        ),
                          'en' => array('default'   => true,
                                        'active'    => true,
                                        'http_img_flag' =>  'img/flag_en.png',
                                        'browser_detection' => array(   0 => 'en',
                                                                        1 => 'en_en',
                                                                        2 => 'en_us',
                                                                        3 => 'en_uk')
                                       ),
                        );

define('LANGUAGE_DEFAULT', 'en');


// If we log SQL Inserts to FILE. Normally for Debug.
define('LOG_SQL_TO_FILE',false);
define('LOG_HTTP_REQUESTS_TO_FILE', false);

// Reports everything. This is like E_ALL | E_STRICT. Note: From PHP 5.4 E_STRICT is part of E_ALL
// But with -1 PHP's future versions new errors are granted.
error_reporting(-1);
