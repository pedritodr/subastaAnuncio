<aside class="main-sidebar" style="background-color:#1a2858 !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php
            $url = base_url('assets/juice.png');
            if (file_exists($this->session->userdata('foto')))
                $url = base_url($this->session->userdata('foto'));


            ?>
            <div class="pull-left image">
                <img src="<?= $url; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('name'); ?></p>
                <a href="#">En-Línea</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) { ?>

                <li>
                    <a href="<?= site_url('dashboard/index'); ?>">
                        <i class="fa fa-dashboard"></i> <span><?= translate('pizarra_resumen_lang'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('empresa/index'); ?>">
                        <i class="fa fa-home"></i> <span><?= translate('dato_general_lang'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('user/index'); ?>">
                        <i class="fa fa-users"></i> <span><?= translate('manage_users'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('categoria/index'); ?>">
                        <i class="fa fa-thumb-tack"></i> <span><?= translate('manage_categories_lang'); ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?= site_url('subasta/index'); ?>">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                        <span><?= translate('manage_subasta_lang'); ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?= site_url('cate_anuncio/index'); ?>">
                        <i class="fa fa-thumb-tack"></i>
                        <span><?= translate('manage_cate_anun_lang'); ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?= site_url('membresia/index'); ?>">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                        <span><?= translate('manage_membresia_lang'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('membresia/index_usuarios'); ?>">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                        <span><?= translate('membresias_lang'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('banner/index'); ?>">
                        <i class="fa fa-bookmark"></i> <span><?= translate('manage_banners_lang'); ?></span>
                    </a>
                </li>



                <li>
                    <a href="<?= site_url('pais/index'); ?>">
                        <i class="fa fa-globe" aria-hidden="true"></i> <span><?= translate('manage_country_lang'); ?></span>
                    </a>


                </li>

                <li>
                    <a href="<?= site_url('anuncio/index'); ?>">
                        <i class="fa fa-tag" aria-hidden="true"></i> <span><?= translate('manage_anuncio_lang'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('premio/index'); ?>">
                        <i class="fa fa-trophy" aria-hidden="true"></i> <span><?= translate('manage_premios_lang'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('payment/index'); ?>">
                        <i class="fa fa-money" aria-hidden="true"></i> <span><?= translate('manage_payment_lang'); ?></span>
                    </a>
                </li>


            <?php }  ?>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>