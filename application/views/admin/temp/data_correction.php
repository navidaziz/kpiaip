<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">
                <h4>Data Correction </h4>
                <button onclick="change_scheme_status('<?php echo $scheme->scheme_id ?>')">Change
                    Status</button>


                <div style="text-align: right; margin-top:-30px; margin-bottom:5px">
                    Search By Cheque No. of Payee Name or Scheme Name: (<?php echo $scheme->scheme_name ?>) <input
                        type="text" value="<?php echo $scheme->scheme_name ?>" id="search" name="search"
                        style="width:300px" />
                    <button onclick="search()">Search</button>

                    <div id="search_result"></div>

                    <script>
                    function search() {
                        var search = $('#search').val();
                        $.ajax({
                                method: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . 'temp/search_cheques'); ?>",
                                data: {
                                    search: search,
                                    scheme_id: <?php echo $scheme->scheme_id ?>
                                },
                            })
                            .done(function(response) {
                                $('#search_result').css('visibility', 'hidden').html(response).css('visibility',
                                    'visible').hide().fadeIn('fast');

                            });


                    }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function change_scheme_status(scheme_id) {
    $.ajax({
            method: "POST",
            url: "<?php echo site_url(ADMIN_DIR . 'water_user_associations/change_scheme_status'); ?>",
            data: {
                scheme_id: scheme_id,
                water_user_association_id: <?php echo $scheme->water_user_association_id; ?>,
            },
        })
        .done(function(respose) {
            $('#modal').modal('show');
            $('#modal_title').html('Change Scheme Status');
            $('#modal_body').html(respose);
        });
}
</script>