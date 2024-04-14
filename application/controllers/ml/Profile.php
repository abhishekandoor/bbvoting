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
    


function  yamuna_rani($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    
    $this->template->write_view("content",'ml/yemuna_rani', $data);
    $this->template->load();
}

function  saranya_anand($contestant_id){
    $data =array(); 
    
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/saranya_anand', $data);
    $this->template->load();
}
function apsara_rathnakaran($contestant_id){
    $data =array(); 
   
    // echo $contestant_id; die;
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/apsara', $data);
    $this->template->load();
}
function ansiba_hassan($contestant_id){
   

    $decryptedText = $this->encryption->decrypt($encryptedText);
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/ansiba', $data);
    $this->template->load();
}

function  jasmin_j($contestant_id){
    $data =array(); 
    
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jasmine', $data);
    $this->template->load();
}

function arjun_syam($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/arjun_syam', $data);
    $this->template->load();
}

function sreerekhaa($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/sreerekhaa', $data);
    $this->template->load();
}
function jaanmoni_das($contestant_id){
    $data =array(); 

    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jaanmoni_das', $data);
    $this->template->load();
}
function jinto_bodycraft($contestant_id){
    $data =array(); 
    
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/jinto_bodycraft', $data);
    $this->template->load();
}
function gabri_jose($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/gabri_jose', $data);
    $this->template->load();
}
function nora_muskan($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/nora_muskan', $data);
    $this->template->load();
}
function sreethu_krishnan($contestant_id){
    $data =array();
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/sreethu_krishnan', $data);
    $this->template->load();
}
function rishi_s_kumar($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/rishi_s_kumar', $data);
    $this->template->load();
}
function resmin_bai($contestant_id){
    $data =array(); 
  
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));


    $this->template->write_view("content",'ml/resmin_bai', $data);
    $this->template->load();
}
function ratheesh_kumar($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    
    $this->template->write_view("content",'ml/ratheesh_kumar', $data);
    $this->template->load();
}
function sijo_john($contestant_id){
    $data =array(); 
    
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/sijo_john', $data);
    $this->template->load();
}
function suresh_menon($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/suresh_menon', $data);
    $this->template->load();
}
function nishana($contestant_id){
    $data =array(); 
   
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/nishana', $data);
    $this->template->load();
}
function rocky($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/rocky', $data);
    $this->template->load();
}




function abhishek_sreekumar($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/abhishek_sreekumar', $data);
    $this->template->load();
}

function abhishek_jayadeep($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/abhishek_k', $data);
    $this->template->load();
}

function pooja_krishna($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/pooja', $data);
    $this->template->load();
}

function dj_sibin($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/dj_sibin', $data);
    $this->template->load();
}

function nandana_nandu($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/nandana_nandu', $data);
    $this->template->load();
}

function sai_krishna($contestant_id){
    $data =array(); 
 
    if(!$contestant_id){
        redirect('ml/Home/all_contestants');
    }
    $data['page_title'] = 'Profile';
    $data['contestant']= $this->General->getrow('contestant','name,profession,photo_url',array('id '=>$contestant_id));

    $this->template->write_view("content",'ml/sai_krishna', $data);
    $this->template->load();
}







}