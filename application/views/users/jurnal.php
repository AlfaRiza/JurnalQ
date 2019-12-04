
            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <?= $this->session->flashdata('message'); ?>
            
        <div class="row">
            <?php foreach($jurnal as $j) : ?>
            <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <i class="fas fa-file-pdf"></i>
                <div class="card-body">
                    <h5 class="card-title"><?= $j['title'] ?></h5>
                    <p class="card-text"><?= $j['tahun'] ?></p>
                    <p class="card-text"><?= date($j['create_at']) ?></p>
                    <a href="<?= base_url('user/download/').$j['id']; ?>" class="btn btn-primary card-link"><i class="fas fa-fw fa-file-download"></i> Download</a>
                            <a href="#" class="card-link" data-toggle="modal" data-target="#exampleModal<?= $j['id']; ?>"><i class="fas fa-fw fa-eye"></i> Preview</a>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
        </div>
            <!-- /.container-fluid -->
            <?php foreach($jurnal as $j) : ?>
            <div class="modal fade bd-example-modal-lg" id="exampleModal<?= $j['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $j['title']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <div>
                                <embed src="<?= base_url('assets/file/').$j['file']; ?>" type='application/pdf' width='100%' height='350px'/>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('mahasiswa/download/').$j['file']; ?>" class="btn btn-primary">Download</a>
                </div>
                </div>
            </div>
            </div>
            <?php endforeach; ?>