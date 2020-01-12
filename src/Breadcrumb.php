<?php

    namespace Nepnepz\Breadcrumb;

    class Breadcrumb{

        public static function make($path){

            $url=$path;
    
            $breadcrumb='<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
                $breadcrumb .='
                ';
                $breadcrumb .='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
                if (strlen($url)!=1) {
                    $breadcrumb .='<a itemtype="http://schema.org/Thing" itemprop="item" href="';
                    $breadcrumb .= url('');
                    $breadcrumb .='">';
                }
                $breadcrumb .='<span itemprop="name">Home</span>';
                if (strlen($url)!=1) {
                    $breadcrumb .='</a>';
                }
                $breadcrumb .='<meta itemprop="position" content="1" /></li>';
    
            $numberOfContent=1;
            if(strlen($url)!=1){
    
                $url=explode("/",$url);
    
                $last_key_url= array_key_last($url);
    
                for($i=0;$i<count($url);$i++){
    
                    if($url[$i]!="page"){
                        $breadcrumb .='
                        ';
                        $breadcrumb .='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    
                        // make tag <a>
                        if($i!=$last_key_url){
                            $breadcrumb .='<a itemtype="http://schema.org/Thing" itemprop="item" href="';
                            $breadcrumb .= url('');
                            for($y=0;$y<=$i;$y++){
    
                                $breadcrumb .="/".$url[$y];
                            }
                            $breadcrumb .='">';
                        }
                        // end make tag <a>
    
                        $breadcrumb .='<span itemprop="name">';
                        $breadcrumb .=ucwords(str_replace("-", " ", $url[$i]));
                        $breadcrumb .='</span>';
                        // make tag <a>
                        if ($i!=$last_key_url) {
                            $breadcrumb .='</a>';
                        }
                        // end make tag <a>
    
                        $breadcrumb .='<meta itemprop="position" content="';
                        $breadcrumb .=$numberOfContent+1;
                        $breadcrumb .='" /></li>';
                        $numberOfContent++;
                    }
    
                }
            }
    
    
            $breadcrumb .='
                ';
            $breadcrumb .= "</ol>";
    
            return $breadcrumb;
        }
    
        public static function makeJSONLD($path){
    
            $url=$path;
            //remove if amp page
            $url=str_replace('amp/','',$url);

            $breadcrumb='<script type="application/ld+json">{"@context": "https://schema.org","@type": "BreadcrumbList","itemListElement": [{';
    
            $breadcrumb .='"@type": "ListItem",';
            $breadcrumb .='"position": 1,';
            $breadcrumb .='"name": "Home",';
            $breadcrumb .='"item": "';
            $breadcrumb .=url('');
            $breadcrumb .='"}';
    
            if(strlen($url)!=1){
    
                $breadcrumb .=',';
            }
    
            $numberOfContent=2;
    
            if(strlen($url)!=1){
    
                $url=explode("/",$url);
                
                $last_key_url= array_key_last($url);
    
                for($i=0;$i<count($url);$i++){
    
                    if($url[$i]!="page"){
    
                        $breadcrumb .='{';
                        $breadcrumb .='"@type": "ListItem",';
                        $breadcrumb .='"position": '.$numberOfContent.',';
                        $numberOfContent++;
                        $breadcrumb .='"name": "'.$url[$i].'",';
                        $breadcrumb .='"item": "';
                        $breadcrumb .= url('');
                        
                        for($y=0;$y<=$i;$y++){
    
                            $breadcrumb .="/".$url[$y];
                        }
    
                        $breadcrumb .='"}';
    
                        // make tag <a>
                        if($i!=$last_key_url){
                            $breadcrumb .=',';
                        }
                        // end make tag <a>
                    }
    
                }
            }
    
            $breadcrumb .=']';
            $breadcrumb .= "}";
    
            $breadcrumb .= "</script>";
    
            return $breadcrumb;
        }


    }

?>
