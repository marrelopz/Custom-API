<?php

/**
 * 
 *  Created By Maria Lopez marrelopz@gmail.com
 */

/**
 * Rutas publicas
 */
define( 'FACILITO_REST', 'facilito' );
/**
 * Rutas con autenticacion
 */
define('FACILITO_REST_AUTH','facilito/auth');

/**
 * Registra los enpoints en nuestra api personalizada
 */
function prp_register_rest_endpoints(){
    /****<<RUTAS PRIVADAS>>****/
      /**
     * Obtener Informacion de usuario
     * GET wp-json/facilito/auth/cuenta
     */
    register_rest_route( FACILITO_REST_AUTH , 'cuenta', [
        'methods'               => 'GET',
        'callback'              => 'wp_get_accountInfo',
       'permission_callback'   => 'wp_rest_jwt_auth_check',
    ]); 
     /**
     * Obtener listas del usuario
     * GET wp-json/facilito/lista
     */
    register_rest_route( FACILITO_REST , 'lista', [
        'methods'               => 'GET',
        'callback'              => 'wp_get_listas',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);
     /**
     * Obtener lista especifica
     * GET wp-json/facilito/lista/<id>
     */
    register_rest_route( FACILITO_REST , 'lista/(?P<id>\d+)', [
        'methods'               => 'GET',
        'callback'              => 'wp_get_lista',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);
     /**
     * crear lista del usuario
     * POST wp-json/facilito/lista
     */
    register_rest_route( FACILITO_REST , 'lista', [
        'methods'               => 'POST',
        'callback'              => 'wp_set_lista',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]); 
     /**
     * editar lista del usuario
     * PUT wp-json/facilito/lista
     */
    register_rest_route( FACILITO_REST , 'lista/(?P<id>\d+)', [
        'methods'               => 'PUT',
        'callback'              => 'wp_edit_lista',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);  
     /**
     * eliminar lista del usuario
     * DELETE wp-json/facilito/lista
     */
    register_rest_route( FACILITO_REST , 'lista/(?P<id>\d+)', [
        'methods'               => 'DELETE',
        'callback'              => 'wp_delete_lista',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);  
    
     /**
     * Obtener carrito de compras
     * GET wp-json/facilito/auth/cart
     */
    register_rest_route( FACILITO_REST , 'cart', [
        'methods'               => 'GET',
        'callback'              => 'wp_get_cart',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);
     /**
     * Limpiar carrito de compras
     * GET wp-json/facilito/auth/cart/clear
     */    
    register_rest_route( FACILITO_REST , 'cart/clear', [
        'methods'               => 'GET',
        'callback'              => 'wp_get_cart',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);    
     /**
     * agregar productoc al carrito de compras
     * GET wp-json/facilito/auth/cart/add
     */    
    register_rest_route( FACILITO_REST , 'cart/add', [
        'methods'               => 'GET',
        'callback'              => 'wp_add_cart',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]);
     /**
     * actualiza el carrito de compras
     * PUT wp-json/facilito/auth/cart
     */    
    register_rest_route( FACILITO_REST , 'cart/(?P<id>\d+)', [
        'methods'               => 'PUT',
        'callback'              => 'wp_edit_cart',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]); 
     /**
     * elimina producto
     * PUT wp-json/facilito/auth/cart
     */    
    register_rest_route( FACILITO_REST , 'cart/(?P<id>\d+)', [
        'methods'               => 'DELETE',
        'callback'              => 'wp_delete_cart_product',
        'permission_callback'   => 'wp_rest_jwt_auth_check'
    ]); 
    /****<<RUTAS PUBLICAS>>****/
    /**
    * Creacion nuevo usuario
    * POST wp-json/facilito/user
    */
    register_rest_route( FACILITO_REST , 'user', [
        'methods'               => 'POST',
        'callback'              => 'wp_new_user',
    ]);    
}

require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'auth.php';
require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'facilito_functions.php';

