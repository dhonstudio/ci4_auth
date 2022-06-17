<?php

namespace App\Libraries;

use CodeIgniter\Cookie\Cookie;
use DateTime;

class DhonHit
{
    /**
     * Connect to DhonRequest library.
     */
    protected $dhonrequest;

    /**
     * Set id address.
     */
    protected $id_address;

    /**
     * Set id entity.
     */
    protected $id_entity;

    /**
     * Set id session.
     */
    protected $id_session;

    /**
     * Set id source.
     */
    protected $id_source;

    /**
     * Set id page.
     */
    protected $id_page;

    public function __construct()
    {
        $this->dhonrequest  = new DhonRequest;
    }

    /**
     * Get Hit from user info.
     * 
     * @return void
     */
    public function collect()
    {
        $this->_setIpAddress();
        $this->_setEntity();
        $this->_setSession();
        $this->_setSource();
        $this->_setPage();
        $this->_getHit();
    }

    /**
     * Set ip address.
     * 
     * @return void
     */
    private function _setIpAddress()
    {
        $ip_address =
            !empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) ? $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]
            : (!empty($_SERVER["HTTP_X_CLIENT_IP"]) ? $_SERVER["HTTP_X_CLIENT_IP"]
                : (!empty($_SERVER["HTTP_CLIENT_IP"]) ? $_SERVER["HTTP_CLIENT_IP"]
                    : (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"]
                        : (!empty($_SERVER["HTTP_X_FORWARDED"]) ? $_SERVER["HTTP_X_FORWARDED"]
                            : (!empty($_SERVER["HTTP_FORWARDED_FOR"]) ? $_SERVER["HTTP_FORWARDED_FOR"]
                                : (!empty($_SERVER["HTTP_FORWARDED"]) ? $_SERVER["HTTP_FORWARDED"]
                                    : (!empty($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"]
                                        : '::0'
                                    )))))));

        if (ENVIRONMENT !== 'development') {
            foreach (explode(',', $ip_address) as $ip) {
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    $ip_address = $ip;
                }
            }
        }

        $address_pre        = $this->dhonrequest->get("gethit/getAddressByIP?ip_address={$ip_address}");
        $address            = $address_pre ? $address_pre['data'] : [];
        $this->id_address   = empty($address) ? $this->dhonrequest->post('gethit/postAddress', [
            'ip_address'    => $ip_address,
            'ip_info'       => $this->dhonrequest->curl("http://ip-api.com/json/{$ip_address}")
        ])['data']['id_address'] : $address['id_address'];
    }

    /**
     * Set entity.
     * 
     * @return void
     */
    private function _setEntity()
    {
        $entity = isset($_SERVER['HTTP_USER_AGENT']) ? htmlentities($_SERVER['HTTP_USER_AGENT']) : 'BOT';

        $entities           = $this->dhonrequest->get('gethit/getAllEntities')['data'];
        $entity_key         = array_search($entity, array_column($entities, 'entity'));
        $entity_av          = !empty($entities) ? ($entity_key > -1 ? $entities[$entity_key] : 0) : 0;
        $this->id_entity    = $entity_av === 0 ? $this->dhonrequest->post('gethit/postEntity', [
            'entity' => $entity,
        ])['data']['id'] : $entity_av['id'];
    }

    /**
     * Set session.
     * 
     * @return void
     */
    private function _setSession()
    {
        $session_name   = 'DShC13v';
        $session_prefix = ENVIRONMENT === 'production' ? '__Secure-' : '__m-';
        $session_secure = false;

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            helper('text');
            helper('cookie');

            $session_value  = random_string('alnum', 32);
            $session_cookie = (new Cookie($session_name))
                ->withValue($session_value)
                ->withPrefix($session_prefix)
                ->withExpires(new DateTime('+2 hours'))
                ->withPath('/')
                ->withDomain('')
                ->withSecure($session_secure)
                ->withHTTPOnly(true)
                ->withSameSite(Cookie::SAMESITE_LAX);

            if (!get_cookie($session_prefix . $session_name) || get_cookie($session_prefix . $session_name) === '' || get_cookie($session_prefix . $session_name) === null) {
                set_cookie($session_cookie);
            } else {
                $session_value = get_cookie($session_prefix . $session_name);
            }
        } else {
            $session_value = "BOT";
        }

        $session            = $this->dhonrequest->get("gethit/getSessionByCookie?session={$session_value}")['data'];
        $this->id_session   = empty($session) ? $this->dhonrequest->post('gethit/postSession', [
            'session' => $session_value,
        ])['data']['id_session'] : $session['id_session'];
    }

    /**
     * Set user source from.
     * 
     * @return void
     */
    private function _setSource()
    {
        $source_value       = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();

        $source             = $this->dhonrequest->get("gethit/getSourceByReferer?source={$source_value}")['data'];
        $this->id_source    = empty($source) ? $this->dhonrequest->post('gethit/postSource', [
            'source' => $source_value,
        ])['data']['id_source'] : $source['id_source'];
    }

    /**
     * Set page visited.
     * 
     * @return void
     */
    private function _setPage()
    {
        if ($_GET) {
            $get_join = [];
            foreach ($_GET as $key => $value) {
                array_push($get_join, $key . '=' . $value);
            }
            $get = '?' . implode('&', $get_join);
        } else {
            $get = '';
        }
        $page_value     = uri_string() ? uri_string() . $get : '/';

        $page           = $this->dhonrequest->get("gethit/getPageByUri?page={$page_value}")['data'];
        $this->id_page  = empty($page) ? $this->dhonrequest->post('gethit/postPage', [
            'page' => $page_value,
        ])['data']['id_page'] : $page['id_page'];
    }

    /**
     * Post the Hit.
     * 
     * @return void
     */
    private function _getHit()
    {
        $this->dhonrequest->post('gethit', [
            'address'   => $this->id_address,
            'entity'    => $this->id_entity,
            'session'   => $this->id_session,
            'source'    => $this->id_source,
            'page'      => $this->id_page,
            'created_at' => date("Y-m-d H:i:s", time())
        ]);
    }
}
