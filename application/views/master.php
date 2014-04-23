<?php $this->load->view('default/header', $headerData); ?>

	<?php $this->load->view('templates/'.$pageView,$pageData); ?>
	
<?php $this->load->view('default/footer', $footerData); ?>