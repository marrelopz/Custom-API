<?php
/**
 * Validar que el request venga de un usuario loggeado 
 * 
 * @return WP_Error|true        WP_Error: si el usuario no tiene sesion 
 * 
 * @author Maria Lopez <marrelopz@gmail.com>
 * 
 */

    /**
     * Main validation function, this function try to get the Autentication
     * headers and decoded.
     *
     * @param bool $output
     *
     * @return WP_Error | Object | Array
     */
 function wp_rest_jwt_auth_check($output = true)
    {
        /*
         * Looking for the HTTP_AUTHORIZATION header, if not present just
         * return the user.
         */
        $auth = isset($_SERVER['HTTP_AUTHORIZATION']) ?  $_SERVER['HTTP_AUTHORIZATION'] : false;


        /* Double check for different auth header string (server dependent) */
        if (!$auth) {
            $auth = isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ?  $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] : false;
        }

        if (!$auth) {
            return new WP_Error(
                'jwt_auth_no_auth_header',
                __('Authorization header not found.', 'wp-api-jwt-auth'),
                array(
                    'status' => 403,
                )
            );
        }

        /*
         * The HTTP_AUTHORIZATION is present verify the format
         * if the format is wrong return the user.
         */
        list($token) = sscanf($auth, 'Bearer %s');
        if (!$token) {
            return new WP_Error(
                'jwt_auth_bad_auth_header',
                __('Authorization header malformed.', 'wp-api-jwt-auth'),
                array(
                    'status' => 403,
                )
            );
        }

        /** Get the Secret Key */
        $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : false;
        if (!$secret_key) {
            return new WP_Error(
                'jwt_auth_bad_config',
                __('JWT is not configurated properly, please contact the admin', 'wp-api-jwt-auth'),
                array(
                    'status' => 403,
                )
            );
        }

        /** Try to decode the token */
        try {
            $token =\Firebase\JWT\JWT::decode($token, $secret_key, array('HS256'));
            /** The Token is decoded now validate the iss */
            if ($token->iss != get_bloginfo('url')) {
                /** The iss do not match, return error */
                return new WP_Error(
                    'jwt_auth_bad_iss',
                    __('The iss do not match with this server', 'wp-api-jwt-auth'),
                    array(
                        'status' => 403,
                    )
                );
            }
            /** So far so good, validate the user id in the token */
            if (!isset($token->data->user->id)) {
                /** No user id in the token, abort!! */
                return new WP_Error(
                    'jwt_auth_bad_request',
                    __('User ID not found in the token', 'wp-api-jwt-auth'),
                    array(
                        'status' => 403,
                    )
                );
            }
            /** Everything looks good return the decoded token if the $output is false */
            if (!$output) {
                return $token;
            }
            /** If the output is true return an answer to the request to show it */
             return array(
                 'code' => 'jwt_auth_valid_token',
                 'data' => array(
                     'status' => 200,
                 ),
             );
         } catch (Exception $e) {
            /** Something is wrong trying to decode the token, send back the error */
             return new WP_Error(
                 'jwt_auth_invalid_token',
                 $e->getMessage(),
                 array(
                     'status' => 403,
                 )
             );
         }
    }