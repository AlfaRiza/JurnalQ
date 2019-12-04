<?php 

class User extends CI_Controller{

    /**
     * function rot13 untuk untuk enkripsi dan dekripsi
     * parameter adalah data yg akan di enkripsi atau di dekripsi
     */
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

    /**
     * function index untuk menampilkan home
     */
    public function index(){  
        if (!$this->session->userdata('user')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login </div>');
            redirect('auth');
        }
        //$keyword = $this->input->post('keyword');
        $data['title'] = ('Home');
        $data['jurnal'] = $this->user_model->getAll('jurnal');
        $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
        if (!$data['user']) {
            $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
        }
        if ($this->input->post('keyword')) {
            $data['jurnal'] = $this->user_model->Cari();
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('users/index',$data);
        $this->load->view('templates/footer',$data);
    }

    /**
     * function Profile untuk menampilkan My Profile
     */
    public function Profile(){
        $data['title'] = 'Profile';
        $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
        if (!$data['user']) {
            $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('users/profile',$data);
        $this->load->view('templates/footer',$data);
    }

    /**
     * function EditProfile untuk edit profile
     * 
     */

    public function EditProfile(){
        $data['title'] = 'Profile';
        $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
        if (!$data['user']) {
            $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
        }
        $data['username'] = $this->rot13($data['user']['username']);
        $this->form_validation->set_rules('nama','Nama','required|trim',[
            'required'  => 'Nama harus diisi'
        ]);
        $this->form_validation->set_rules('no_telp','Nomor Telpon','required|trim|numeric',[
            'required'  => 'Nama harus diisi',
            'numeric'   => 'Harus angka'
        ]);
        $this->form_validation->set_rules('alamat','Alamat','required|trim',[
            'required'  => 'Nama harus diisi',
        ]);
        if ( $this->form_validation->run() == false ) {
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('users/editProfile',$data);
        $this->load->view('templates/footer',$data);
        }else{
            $nama = $this->input->post('nama');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $set = [
                'nama'  => $nama,
                'alamat'    => $alamat,
                'no_telp' => $no_telp,
            ];
            $where = [
                'id' => $this->session->userdata('id')
            ];

            // cek gambar yg diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '20480';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $setw = [
                        'image' => $new_image
                    ];
                    $this->user_model->update('users', $where, $setw);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->user_model->update('users', $where, $set);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated! </div>');
            redirect('user/profile');
        }
    }

    public function Jurnal(){
        $data['title'] = 'My Jurnal';
        $id = $this->session->userdata('id');
        $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
        if (!$data['user']) {
            $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
        }
        $data['jurnal'] = $this->user_model->getJurnal('jurnal',['id_user' => $id]);
        // echo $id.'<pre>'; print_r($data['jurnal']);
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('users/jurnal',$data);
        $this->load->view('templates/footer',$data);
    }
    public function AddJurnal(){
        $this->form_validation->set_rules('judul','Judul','required|trim',[
            'required' => 'Judul harus diisi'
        ]);
        $this->form_validation->set_rules('tahun','Tahun','required|trim|numeric',[
            'required' => 'Tahun harus diisi',
            'numeric'   => 'Harus angka'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'My Jurnal';
            $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
            if (!$data['user']) {
                $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
            }
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('users/addJurnal',$data);
            $this->load->view('templates/footer',$data);
        }else{
            $new_file = $_FILES['file']['name'];
            if ($new_file) {
                $config['upload_path'] = './assets/file/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']     = '50480';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                    if (!$new_file) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Jurnal gagal dikumpul file tidak ada</div>');
                        redirect('user/AddJurnal');
                    }else {
                        $new_file = $file;
                }
                } else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                '.$this->upload->display_errors().'</div>');
                redirect('user/AddJurnal');
                }
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Jurnal gagal diupload</div>');
                        redirect('user/AddJurnal');
            }
            $data = [
                'title' => htmlspecialchars($this->input->post('judul'),true),
                'file' => $file,
                'id_user'   => $this->session->userdata('id'),
                'tahun' => htmlspecialchars($this->input->post('tahun'),true),
                'create_at' => time()
            ];
            $this->user_model->insertData('jurnal',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Jurnal berhasil diupload</div>');
            redirect('user/Jurnal');
        }
        }

        public function ChangePassword(){
            $data['title'] = 'Akun';
            $data['user']   = $this->user_model->getUsers('users',['username' => $this->rot13($this->session->userdata('user'))]);
            if (!$data['user']) {
                $data['user']   = $this->user_model->getUsers('users',['email' => $this->rot13($this->session->userdata('user'))]);
            }

            $this->form_validation->set_rules('current_password','Password','required|trim',[
                'required'  => 'Harus diisi'
            ]);
            $this->form_validation->set_rules('new_password1','Password','required|trim|matches[new_password2]',[
                'required'  => 'Harus diisi',
                'matches'   => 'Tidak sama'
            ]);
            $this->form_validation->set_rules('new_password2','Password','required|trim|matches[new_password1]',[
                'required'  => 'Harus diisi',
                'matches'   => 'Tidak sama'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('templates/topbar',$data);
                $this->load->view('users/changePassword',$data);
                $this->load->view('templates/footer',$data);
            }else {
                $currentPassword = htmlspecialchars($this->input->post('current_password'),true);
                $newPassword    = htmlspecialchars($this->input->post('new_password1'),true);
                if ($this->rot13($data['user']['password']) != $currentPassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah! </div>');
                    redirect('user/ChangePassword');
                }else{
                    $data = [
                        'password' => $this->rot13($newPassword)
                    ];
                    $where = [
                        'id'    => $this->session->userdata('id')
                    ];
                    $this->user_model->update('users',$where,$data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password telah diubah </div>');
                    redirect('user/changepassword');
                }
            }
        }

        public function download($id){
            $file = $this->user_model->getUsers('jurnal',['id'=>$id]);
            force_download('assets/file/'.$file['file'],NULL);
        }
        
    }

?>