    <style>
        .div1 {
        width: 100px;
        height: 100px;
        padding: 10px;
        }
        #divv {
        width: 400px;
        height: 400px;
        padding: 10px;
        border: 1px solid #aaaaaa;
        }

    </style>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    
                    <div class="box-body">
                                    <form method="POST">

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Last Name: </label>
                                    <input type="text" class="form-control" id="lastname" placeholder="LAST NAME eg.(DELA CRUZ)">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">First Name: </label>
                                    <input type="text" class="form-control" id="firstname" placeholder="FIRST NAME AND SUFFIX eg.(JUAN SR./JR/III)">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Middle Initial: </label>
                                    <input type="text" class="form-control" id="mi" placeholder="M.I">
                                </div>
                            </div>                        
                        </div>

                        <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <span>Username: </span>
                                    <input type="text" class="form-control" id="username">
                                </div>
                            </div>                        
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span>Password: </span>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <span> Confirm Password: </span>
                                    <input type="password" class="form-control" id="confirmpassword">
                                </div>     
                            </div>
                           </div> 
                        <div class="row">
                           <div class="col-lg-4">  

                               <div class="form-group">
                                    <span>Province: </span>
                                        <select class="form-control province" id="province" name="province">
                                            <option value="">Please Choose...</option>
                                        <?php
                                        foreach ($provinces as $province) {

                                            ?>

                                            <option 
                                                value="<?php echo $province->provCode; ?>"

                                            ><?php echo $province->provDesc; ?>                                                
                                            </option>
                                            <?php } ?>
                                        </select>
                                </div> 
                            </div>
                            <div class="col-lg-4">     
                                <div class="form-group">
                                    <span>City/Municipality: </span>
                                    <select class="form-control city" id="city" name="city">
                                          <option>Please Choose...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">     
                                <div class="form-group">
                                    <span>Barangay: </span>
                                    <input type="text" class="form-control" id="barangay">
                                </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                <span>Number / Block / Lot: </span>
                                <input type="text" class="form-control" id="noblocklot">
                                </div>
                            </div>     
                            <div class="col-lg-4">
                                <div class="form-group">
                                <span>Street </span>
                                <input type="text" class="form-control" id="street">
                                </div> 
                            </div> 
                            <div class="col-lg-4">
                                <div class="form-group">
                                <span>Subdivision / Village / Building Name: </span>
                                <input type="text" class="form-control" id="subvilbuil">
                                </div> 
                            </div>                                                
                        </div>
                            
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <span>Contact Details: </span>
                                <input type="text" class="form-control" id="contactdetails">
                                </div>      
                            </div>
                            <div class='col-lg-6'>
                                <div class="form-group">
                                    <span>Position: </span>
                                    <input type="text" class="form-control" id="position">
                                </div>                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <span>Department: </span>
                                <input type="text" class="form-control" id="department">
                                </div>  
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <span>Date Hired: </span>
                                <input type="date" class="form-control" id="date_hired">
                                </div>
                            </div>
                        </div>

      
      
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="addMemberButton" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

    </section>

<script type="text/javascript">
        $(document).ready(function(){
                         
            //call function get data edit
            get_data_edit();

            // var province = $('#province').val();

            // alert(province); 

            $('#province').change(function(){ 
                var province =$(this).val();
                var city = "<?php echo $city;?>";

                      $.ajax({
                    url: '<?php echo base_url(); ?>adduser/get_cities',
                    method : "POST",
                    data : {province: province},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        $('[name="city"]').empty();

                        $.each(data, function(key, value) {
                           
                            if(city==value.citymunCode){
                                // alert('equals');
                                $('[name="city"]').append('<option value="'+ value.citymunCode +'" selected>'+ value.citymunDesc +'</option>').trigger('change');
                            }else{
                                // alert('not equals');
                                $('[name="city"]').append('<option value="'+ value.citymunCode +'">'+ value.citymunDesc +'</option>');
                            }
                        });

                    }
                });
                return false;
            }); 

             $('#city').change(function(){ 
                 var city =$(this).val();
                 // var city = "<?php echo $city;?>";

                 $.ajax({
                     url: '<?php echo base_url(); ?>adduser/get_brgy',
                     method : "POST",
                     data : {city: city},
                     async : true,
                     dataType : 'json',
                     success: function(data){

                         $('#barangay').empty();

                         $.each(data, function(key, value) {
                             if(city==value.citymunCode){
                                 $('#barangay').append('<option value="'+ value.brgyCode +'" selected>'+ value.brgyDesc +'</option>').trigger('change');
                             }else{
                                 $('#barangay').append('<option value="'+ value.brgyCode +'">'+ value.brgyDesc +'</option>');
                             }
                         });

                     }
                 });
                 return false;
             }); 



            //load data for edit
            function get_data_edit(){
                var id = $('#id').val();

                // alert (id);
                $.ajax({
                    method : "POST",
                    data :{id :id},
                    async : true,
                    dataType : 'json',
                    url: '<?php echo base_url(); ?>adduser/get_user_edit',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('#lastname').val(data[i].lastname);
                            $('#firstname').val(data[i].firstname);
                            $('#mi').val(data[i].mi);
                            $('#username').val(data[i].username);
                            $('#password').val(data[i].password);
                            $('[name="province"]')
                                .val(data[i].provCode)
                                .trigger('change');
                            $('[name="city"]')
                                .val(data[i].citymunCode)
                                .trigger('change');
                            $('[name="barangay"]')
                                .val(data[i].barangay)
                                .trigger('change');
                            $('#noblocklot').val(data[i].noblocklot);
                            $('#street').val(data[i].street);
                            $('#subvilbuil').val(data[i].subvilbuil);
                            $('#contactdetails').val(data[i].contact);
                            $('#position').val(data[i].position);
                            $('#department').val(data[i].department);
                            $('#date_hired').val(data[i].date_hired);
                            $('#province1').val(data[i].province);
                            $('#barangay').val(data[i].barangay);
                            // $('[name="product_price"]').val(data[i].product_price);
                        });
                    }

                });
            }
            
        });
    </script>
