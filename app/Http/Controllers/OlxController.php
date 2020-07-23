<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;


class OlxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function listitems() 
    {
        
        $url = "https://mg.olx.com.br/belo-horizonte-e-regiao/computadores-e-acessorios/notebook-e-netbook?q=gtx&sf=1";
        $browser = new HttpBrowser(HttpClient::create());

        $crawler = $browser->request('GET', $url);  
       
            $content = $crawler->filter('div.col2.sc-15vff5z-5.fFdJjk')->each(function ($node) {
                $res = $node->filter('div.fnmrjs-7.cfjFVu')->each(function ($row) {
                    $name = $row->filter('div.fnmrjs-8.kRlFBv')->each(function ($field) {
                        return $field->text();
                    });
                    if(count($name) === 0) {
                        return;
                    } else {
                        $name = $name[0];
                    }
    
                    $price = $row->filter('div.fnmrjs-15.clbSMi')->each(function ($field) {
                        return $field->text();
                    }); 
                    
                    $date = $row->filter('p.fnmrjs-19.eJIIxH')->each(function ($field) {
                        return $field->text();
                    }); 
    
                    $data['name'] = $name;
                    $data['price'] = $price;
                    $data['date'] = $date;
    
                    return $data;
                });
                return $res;
            });
            
            if(count($content) > 0) {
                $result['status'] = "success";
                $result['data'] = $content[0];
            }else{
                $result['status'] = "failed";
            }
    
            return response()->json($result);
        }
    }
    