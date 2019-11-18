<?php 

class User extends CI_Controller{

    function rot13($str) {
        $a = ord('a');
        $A = ord('A');
        
        for ($i = 0, $len = strlen($str); $i < $len; $i++) {
            $asciiCode = ord($str[$i]);
    
            // Not a letter, keep what it is
            if ($asciiCode < $A || $asciiCode >= $a + 26) continue;
    
            // To check if should use the alphabet with upper or lower case letters
            $initialLetterOfAlphabet = $asciiCode < $a? $A : $a;
            $str[$i] = chr(($asciiCode - $initialLetterOfAlphabet + 13) % 26 + $initialLetterOfAlphabet);
        }
    
        return $str;
    }

    public function index(){    
        $data['title'] = ('Home');
        $data['jurnal'] = $this->user_model->getAll('jurnal');
        $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
        if (!$data['user']) {
            $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('users/index',$data);
        $this->load->view('templates/footer',$data);
    }
}

?>