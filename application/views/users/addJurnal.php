
            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            
            <div class="row justify-content-center">
            <div class="col-md-6">
            <?= form_open_multipart('user/AddJurnal');  ?>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul"  placeholder="Judul Jurnal" value="<?= set_value('user'); ?>">
                    <?= form_error('judul', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <div class="custom-file">
                    <label for="file" class="custom-file-label">File</label>
                    <input type="file" name="file" class="form-control-input" id="file">
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Tahun" value="<?= set_value('user'); ?>">
                    <?= form_error('tahun', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </form>
            </div>
            </div>
            
            <!-- /.container-fluid -->
