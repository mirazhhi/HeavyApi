<?php
namespace Pool\Pages;

use Psr\Http\Message\RequestInterface;
use Pool\Acme\JWTAuth;

class Api
{
    private $username;

    private $password;

    private $email;

    private $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->username = 'miras';
        $this->password = '123qwe123qwe';
        $this->email = 'mhiggster@gmail.com';

        $this->jwt = $jwt;
    }


    private function validation()
    {
        if($_GET['name'] === $this->username && $_GET['password'] === $this->password) {
            return true;
        }
        return false;
    }

    public function token()
    {
        if(!$this->validation()) {
            // throw 401
            throw new Exception("Validation Error", 401);
        }
        dd($this->jwt->makePayload(1)->encode());
    }


    public function movies()
    {
        // $token = $_GET['token'];

        dd($this->jwt->decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJ1bmlxdWUuY29tIiwidXNlcl9pZCI6MX0.WYbRNSlNbqvu8WzYalVBBP0oqpp4qzYlE3v51losOT0wHfL1GNGqdllwKBRgKZWWJrfi0mbTl69CZh6AzLbmuiLQnl6ftnCdoFfWVcQFnIKjIbdqZi--vnn_PQWxi1AvmE1RPsXYHmnbSckjlEWxKEOcuprVrmVqpBLKH_jqacfBQyEzbd388a20iUvT7MSA9J96kUNS8GsxciIXpyFCkVdmXWdY9XYO2Y0VRTL9JKZG4d58YulUWm8V63lxFkWFKmmAw_oV4bpWta34n5IeSoXHcPvvFG4RWRAiGWu-ZqGb7807uhIhNFrVDBW1mzxZxeDZKF9HqGSdLUsN1A7emQ'));
    }
}