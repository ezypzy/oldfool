<?php

class Breadcrumb {
    public $sep;
    public $home;
    public $base_url;

    public function __construct($sep='',$base_url=null,$home=null)
    {
        $this->sep  =   $sep;
        $this->base_url =   $base_url;
        $this->home = $home;
    }

    public function generate()
    {
        $breadcrumb     =   $pre_url    =   '';
        $server_path    =   $_SERVER['PHP_SELF'];

        if($this->base_url)
        {
            $base = parse_url($this->base_url);

            if(isset($base['path']) && strpos($server_path, $base['path']) >=0)
            {
                $server_path = substr($server_path, strlen($base['path']));
            }
        }

        $url    =   ($this->base_url ? $this->base_url . $server_path : 'http://' .((!empty($_SERVER['HTTPS'])) ? "s" : "") . $_SERVER['HTTP_HOST'] . $server_path);
        $domain =   ($this->base_url ? $this->base_url : 'http://' .((!empty($_SERVER['HTTPS'])) ? "s" : "") . $_SERVER['HTTP_HOST']);
        $url    =   $_SERVER['REQUEST_URI'];//substr($url, strlen($domain));
        $path   =   explode("/", $url);

        if(end($path) == '')
        {
            array_pop($path);
        }

        if(end($path) == 'index.php' || end($path) == 'index.html')
        {
            array_pop($path);
        }


        for($i=0; $i <= count($path)-1; $i++)
        {
            if($i == 0)
            {
                if(count($path)-1 > 0)
                {
                    $breadcrumb = '<li><a href="' . $domain . '">' . ($this->home==NULL ? "Home" : $this->home). '</a><span class="divider">'.$this->sep.'</span></li>';
                }
                else
                {
                    $breadcrumb = '<li class="active"><a href="' . $domain . '">' . ($this->home==NULL ? "Home" : $this->home). '</a></li>';
                }
            }
            elseif($i > 0 && $i < count($path)-1)
            {
                $pre_url .= $path[$i] . '/';

                if(strpos('.', $path[$i+1]) === false)
                {
                    $breadcrumb .= '<li><a href="' . $domain . '/' . $pre_url . '">' . $path[$i] . '</a><span class="divider">'.$this->sep.'</span></li>';
                }
            }

            else
            {
                $breadcrumb .= '<li class="active">'.$path[$i].'</li>';
            }
        }
        return $breadcrumb ? "<ul class='breadcrumb'>$breadcrumb</ul>" : '';
    }
}
