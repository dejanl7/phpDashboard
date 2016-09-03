<?php include("inc/header.php"); ?><!-- Include header -->
<?php
    if(!$session->session_status()){
        redirect("logout.php");
    }
?>
<?php 
    global $base;

    if( $user->active == 0 ){
        redirect('logout.php');
    }
?>
<?php       
    if($user->role == 'master_admin' ){
        redirect('logout.php');
    }
?>
    <link rel="stylesheet" href="css/plugins/datatables/jquery.dataTables.min.css">
</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
    
    <div class="wrapper" id='wrapper_user_pho1nebook' style="
        background: url(img/drive.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover; 
        ">

    <!-- INCLUDE ALL SEPARATED FILES -->
        <?php include("inc/top_menu.php");?>
        <?php include("inc/left_menu.php");?>

            <section class="row" id="headline-basic-info">
                <h1><span>Kontakti - preduzeća i fizička lica</span></h1>
            </section><!-- #headline-basic-info -->

            <section id="basic-info-main-nav">
                <?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
            </section><!-- #basic-info-main-nav -->
    
            <div class="container user-phonebook-content">
              <div class="row">
                <section class="col-sm-12">
                  <div class="col-sm-12 col-xs-12 command-phonebook">
                    <h3 class="text-center"><b>Područje Rada sa Kontakt Informacijama</b></h3>
                    <span>
                        Kontakt informacije možete uneti na dva načina. Prvi način obuhvata ručni unos kontakata preduzeća ili fizičkih lica putem forme za unos koja se nalazi ispod ovog teksta. Drugi način je izvršite pretragu preduzeća (gornji meni). Kada izaberete traženo preduzeće, potrebno je da na početnoj stranici tog preduzeća, a pored naziva istog, kliknete na dugme "Dodaj Kontakt Informacije". Na taj način kontakt informacije datog preduzeća unosite automatski u Vaš Imenik.
                    </span>
                    
                    <div id="show-new-contact-form" class="col-sm-12">
                        <button class="btn btn-warning">Ubacite Novi Kontakt</button>
                    </div>
                    <div id="insert-new-contact" class="col-sm-8 col-sm-offset-2 col-xs-12">
                        <form action="inc/pages/pages_insert_info.php" method="POST" id="add-phone-contact">
                            <div class="hidden">    
                                <label for="phonebook_contact_from_form">Naziv preduzeća ili fizičkog lica</label>
                                <input type="text" id="phonebook_contact_from_form"  class="form-control" name="phonebook_contact_from_form" value="phonebook_contact_from_form">
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_name">Naziv preduzeća ili fizičkog lica</label>
                                <input type="text" id="phonebook_name"  class="form-control" name="phonebook_name" placeholder="Ime" required>
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_phone">Telefon</label>
                                <input type="text" id="phonebook_phone"  class="form-control" name="phonebook_phone" placeholder="Telefon" required>
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_address">Adresa</label>
                                <input type="text" id="phonebook_address"  class="form-control" name="phonebook_address" placeholder="Adresa">
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_email">E-mail</label>
                                <input type="email" id="phonebook_email"  class="form-control" name="phonebook_email" placeholder="E-mail" required>
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_contactperson">Kontakt Osoba</label>
                                <input type="text" id="phonebook_contactperson"  class="form-control" name="phonebook_contactperson" placeholder="Kontakt Osoba">
                            </div>
                            <div class="phonebook-form-group">    
                                <label for="phonebook_contact_type">Tip Kontakta</label>
                                <select id="phonebook_contact_type" class='form-control' name='phonebook_contact_type' required>
                                    <option value=''>Izaberite opciju: </option>
                                    <option value='pravno_lice'>Preduzeće</option>
                                    <option value='fizicko_lice'>Fizičko Lice</option>
                                </select>
                            </div>
                            <div class="phonebook-form-group">    
                                <input type="submit" id="submit-phonebook"  class="btn accept-basic-info-changes" name="submit-phonebook" value="Dodaj Kontakt">
                            </div>
                        </form>
                    </div><!-- #insert-new-contact -->

                    <div id="phonebook-table" class="col-sm-12 col-xs-12">

                    <form action="inc/functions/delete.php" method="POST" id="phonebooks-select-form">
                      <div class="table-responsive">
                        <p><table id="unilink-contact-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naziv (Ime)<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>Telefon<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>Adresa<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>E-mail<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>Kontakt<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>Tip<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                                    <th>Opcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   $result = phonebook::show_phonebook_information();
                                    foreach( $result as $finder ):
                                ?>
                                        <tr>
                                            <td class="text-center phonebook_id >">
                                                <input name="phonebook_id[]" class="phonebook_id  <?php echo ( $finder->contact_type == 'pravno_lice' ? 'pravno_lice' : 'fizicko_lice') ?>" type="checkbox" value="<?php echo $finder->phonebook_id; ?>">
                                            </td>
                                            <td><?php echo $finder->phonebook_name; ?></td>
                                            <td><?php echo $finder->phonebook_phone; ?></td>
                                            <td><?php echo $finder->phonebook_address; ?></td>
                                            <td><?php echo $finder->phonebook_email; ?></td>
                                            <td><?php echo $finder->phonebook_contactperson; ?></td>
                                            <td><?php echo ($finder->contact_type == 'pravno_lice' ? '<b>Preduzeće</b>' : 'Fizičko Lice' );  ?></td>
                                            <td>
                                                <button class="delete-contact" data-id="<?php echo $finder->phonebook_id ?>"> Obriši </button> 
                                                <button class="edit-contact remodal-bg" data-remodal-target="remodal_update_phone_contact" data-id="<?php echo $finder->phonebook_id; ?>"> Uredi </button>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table></p>
                      </div>
                        <div id='options_container-phonebook' class='col-xs-5'>
                          <div class="col-sm-12 col-xs-12">
                            <label for="select-phonebook-type">Izaberite Opciju</label>
                            <select class='form-control pull-left' name='select-phonebook-type' id="select-phonebook-type">
                                <option value="">Izaberite Kontakte</option>
                                <option id="nothing" value='remove_marks'>Ništa &nbsp</option>
                                <option value='type_all'>Sve &nbsp</option>
                                <option value='type_read'>Preduzeća &nbsp</option>
                                <option value='type_unread'>Fizička Lica &nbsp&nbsp&nbsp</option>
                            </select>
                          </div>
                          <div class="col-sm-12 col-xs-12 datatables-delete-options">
                            <label for="select-phonebook-type">Obrišite</label>
                            <select class='form-control pull-left' name='delete_phonebook_contacts' id="delete_phonebook_contacts">
                                <option value=''>Izaberite opciju</option>
                                <option value='delete_phonebook_contact'>Obriši</option>
                            </select>
                          </div>
                          <div class='col-sm-12 col-xs-12 phonebook-options-submit'>   <br>      
                            <input type='submit' name="submit_phonebook_options" class='delete-contact' value='Primeni' />
                          </div>
                        </div><!-- .options-container-phonebook -->
                    </form>
                  </div><!-- #phonebook-table -->
                 </div><!-- .command-phonebook -->
                </section>
              </div><!-- .row -->
             </div><!-- .user-phonebook-content -->


            <div class="user-phonebook-footer">
                <?php include("inc/footer.php"); ?>
                <script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="js/plugins/datatables/dataTables.buttons.min.js"></script>
                <script src="js/plugins/datatables/pdfmake.min.js"></script>
                <script src="js/plugins/datatables/vfs_fonts.js"></script>
                <script src="js/plugins/datatables/buttons.html5.min.js"></script>
                <script src="js/plugins/datatables/buttons.print.min.js"></script>
                <script type="text/javascript">

                    $(document).ready(function(){
                        $('#unilink-contact-table').DataTable({
                            "order": [ 1, "asc" ],
                            "language": {
                                "url" : "js/datatables/serbian.json"
                            },  
                            
                            "lengthMenu": [[10, 25, 50, -1], [10, 15, 25, "50"]],
                            dom: 'lBfrtip',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4 ]
                                    }
                                },
                                'print'
                            ]
                        });

                        var table = $('#unilink-contact-table').DataTable();
                        $('#unilink-contact-table').on('page.dt', function() {
                            //var info = table.page.info();
                            //var page = info.page+1;
                           //alert('test');
                            $('.phonebook_id').each(function(){
                               this.checked = false;
                            });

                            selected_boxes('#select-phonebook-type', '.pravno_lice', '.fizicko_lice', '.phonebook_id')
                        });

                       
                    });
                </script>
            </div><!-- .user-phonebook-footer -->
    </div>
</body>
</html>