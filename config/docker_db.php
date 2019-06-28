<?php
/**
 * User:        Carles Mateo
 * Date:        2013-02-07
 * Time:        21:11
 * Filename:    docker_db.php
 * Description:
 */

use CataloniaFramework\Db as Db;

$st_server_config['database'] = Array(	'read'  => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_DUMMY,
                                                                                            'connection_method' => '',
                                                                                            'server_hostname'   => '',
                                                                                            'server_port'       => '',
                                                                                            'username'			=> '',
                                                                                            'password'			=> '',
                                                                                            'database'			=> '',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )
                                                        ),
                                        'write' => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_DUMMY,
                                                                                            'connection_method' => '',
                                                                                            'server_hostname'   => '',
                                                                                            'server_port'       => '',
                                                                                            'username'			=> '',
                                                                                            'password'			=> '',
                                                                                            'database'			=> '',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )

                                                        )


                                    );
