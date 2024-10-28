<div class="row">
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-body">
                <h4>Data Correction </h4>
                <table class="table table-bordered">
                    <tr>
                        <td style="text-align:center">
                            <strong>Change Scheme Status</strong><br />
                            <button class="bt btn-danger" onclick="change_scheme_status('<?php echo $scheme->scheme_id ?>')">Change Status</button>
                        </td>
                        <td> 



                       
    <style>
        /* Basic styles for the suggestions box */
        .autocomplete-suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background: white;
            z-index: 1000;
            width: calc(100% - 2px);
        }

        .suggestion {
            padding: 8px;
            cursor: pointer;
        }

        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>

    <div style="position: relative;">
        Scheme note here
        <input 
            class="form-control" 
            type="text" 
            onkeyup="showSuggestions(this.value, '<?php echo $scheme->scheme_id; ?>')" 
            value="<?php echo $scheme->scheme_note; ?>" 
            name="scheme_note" 
            id="scheme_note" 
            autocomplete="off" />
        <div id="suggestions" class="autocomplete-suggestions"></div>
    </div>
    <small id="note_save_response"></small>

    <script>
       
    const availableTags = [
        <?php 
            $query = "SELECT scheme_note FROM schemes WHERE scheme_note IS NOT NULL GROUP BY scheme_note";
            $schemeNotes = $this->db->query($query)->result();

            // Prepare an array to hold the notes
            $notesArray = [];

            foreach ($schemeNotes as $schemeNote) {
                if ($schemeNote->scheme_note != "") {
                    // Add each scheme note to the array
                    $notesArray[] = $schemeNote->scheme_note;
                }
            }

            // Convert the PHP array to a JSON array and output it
            echo implode(", ", array_map(function($note) {
                return json_encode($note);
            }, $notesArray));
        ?>
    ];



        function showSuggestions(value, schemeId) {
            add_scheme_note(schemeId);
            const suggestionsBox = document.getElementById('suggestions');
            suggestionsBox.innerHTML = ''; // Clear previous suggestions

            if (!value) return; // Return if input is empty

            const filteredTags = availableTags.filter(tag => 
                tag.toLowerCase().includes(value.toLowerCase())
            );

            filteredTags.forEach(tag => {
                const suggestionItem = document.createElement('div');
                suggestionItem.textContent = tag;
                suggestionItem.classList.add('suggestion');
                
                // Add click event for suggestion selection
                suggestionItem.onclick = () => {
                    document.getElementById('scheme_note').value = tag;
                    suggestionsBox.innerHTML = ''; // Clear suggestions after selection
                     // Call the function with schemeId
                };

                suggestionsBox.appendChild(suggestionItem);
                
            });
        }

        function add_scheme_note(schemeId) {
            // Your implementation to handle the scheme note update
            console.log("Scheme ID: " + schemeId);
            // Optionally handle saving the note here
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#scheme_note')) {
                document.getElementById('suggestions').innerHTML = '';
            }
        });
    </script>





                            <script>
                               
                                function add_scheme_note(scheme_id) {
                                var scheme_note = $('#scheme_note').val(); // Corrected jQuery method to get the value
                                    $.ajax({
                                        method: "POST",
                                        url: "<?php echo site_url(ADMIN_DIR . 'temp/add_scheme_note'); ?>",
                                        data: {
                                            scheme_note: scheme_note,
                                            scheme_id: scheme_id
                                        },
                                    })
                                    .done(function(response) {
                                        $('#note_save_response').css('visibility', 'hidden').html(response).css('visibility',
                                            'visible').hide().fadeIn('fast');

                                    });
                                }
                            </script>
                        </td>
                        <td>    
                            <div style="">
                    Search By Cheque No. of Payee Name or Scheme Name: (<?php echo $scheme->scheme_name ?>)  <br />
                    <input  type="text" value="<?php echo $scheme->scheme_name ?>" id="search" name="search"
                        style="width:500px" onkeydown="search()"  />
                    <button onclick="search()">Search</button>

                    

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
                </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="search_result"></div>
                    </td>
                </tr>
                </table>

                
                <div style="text-align:center">

                    <?php
                    $query = "SELECT s.*, d.district_name, cc.category FROM schemes as s 
                    INNER JOIN districts as d ON(d.district_id = s.district_id) 
                    INNER JOIN component_categories as cc ON(cc.component_category_id =  s.component_category_id)
                    WHERE scheme_name LIKE '%".$scheme->scheme_name."%'
                    AND scheme_id != '".$scheme->scheme_id."' 
                    AND scheme_id != '".$scheme->scheme_id."' 
                    AND s.district_id != '".$scheme->district_id."'
                    AND scheme_status !='Completed' ORDER BY scheme_name ASC";
                    $schemes = $this->db->query($query)->result();
                    if($schemes){  ?>
                    <h4>Other Schemes with Similar Names</h4>
                        <ul>
                            <?php foreach($schemes as $s){ ?>
                                <ol>
                                    <a href="<?php echo site_url(ADMIN_DIR.'water_user_associations/view_scheme_detail/'.$s->water_user_association_id.'/'.$s->scheme_id); ?>">    
                                   <?php echo $s->scheme_code; ?> -  <?php echo $s->scheme_name; ?> - <?php echo $s->category; ?> -  <?php echo $s->district_name; ?>
                                    </a>
                                </ol>
                            <?php } ?>
                        </ul>
                    <?php }else{ ?>
                       
                    <?php } ?>
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
search();
</script>