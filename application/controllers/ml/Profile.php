<?php
class Profile extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');

        $this->load->model('General');
        $this->load->model('Voting_Model','VM');
    }
    


function  yamuna_rani($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    
    $this->template->write_view("content",'ml/yemuna_rani', $data);
    $this->template->load();
}

function  saranya_anand($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/saranya_anand', $data);
    $this->template->load();
}
function apsara_rathnakaran($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    // echo $contestant_id; die;
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/apsara', $data);
    $this->template->load();
}
function ansiba_hassan($enc_contestant_id){
   

    $decryptedText = $this->encryption->decrypt($encryptedText);
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/ansiba', $data);
    $this->template->load();
}

function  jasmin_j($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jasmine', $data);
    $this->template->load();
}

function arjun_syam($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/arjun_syam', $data);
    $this->template->load();
}

function sreerekhaa($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/sreerekhaa', $data);
    $this->template->load();
}
function jaanmoni_das($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jaanmoni_das', $data);
    $this->template->load();
}
function jinto_bodycraft($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jinto_bodycraft', $data);
    $this->template->load();
}
function gabri_jose($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/gabri_jose', $data);
    $this->template->load();
}
function nora_muskan($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/nora_muskan', $data);
    $this->template->load();
}
function sreethu_krishnan($enc_contestant_id){
    $data =array();
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/sreethu_krishnan', $data);
    $this->template->load();
}
function rishi_s_kumar($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/rishi_s_kumar', $data);
    $this->template->load();
}
function resmin_bai($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/resmin_bai', $data);
    $this->template->load();
}
function ratheesh_kumar($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/ratheesh_kumar', $data);
    $this->template->load();
}
function sijo_john($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/sijo_john', $data);
    $this->template->load();
}
function suresh_menon($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/suresh_menon', $data);
    $this->template->load();
}
function nishana($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/nishana', $data);
    $this->template->load();
}
function rocky($enc_contestant_id){
    $data =array(); 
    $enc_contestant_id = strtr($enc_contestant_id, array('.' => '+', '-' => '=', '~' => '/'));
 $contestant_id = $this->encryption->decrypt($enc_contestant_id);
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/rocky', $data);
    $this->template->load();
}







}