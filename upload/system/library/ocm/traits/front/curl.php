<?php
namespace OCM\Traits\Front;
trait Curl {
    private function sanitizeCurl($curl, $placeholders, $replacers) {
        if (empty($curl['header']) || !is_array($curl['header'])) {
            $curl['header'] = array();
        }
        if (empty($curl['body']) || !is_array($curl['body'])) {
            $curl['body'] = array();
        }
        if (!isset($curl['method'])) {
            $curl['method'] = 'POST';
        }
        foreach ($curl['header'] as &$each) {
            $each['value'] = $this->ocm->html_decode($each['value']);
            $each['name']  = str_replace($placeholders, $replacers, $each['name']);
            $each['value'] = str_replace($placeholders, $replacers, $each['value']);
        }
        foreach ($curl['body'] as &$each) {
            $each['value'] = $this->ocm->html_decode($each['value']);
            $each['name']  = str_replace($placeholders, $replacers, $each['name']);
            $each['value'] = str_replace($placeholders, $replacers, $each['value']);
            // if it is object, lets decode
            $_value = json_decode($each['value'], true);
            if (is_array($_value)) {
                $each['value'] = $_value;
            }
            if ($each['value'] === 'true') {
                $each['value'] = true;
            }
            if ($each['value'] === 'false') {
                $each['value'] = false;
            }
        }
        $encoding = isset($curl['encoding']) && $curl['encoding'] == 'raw' ? PHP_QUERY_RFC3986 : PHP_QUERY_RFC1738;
        $header = $this->ocm->common->toCurlHeader($curl['header']);
        $body = $this->ocm->common->toCurlData($curl['body']);
        $url = '';
        if (!empty($curl['url'])) {
            $url = $this->ocm->html_decode($curl['url']);
            $url = str_replace($placeholders, $replacers, $url);
            $result = $this->parseUrl($url); // not using built-in function avoidng encoding issue
            if ($result['query']) {
                $_query = http_build_query($result['params'], null, '&', $encoding);
                $url = str_replace($result['query'], $_query, $url); 
            }
            if (!empty($curl['auth'])) {
                if ($curl['auth']['type'] == 'basic') {
                    if ($curl['auth']['user'] || $curl['auth']['password']) {
                        $auth_key = $curl['auth']['user'] . ':' .$curl['auth']['password'];
                        $header[] = 'Authorization: Basic ' . base64_encode($auth_key);
                    }
                }
                if ($curl['auth']['type'] == 'bearer') {
                    if ($curl['auth']['token']) {
                        $header[] = 'Authorization: Bearer ' . $curl['auth']['token'];
                    }
                }
            }
            if ($curl['method'] == 'JSON') {
                $curl['method'] = 'POST';
                $body = json_encode($body); 
                $header[] = 'Content-Type: application/json';
                $header[] = 'Content-Length: ' . strlen($body);
            }
        }
        return array(
            'url'     => $url,
            'method'  => $curl['method'],
            'body'    => $body,
            'header'  => $header,
            'encoding'=> $encoding
        );
    }
    private function logCurl($request, $response, $type = '') {
        $log = $type . 'Curl log' . PHP_EOL;
        $log .= 'Request:' . PHP_EOL;
        $log .= 'URL ' . $request['url'] . PHP_EOL;
        $log .= 'Method ' . $request['method'] . PHP_EOL;
        $log .= 'Header ' . json_encode($request['header']) . PHP_EOL;
        $log .= 'Body ' . (is_array($request['body']) ? json_encode($request['body']) : $request['body']) . PHP_EOL;
        $log .= 'Response:' . PHP_EOL;
        $log .= (is_array($response) ? json_encode($response) : $response);
        $this->log->write($log);
    }
    public function parseUrl($url) {
        $return = array(
            'query'  => false,
            'params' => array()
        );
        $components = explode('?', $url);
        $return['url'] = array_shift($components);
        if ($components) {
            $query = count($components) > 1 ? implode('?', $components) : $components[0]; // query string may have ?
            $params = explode('&', $query);
            foreach($params as $param) {
                $key_val = explode('=', $param, 2); // only consider first = because it may have multiple =
                $key = $key_val[0];
                $val = isset($key_val[1]) ? $key_val[1] : '';
                $return['params'][$key] = $val;
            }
            $return['query'] = $query;
        }
        return $return;
    }
    // for future if needed
    private function getPhoneCode($code) {
        $phone_codes = array('BD'=>'880', 'BE'=>'32', 'BF'=>'226', 'BG'=>'359', 'BA'=>'387', 'BB'=>'1246', 'WF'=>'681', 'BL'=>'590', 'BM'=>'1441', 'BN'=>'673', 'BO'=>'591', 'BH'=>'973', 'BI'=>'257', 'BJ'=>'229', 'BT'=>'975', 'JM'=>'1876', 'BV'=>'', 'BW'=>'267', 'WS'=>'685', 'BQ'=>'599', 'BR'=>'55', 'BS'=>'1242', 'JE'=>'441534', 'BY'=>'375', 'BZ'=>'501', 'RU'=>'7', 'RW'=>'250', 'RS'=>'381', 'TL'=>'670', 'RE'=>'262', 'TM'=>'993', 'TJ'=>'992', 'RO'=>'40', 'TK'=>'690', 'GW'=>'245', 'GU'=>'1671', 'GT'=>'502', 'GS'=>'', 'GR'=>'30', 'GQ'=>'240', 'GP'=>'590', 'JP'=>'81', 'GY'=>'592', 'GG'=>'441481', 'GF'=>'594', 'GE'=>'995', 'GD'=>'1473', 'GB'=>'44', 'GA'=>'241', 'SV'=>'503', 'GN'=>'224', 'GM'=>'220', 'GL'=>'299', 'GI'=>'350', 'GH'=>'233', 'OM'=>'968', 'TN'=>'216', 'JO'=>'962', 'HR'=>'385', 'HT'=>'509', 'HU'=>'36', 'HK'=>'852', 'HN'=>'504', 'HM'=>' ', 'VE'=>'58', 'PR'=>'1787', 'PS'=>'970', 'PW'=>'680', 'PT'=>'351', 'SJ'=>'47', 'PY'=>'595', 'IQ'=>'964', 'PA'=>'507', 'PF'=>'689', 'PG'=>'675', 'PE'=>'51', 'PK'=>'92', 'PH'=>'63', 'PN'=>'870', 'PL'=>'48', 'PM'=>'508', 'ZM'=>'260', 'EH'=>'212', 'EE'=>'372', 'EG'=>'20', 'ZA'=>'27', 'EC'=>'593', 'IT'=>'39', 'VN'=>'84', 'SB'=>'677', 'ET'=>'251', 'SO'=>'252', 'ZW'=>'263', 'SA'=>'966', 'ES'=>'34', 'ER'=>'291', 'ME'=>'382', 'MD'=>'373', 'MG'=>'261', 'MF'=>'590', 'MA'=>'212', 'MC'=>'377', 'UZ'=>'998', 'MM'=>'95', 'ML'=>'223', 'MO'=>'853', 'MN'=>'976', 'MH'=>'692', 'MK'=>'389', 'MU'=>'230', 'MT'=>'356', 'MW'=>'265', 'MV'=>'960', 'MQ'=>'596', 'MP'=>'1670', 'MS'=>'1664', 'MR'=>'222', 'IM'=>'441624', 'UG'=>'256', 'TZ'=>'255', 'MY'=>'60', 'MX'=>'52', 'IL'=>'972', 'FR'=>'33', 'IO'=>'246', 'SH'=>'290', 'FI'=>'358', 'FJ'=>'679', 'FK'=>'500', 'FM'=>'691', 'FO'=>'298', 'NI'=>'505', 'NL'=>'31', 'NO'=>'47', 'NA'=>'264', 'VU'=>'678', 'NC'=>'687', 'NE'=>'227', 'NF'=>'672', 'NG'=>'234', 'NZ'=>'64', 'NP'=>'977', 'NR'=>'674', 'NU'=>'683', 'CK'=>'682', 'XK'=>'', 'CI'=>'225', 'CH'=>'41', 'CO'=>'57', 'CN'=>'86', 'CM'=>'237', 'CL'=>'56', 'CC'=>'61', 'CA'=>'1', 'CG'=>'242', 'CF'=>'236', 'CD'=>'243', 'CZ'=>'420', 'CY'=>'357', 'CX'=>'61', 'CR'=>'506', 'CW'=>'599', 'CV'=>'238', 'CU'=>'53', 'SZ'=>'268', 'SY'=>'963', 'SX'=>'599', 'KG'=>'996', 'KE'=>'254', 'SS'=>'211', 'SR'=>'597', 'KI'=>'686', 'KH'=>'855', 'KN'=>'1869', 'KM'=>'269', 'ST'=>'239', 'SK'=>'421', 'KR'=>'82', 'SI'=>'386', 'KP'=>'850', 'KW'=>'965', 'SN'=>'221', 'SM'=>'378', 'SL'=>'232', 'SC'=>'248', 'KZ'=>'7', 'KY'=>'1345', 'SG'=>'65', 'SE'=>'46', 'SD'=>'249', 'DO'=>'1809 and 1-829', 'DM'=>'1767', 'DJ'=>'253', 'DK'=>'45', 'VG'=>'1284', 'DE'=>'49', 'YE'=>'967', 'DZ'=>'213', 'US'=>'1', 'UY'=>'598', 'YT'=>'262', 'UM'=>'1', 'LB'=>'961', 'LC'=>'1758', 'LA'=>'856', 'TV'=>'688', 'TW'=>'886', 'TT'=>'1868', 'TR'=>'90', 'LK'=>'94', 'LI'=>'423', 'LV'=>'371', 'TO'=>'676', 'LT'=>'370', 'LU'=>'352', 'LR'=>'231', 'LS'=>'266', 'TH'=>'66', 'TF'=>'', 'TG'=>'228', 'TD'=>'235', 'TC'=>'1649', 'LY'=>'218', 'VA'=>'379', 'VC'=>'1784', 'AE'=>'971', 'AD'=>'376', 'AG'=>'1268', 'AF'=>'93', 'AI'=>'1264', 'VI'=>'1340', 'IS'=>'354', 'IR'=>'98', 'AM'=>'374', 'AL'=>'355', 'AO'=>'244', 'AQ'=>'', 'AS'=>'1684', 'AR'=>'54', 'AU'=>'61', 'AT'=>'43', 'AW'=>'297', 'IN'=>'91', 'AX'=>'35818', 'AZ'=>'994', 'IE'=>'353', 'ID'=>'62', 'UA'=>'380', 'QA'=>'974', 'MZ'=>'258');
        return !empty($phone_codes[$code]) ? $phone_codes[$code] : '';
    }
}