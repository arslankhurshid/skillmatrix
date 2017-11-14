<?php $this->load->view('admin/components/page_head'); ?>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><?php echo $meta_title; ?></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                <li><?php echo anchor('admin/competency', 'Kompetenz'); ?></li>
                <li><?php echo anchor('admin/competency/order', 'Kompetenzen sortieren'); ?></li>
                <li><?php echo anchor('admin/chart', 'Netzdiagramm'); ?></li>
                
            </ul>
        </div>
    </nav>
    <?php
    if ($this->session->flashdata('success')) {
        echo $this->session->flashdata('success');
    }
    ?>
    <div class="container">
        <div class="row">
            <!--main column-->
            <div class="col-md-8">
                <section>
                    <?php $this->load->view($subview); // subview is set in Controller?>
                </section>
            </div>
            <!--            <div class="pull-left">
                            <section>
            
                            </section>
                        </div>-->
            <!--Side bar-->
        </div>


</body>
