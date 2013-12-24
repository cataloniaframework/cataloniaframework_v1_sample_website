<?php
/**
 * User:        Carles Mateo
 * Date:        2013-02-13
 * Time:        21:12
 * Filename:    production.php
 * Description:
 */

use CataloniaFramework\Db as Db;

$st_server_config = array(  'environment' 	=> ENVIRONMENT,
							'web' 			=> array(   'http'  => 'http://www.cataloniaframework.com/',
														'http_enabled'	=> true,
														'https' => 'https://www.cataloniaframework.com/',
														'https_enabled' => false),
							'cdn' 			=> array(   'images' => array(	'http'  => 'http://images.cataloniaframework.com/',
																			'https' => 'https://images.cataloniaframework.com/'),
														'videos' => array(	'http'  => 'http://video.cataloniaframework.com/',
																			'https' => 'https://video.cataloniaframework.com/')
													),
							'storage'		=> array(	'web_root'          => '/www/www.cataloniaframework.com/cataloniaweb/www/',
                                                        'catfw_root'        => '/www/www.cataloniaframework.com/cataloniaweb/',
                                                        'classes_root'      => '/www/www.cataloniaframework.com/cataloniaweb/classes/',
                                                        'cache'             => '/www/www.cataloniaframework.com/cataloniaweb/cache/',
												 		'tmp'               => '/tmp/',
												 		'logs'              => '/var/logs/www/'
												 	)
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

// For Production report 0
error_reporting(0);
