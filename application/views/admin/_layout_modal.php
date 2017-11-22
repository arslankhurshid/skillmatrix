<?php $this->load->view('admin/components/page_head'); ?>
<body style="background: #555;">

<div class="container">
  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <?php $this->load->view($subview); // subview is set in Controller?>
        <div class="modal-footer">
            
        &copy<?php echo $meta_title; ?>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>