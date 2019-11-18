<?php 

    class Auth extends CI_Controller{

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
            
            $this->form_validation->set_rules('user','Username atau Email','required|trim',[
                'required' => 'Harus diisi'
            ]);
            $this->form_validation->set_rules('password','Password','required|trim',[
                'required' => 'Password Harus diisi'
            ]);
            if ( $this->form_validation->run() == false ) {
                $data['title'] = ('Halaman Login');
                $this->load->view('templates/header_auth',$data);
                $this->load->view('auth/index',$data);
                $this->load->view('templates/footer_auth',$data);
            }else{
                $this->_login();
            }
            
        }

        private function _login(){
            $user = $this->input->post('user');
            $password = $this->input->post('password');

            $cekUsername = $this->user_model->getUsers('users',['username' => $this->rot13($user)]);
            $cekEmail = $this->user_model->getUsers('users',['email' => $this->rot13($user)]);
            $cekPassword = $this->user_model->getUsers('users',['password' => $this->rot13($password)]);

            if ($cekUsername || $cekEmail) {
                if ($cekPassword) {
                    $data = [
                        'user' => $user
                    ];
                    $this->session->set_userdata($data);
                    redirect('user');
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Salah</div>');
                    redirect('auth');
                }
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Username atau Email tidak terdaftar</div>');
                redirect('auth');
            }


        }

        public function registration(){

            $this->form_validation->set_rules('username','Username','required|trim',[
                'required' => 'Username harus diisi'
            ]);
            $this->form_validation->set_rules('nama','Nama','required|trim',[
                'required' => 'Username harus diisi'
            ]);
            $this->form_validation->set_rules('email','Email','required|trim|valid_email',[
                'required' => 'Username harus diisi',
                'valid_email' => 'Email tidak valid'
            ]);
            $this->form_validation->set_rules('jk','Jenis Kelamin','required|trim',[
                'required' => 'Username harus diisi'
            ]);
            $this->form_validation->set_rules('alamat','Alamat','required|trim',[
                'required' => 'Username harus diisi'
            ]);
            $this->form_validation->set_rules('no_telp','Nomor Telpon','required|trim|numeric',[
                'required' => 'Username harus diisi',
                'numeric'   => 'Harus angka'
            ]);
            $this->form_validation->set_rules('password','Password','required|trim|min_length[3]|matches[repeatPassword]',[
                'required' => 'Password harus diisi',
                'min_length' => 'Minimal 3 karakter',
                'matches'   => 'Password tidak sama'
            ]);
            $this->form_validation->set_rules('repeatPassword','Repeat Password','required|trim|min_length[3]|matches[password]',[
                'required' => 'Password harus diisi',
                'min_length' => 'Minimal 3 karakter',
                'matches'   => 'Password tidak sama'
            ]);
            
            if ( $this->form_validation->run() == false ) {
            $data['title'] = 'Registration';
            $data['agama'] = $this->user_model->getData('agama');
            $data['jk'] = $this->user_model->getData('jenis_kelamin');
            $this->load->view('templates/header_auth',$data);
            $this->load->view('auth/registration',$data);
            $this->load->view('templates/footer_auth');
            }else {
                $username = $this->input->post('username');
                $nama = $this->input->post('nama');
                $email = $this->input->post('email');
                $agama = $this->input->post('agama');
                $jk = $this->input->post('jk');
                $alamat = $this->input->post('alamat');
                $no_telp = $this->input->post('no_telp');
                $password = $this->input->post('password');

                //ambil data users
                $cekUsername = $this->user_model->getUsers('users',['username' => $this->rot13($username)]);
                $cekEmail = $this->user_model->getUsers('users',['email' => $this->rot13($email)]);

                //kondisi
                if ($cekUsername) {
                    
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <b>Username</b> sudah ada!</div>');
                redirect('auth/registration');
                }elseif ($cekEmail) {
                    
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <b>Email</b> sudah ada!</div>');
                redirect('auth/registration');
                }else{
                    $data = [
                        'username'  => $this->rot13($username),
                        'nama'      => $nama,
                        'email'     => $this->rot13($email),
                        'image'     => 'default.jpg',
                        'id_agama'  => $agama,
                        'id_jk'     => $jk,
                        'alamat'    => $alamat,
                        'no_telp'   => $no_telp,
                        'password'  => $this->rot13($password),
                        'create_at' => time()
                    ];
    
                    $this->user_model->insertData('users',$data);
    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Registrasi <b>BERHASIL</b>, silahkan <b>LOGIN</b> ! </div>');
                    redirect('auth');
                }
                
                
            }
            
        }


    }

?>