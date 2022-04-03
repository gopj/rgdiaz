<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="admin,dashboard" />
    <meta name="description" content="Crizal - Responsive Admin Dashboard Template" />
    
    <!-- title  -->
    <title>Crizal - Responsive Admin Dashboard Template</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url('img/crizal/logos/favicon.png')?>">
    <link rel="apple-touch-icon" href="<?=base_url('img/crizal/logos/apple-touch-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('img/crizal/logos/apple-touch-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('img/crizal/logos/apple-touch-icon-114x114.png')?>">

    <!-- common plugins -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap/bootstrap.min.css')?>" />
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/font-awesome/css/font-awesome.min.css')?>" />
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/icomoon/style.css')?>" />
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/uniform/css/default.css')?>" />
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/switchery/switchery.min.css')?>" />

    <!-- summernote-master plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/summernote-master/summernote.css')?>" />

    <!-- bootstrap-datepicker plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-datepicker/datepicker.css')?>" />
    <script src="<?=base_url('js/crizal/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.js')?>"></script>


    <!-- bootstrap-colorpicker plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-colorpicker/bootstrap-colorpicker.css')?>" />

    <!-- bootstrap-tagsinput plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" />

    <!-- bootstrap-clockpicker plugin -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.css')?>" />
    
    <!-- custom css -->
    <link rel="stylesheet" href="<?=base_url('css/crizal/admin-template/styles.css')?>" />

</head>

<body>

   		<?=$output?>

             <!-- start main right sidebar -->
            <div class="page-right-sidebar" id="main-right-sidebar">
                <div class="page-right-sidebar-inner">
                    <div class="right-sidebar-top">
                        <div class="right-sidebar-tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active" id="chat-tab"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">chat</a></li>
                                <li role="presentation" id="settings-tab"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">settings</a></li>
                            </ul>
                        </div>
                        <a href="#!" class="right-sidebar-toggle right-sidebar-close" data-sidebar-id="main-right-sidebar"><i class="icon-close"></i></a>
                    </div>
                    <div class="right-sidebar-content">
                        <!-- start tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="chat">
                                <div class="chat-list">
                                    <span class="chat-title">Recent</span>
                                    <a href="#!" class="right-sidebar-toggle chat-item unread" data-sidebar-id="chat-right-sidebar">
                                        <div class="user-avatar">
                                            <img src="<?=base_url('img/crizal/avatars/chat01.jpg')?>" alt="" />
                                        </div>
                                        <div class="chat-info">
                                            <span class="chat-author">David</span>
                                            <span class="chat-text">where u at?</span>
                                            <span class="chat-time">08:50</span>
                                        </div>
                                    </a>
                                    <a href="#!" class="right-sidebar-toggle chat-item unread active-user" data-sidebar-id="chat-right-sidebar">
                                        <div class="user-avatar">
                                            <img src="<?=base_url('img/crizal/avatars/chat02.jpg')?>" alt="" />
                                        </div>
                                        <div class="chat-info">
                                            <span class="chat-author">Daisy</span>
                                            <span class="chat-text">Daisy sent a photo.</span>
                                            <span class="chat-time">11:34</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="chat-list">
                                    <span class="chat-title">Older</span>
                                    <a href="#!" class="right-sidebar-toggle chat-item" data-sidebar-id="chat-right-sidebar">
                                        <div class="user-avatar">
                                            <img src="<?=base_url('img/crizal/avatars/chat03.jpg')?>" alt="" />
                                        </div>
                                        <div class="chat-info">
                                            <span class="chat-author">Tom</span>
                                            <span class="chat-text">You: ok</span>
                                            <span class="chat-time">2d</span>
                                        </div>
                                    </a>
                                    <a href="#!" class="right-sidebar-toggle chat-item active-user" data-sidebar-id="chat-right-sidebar">
                                        <div class="user-avatar">
                                            <img src="<?=base_url('img/crizal/avatars/chat04.jpg')?>" alt="" />
                                        </div>
                                        <div class="chat-info">
                                            <span class="chat-author">Anna</span>
                                            <span class="chat-text">asdasdasd</span>
                                            <span class="chat-time">4d</span>
                                        </div>
                                    </a>
                                    <a href="#!" class="right-sidebar-toggle chat-item active-user" data-sidebar-id="chat-right-sidebar">
                                        <div class="user-avatar">
                                            <img src="<?=base_url('img/crizal/avatars/chat05.jpg')?>" alt="" />
                                        </div>
                                        <div class="chat-info">
                                            <span class="chat-author">Liza</span>
                                            <span class="chat-text">asdasdasd</span>
                                            <span class="chat-time">&nbsp;</span>
                                        </div>
                                    </a>
                                    <a href="#!" class="load-more-messages" data-toggle="tooltip" data-placement="bottom" title="Load More">&bull;&bull;&bull;</a>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="right-sidebar-settings">
                                    <span class="settings-title">General Settings</span>
                                    <ul class="sidebar-setting-list list-unstyled">
                                        <li>
                                            <span class="settings-option">Notifications</span>
                                            <input type="checkbox" class="js-switch" checked />
                                        </li>
                                        <li>
                                            <span class="settings-option">Activity log</span>
                                            <input type="checkbox" class="js-switch" checked />
                                        </li>
                                        <li>
                                            <span class="settings-option">Automatic updates</span>
                                            <input type="checkbox" class="js-switch" />
                                        </li>
                                        <li>
                                            <span class="settings-option">Allow backups</span>
                                            <input type="checkbox" class="js-switch" />
                                        </li>
                                    </ul>
                                    <span class="settings-title">Account Settings</span>
                                    <ul class="sidebar-setting-list list-unstyled">
                                        <li>
                                            <span class="settings-option">Chat</span>
                                            <input type="checkbox" class="js-switch" checked />
                                        </li>
                                        <li>
                                            <span class="settings-option">Incognito mode</span>
                                            <input type="checkbox" class="js-switch" />
                                        </li>
                                        <li>
                                            <span class="settings-option">Public profile</span>
                                            <input type="checkbox" class="js-switch" />
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end main right sidebar -->

            <!-- start chat right sidebar -->
            <div class="page-right-sidebar" id="chat-right-sidebar">
                <div class="page-right-sidebar-inner">
                    <div class="right-sidebar-top">
                        <div class="chat-top-info">
                            <span class="chat-name">Noah</span>
                            <span class="chat-state">2h ago</span>
                        </div>
                        <a href="#!" class="right-sidebar-toggle chat-sidebar-close float-right" data-sidebar-id="chat-right-sidebar"><i class="icon-keyboard_arrow_right"></i></a>
                    </div>
                    <div class="right-sidebar-content">
                        <div class="right-sidebar-chat slimscroll">
                            <div class="chat-bubbles">
                                <div class="chat-start-date">02/03/2019 5:58PM</div>
                                <div class="chat-bubble them">
                                    <div class="chat-bubble-img-container">
                                        <img src="<?=base_url('img/crizal/avatars/chat06.jpg')?>" alt="" />
                                    </div>
                                    <div class="chat-bubble-text-container">
                                        <span class="chat-bubble-text">Hello</span>
                                    </div>
                                </div>
                                <div class="chat-bubble me">
                                    <div class="chat-bubble-text-container">
                                        <span class="chat-bubble-text">Hello!</span>
                                    </div>
                                </div>
                                <div class="chat-start-date">03/02/2019 5:18AM</div>
                                <div class="chat-bubble me">
                                    <div class="chat-bubble-text-container">
                                        <span class="chat-bubble-text">lorem</span>
                                    </div>
                                </div>
                                <div class="chat-bubble them">
                                    <div class="chat-bubble-img-container">
                                        <img src="<?=base_url('img/crizal/avatars/chat07.jpg')?>" alt="" />
                                    </div>
                                    <div class="chat-bubble-text-container">
                                        <span class="chat-bubble-text">ipsum dolor sit amet</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-write">
                            <form class="form-horizontal" action="javascript:void(0);">
                                <input type="text" class="form-control" placeholder="Say something">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end chat right sidebar -->

            <!-- end page right sidebar -->
            
        </div>
        <!-- end page content -->
    </div>
    <!-- end page container -->

    <!-- start scroll to top -->
    <a href="#!" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
    <!-- end scroll to top -->

    <!-- all js include start -->
    
    <!-- jQuery -->
    <script src="<?=base_url('js/crizal/plugins/jquery/jquery-3.1.0.min.js')?>"></script>

    <!-- popper -->
    <script src="<?=base_url('js/crizal/plugins/popper/js/popper.min.js')?>"></script>

    <!-- bootstrap -->
    <script src="<?=base_url('js/crizal/plugins/bootstrap/bootstrap.min.js')?>"></script>

    <!-- slimscroll -->
    <script src="<?=base_url('js/crizal/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>

    <!-- uniform -->
    <script src="<?=base_url('js/crizal/plugins/uniform/js/jquery.uniform.standalone.js')?>"></script>

    <!-- switchery -->
    <script src="<?=base_url('js/crizal/plugins/switchery/switchery.min.js')?>"></script>

    <!-- summernote -->
    <script src="<?=base_url('js/crizal/plugins/summernote-master/summernote.min.js')?>"></script>

    <!-- datepicker -->
    <script src="<?=base_url('js/crizal/plugins/bootstrap-datepicker/bootstrap-datepicker.js')?>"></script>

    <!-- colorpicker -->
    <script src="<?=base_url('js/crizal/plugins/bootstrap-colorpicker/bootstrap-colorpicker.js')?>"></script>

    <!-- tagsinput -->
    <script src="<?=base_url('js/crizal/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')?>"></script>

    <!-- clockpicker -->
    <script src="<?=base_url('js/crizal/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.js')?>"></script>

    <!-- form elements -->
    <script src="<?=base_url('js/crizal/pages/form-elements.js')?>"></script>

    <!-- custom scripts -->
    <script src="<?=base_url('js/crizal/main.js')?>"></script>

    <!-- all js include end -->

</body>

</html>