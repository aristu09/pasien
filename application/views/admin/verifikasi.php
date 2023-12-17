<?php $this->load->view('template/header'); ?>

<div class="container"><?= $this->session->flashdata('pesan'); ?></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="col-lg-12 col-xs-12">
    <div class="small-box bg-primary">
        <div class="inner text-center">
            <!-- membaca qrcode dari webcam dan mengubah status periksa -->
            <video id="video" width="50%" autoplay></video>
        </div>
        <a href="#" class="small-box-footer">Scan QR Code <i class="fa fa-qrcode"></i></a>
        <!-- <div id="result"></div> -->
    </div>
</div>

	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	<script type="text/javascript">
		var scanner = new Instascan.Scanner({ video: document.getElementById('video') });
		scanner.addListener('scan', function (content) {
			// document.getElementById('result').innerHTML = content;
			$.ajax({
				url: "<?php echo base_url('admin/verifikasi/scan'); ?>" + "/" + content,
				type: "POST",
				data: {
					qr: content
				},
				success: function(response) {
					swal({
                        title: "Berhasil",
                        text: "Berhasil verifikasi antrian pasien",
                        type: "success",
                        timer: 1000, // 3 detik
                        buttons: false, // menghilangkan tombol OK
                    }).then(function() {
                        var audio = new Audio('<?= base_url('themes/admin/mp3/beep.mp3'); ?>');
                        audio.play();
                    });
                },
                error: function(xhr, status, error) {
                    swal({
                        title: "Gagal",
                        text: "Gagal verifikasi antrian pasien",
                        timer: 1000, // 3 detik
                        buttons: false, // menghilangkan tombol OK
                    }).then(function() {
                        
                    });
                }
            });
        });
        Instascan.Camera.getCameras().then(function (cameras) {
			if (cameras.length > 0) {
				scanner.start(cameras[0]);
			} else {
				console.error('No cameras found.');
			}
		}).catch(function (e) {
			console.error(e);
		});
        
	</script>

<?php $this->load->view('template/footer'); ?>