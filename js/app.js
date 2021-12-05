$(document).ready(function(){
    let video = document.querySelector("#video");
    studentCompany = $('#student_company').val();


    loadPage();
    id = $('#user_id').val();
    user_id = $('#user_id').val();
    /*Authentication Page JS  */
    $('#btn_Login').click(function(){
        username = $('#username').val();
        password =$('#password').val();
        api = 'login';

        if(username == ''){
            $('#error_username').html('Username is required.');
            $('#username').focus();
        }else{
            if(password == ''){
                $('#error_username').html('');
                $('#password').focus();
                $('#error_password').html('Password is required.');
            }else{
                $.ajax({
                    url:'api/api.php',
                    type:'POST',
                    cache:false,
                    data:{
                       api:api,
                       username:username,
                       password:password
                    },
                    success:function(data){
                       if(data == 0){
                            $('#username').val('');
                            $('#password').val('');
                            $('#error_username').html('');
                            $('#error').css({
                               'padding':'4px 5px',
                               'border-radius':'5px',
                               'font-size':'12px'
                            });
                            $('#error').html('Invalid Credentials');
                            $('#username').focus();
                       }else if(data == 1){
                            $('#username').val('');
                            $('#password').val('');
                            $('#error_username').html('');
                            window.location = 'index.php';
                       }
                       else if(data == 2){
                            $('#modal_Login').modal({
                                backdrop: 'static',
                                keyboard: false,            
                            });
                            $('#btnLoginAsStudent').click(function(){
                                window.location = 'index.php';
                            })
                       }
                    }
                })
            }
        }
       
    })
    $('#btn_Register').click(function(){
        stud_id = $('#stud_id').val();
        stud_name = $('#stud_name').val();
        stud_dprtmnt = $('#stud_department').val();
        stud_section = $('#stud_section').val();
        stud_email = $('#stud_email').val();
        stud_pass = $('#stud_pass').val();
        api = 'registerStudent';

        if(stud_id == ''){
            $('#error_studID').html('Student ID is required.');
            $('#stud_id').focus();
        }else{
            if(stud_name == ''){
                $('#error_studName').html('Name is required.');
                $('#error_studID').html('');
                $('#stud_name').focus();
            }else{
                if(stud_dprtmnt == ''){
                    $('#error_studName').html('');
                    $('#error_studID').html('');
                    $('#error_studDepartment').html('Department is required.');
                    $('#stud_department').focus();
                }else{
                    if(stud_section == ''){
                        $('#error_studName').html('');
                        $('#error_studID').html('');
                        $('#error_studDepartment').html('');
                        $('#error_studSection').html('Section is required.');
                        $('#stud_section').focus();
                    }else{
                        if(stud_email == ''){
                            $('#error_studName').html('');
                            $('#error_studID').html('');
                            $('#error_studDepartment').html('');
                            $('#error_studSection').html('');
                            $('#error_studEmail').html('Email is required.');
                            $('#stud_email').focus();
                        }else{
                            if(stud_pass == ''){
                                $('#error_studName').html('');
                                $('#error_studID').html('');
                                $('#error_studDepartment').html('');
                                $('#error_studSection').html('');
                                $('#error_studEmail').html('');
                                $('#error_studPass').html('Password is required.');
                                $('#stud_pass').focus();
                            }else{
                                $.ajax({
                                    url:'api/api.php',
                                    type:'POST',
                                    cache:false,
                                    data:{
                                        api:api,
                                        stud_id:stud_id,
                                        stud_name:stud_name,
                                        stud_dprtmnt:stud_dprtmnt,
                                        stud_section:stud_section,
                                        stud_email:stud_email,
                                        stud_pass:stud_pass
                                    },
                                    success: function(data){
                                        if(data == 0){
                                            $('.messageBox').addClass('show');
                                            $('.messageBox').css({
                                                'background-color':'#e63d3d',
                                            })
                                            $('#message').html('An error occured on inserting data.')
                                             setTimeout(function(){
                                                $('#message').html('')
                                                $('.messageBox').removeClass('show')
                                              },4500)
                                        }else if(data == 1){                      
                                            $('#sign_in').addClass('selected')
                                            $('.register_form').removeClass('slide');
                                            $('#register').removeClass('selected')
                                            $('#stud_id').val('');
                                            $('#stud_name').val('');
                                            $('#stud_department').val('');
                                            $('#stud_section').val('');
                                            $('#stud_email').val('');
                                            $('#stud_pass').val('');
                                            alert('Student Successfully Added');
                                        }      
                                    }
                                })
                            }
                        }
                    }
                }
            }
        }
    })

    $('#username').focus();
    $('#sign_in').click(function(){
        $('#username').focus();
       $('#register').removeClass('selected')
       $('#sign_in').addClass('selected')
       $('.register_form').removeClass('slide');
       $('.student_sign_in').removeClass('slide');
       $('#stud_id').val('');
       $('#stud_name').val('');
       $('#stud_department').val('');
       $('#stud_section').val('');
       $('#stud_email').val('');
       $('#stud_pass').val('');
       $('#error_studName').html('');
       $('#error_studID').html('');
       $('#error_studDepartment').html('');
       $('#error_studSection').html('');
       $('#error_studEmail').html('');
       $('#error_studPass').html('');
    })
    $('#register').click(function(){
        $('#register').addClass('selected')
        $('#sign_in').removeClass('selected')
        $('.register_form').addClass('slide');
        $('.student_sign_in').removeClass('slide');
        $('#stud_id').focus();
        $('#username').val('');
        $('#password').val('');
        $('#error_username').html('');
        $('#error_password').html('');
    })
    $('#btn_Student').click(function(){
        $('#sign_in').removeClass('selected')
        $('.register_form').removeClass('slide');
        $('.student_sign_in').addClass('slide');
        $('#error_username').html('');
        $('#error_password').html('');   
    })
    
    /* Admin Page JS */

    $('#btn_Personnel').click(function(){
        Personnel();
        $('.messageBox').removeClass('show');
    })
    $('#btn_Masterlist').click(function(){
        $('.messageBox').removeClass('show');
        $.ajax({
            url:'admin/masterlist.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchStudents();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $('#btn_AdminAccount').click(function(){
        $('.messageBox').removeClass('show');
        $.ajax({
            url:'admin/admin_account.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })

    $(document).on('click', '#btn_savePersonnel', function(){
        testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        fullname =$('#fullname').val();
        department =$('#department').val();
        personnel_username =$('#personnel_username').val();
        personnel_pass =$('#personnel_pass').val();
        api = 'savePersonnel';

        if(fullname == ''){
            $('#error1').html('Name is required.');
            $('#fullname').focus();
        }else{
            if(department == ''){
                $('#error2').html('Department is required.');
                $('#error1').html('');
                $('#department').focus();
            }else{
                if(personnel_username == ''){
                    $('#error3').html('Email is required.');
                    $('#error1').html('');
                    $('#error2').html('');
                    $('#personnel_username').focus();
                }else{
                    if(personnel_pass == ''){
                        $('#error4').html('Password is required.');
                        $('#error1').html('');
                        $('#error2').html('');
                        $('#error3').html('');
                        $('#personnel_pass').focus();
                    }else{
                        $.ajax({
                            url:'api/api.php',
                            method:'POST',
                            cache:false,
                            data:{
                                api:api,
                                fullname:fullname,
                                department:department,
                                personnel_username:personnel_username,
                                personnel_pass:personnel_pass,
                            },
                            success:function(data){
                                if(data == 0){
                                    $('.messageBox').addClass('show');
                                    $('.messageBox').css({
                                        'background-color':'#e63d3d',
                                    })
                                    $('#message').html('An error occured on inserting data.')
                                    setTimeout(function(){
                                        $('#message').html('')
                                        $('.messageBox').removeClass('show')
                                    },2000)
                                }else if(data == 1){                      
                                    $('.messageBox').addClass('show');
                                    $('.messageBox').css({
                                        'background-color':'#1760ce',
                                    })
                                    $('#message').html('Personnel Successfully Added.')
                                    $('#fullname').val('');
                                    $('#department').val('');
                                    $('#personnel_username').val('');
                                    $('#personnel_pass').val('');
                                    fetchPersonnelData();
                                    setTimeout(function(){
                                        $('#message').html('')
                                        $('.messageBox').removeClass('show')
                                    },2000)
                                }      
                            }
                        })
                    }
                }
            }
        }
    })
    $(document).on('click', '#btn_UpdtPersonnel', function(){
        updt_id = $('#updt_id').val();
        updt_department =$('#updt_department').val();
        updt_status =$('#updt_status').val();
        api = 'updatePersonnel';

        if(updt_department == ''){
            $('#updt_error1').html('Department is required.');
            $('#updt_department').focus();
        }else{
            if(updt_status == ''){
                $('#updt_error2').html('Status is required.');
                $('#updt_error1').html('');
                $('#updt_status').focus();
            }else{
                $.ajax({
                    url:'api/api.php',
                    method:'POST',
                    cache:false,
                    data:{
                        api:api,
                        updt_id:updt_id,
                        updt_department:updt_department,
                        updt_status:updt_status,
                    },
                    success:function(data){
                        if(data == 0){
                            $('.messageBox').addClass('show');
                            $('.messageBox').css({
                                'background-color':'#e63d3d',
                            })
                            $('#message').html('An error occured on updating data.')
                            setTimeout(function(){
                                $('#message').html('')
                                $('.messageBox').removeClass('show')
                            },2000)
                        }else if(data == 1){                      
                            $('.messageBox').addClass('show');
                            $('.messageBox').css({
                                'background-color':'#1760ce',
                            })
                            $('#message').html('Personnel Successfully Updated.')
                            $('#updt_department').val('');
                            $('#updt_status').val('');
                            $('#updt_error2').html('');
                            $('#updt_error1').html('');
                            $('#modal_updtPersonel').modal('hide');
                            fetchPersonnelData();
                            setTimeout(function(){
                                $('#message').html('')
                                $('.messageBox').removeClass('show')
                            },2000)
                        }      
                    }
                })
            }
        }
    })

    $(document).on('click', '#btn_DeletePersonnel', function(){
        api = 'deletePersonnel';
        delete_id = $('#delete_id').val();
        $.ajax({
            url:'api/api.php',
            method:'POST',
            cache:false,
            data:{
                api:api,
                delete_id:delete_id,
            },
            success:function(data){
                if(data == 0){
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#e63d3d',
                    })
                    $('#message').html('An error occured on deleting data.')
                    setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }else if(data == 1){                      
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#1760ce',
                    })
                    $('#message').html('Personnel Successfully Deleted.')
                    $('#delete_id').val('');
                    $('#modal_deletePersonel').modal('hide');
                    fetchPersonnelData();
                    setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }      
            }
        })
    })

    $(document).on('change','#filterBy_department',function(){
        selected_item = $('#filterBy_department option:selected').val();
        api = 'fetchPersonnelByDepartment';
        $.ajax({
            url:"api/api.php",
            type:'POST',
            cache:false,
            data:{
                api: api,
                selected_item: selected_item
            },
            success: function(data){
                if(data != ''){
                    $('.tbl_PersonnelData').html(data);
                }else{
                    $('.tbl_PersonnelData').html('<span class="text-danger">No Data to be Fetch.</span>');
                }
            }
        })
    })
    $(document).on('change','.filter',function(){
        selected_item = $('.filter option:selected').val();
        api = 'fetchStudentByDepartment';
        $.ajax({
            url:"api/api.php",
            type:'POST',
            cache:false,
            data:{
                api: api,
                selected_item: selected_item
            },
            success: function(data){
                if(data != ''){
                    $('.tbl_StudentsData').html(data);
                }else{
                    $('.tbl_StudentsData').html('<span class="text-danger">No Data to be Fetch.</span>');
                }
            }
        })
    })
    $(document).on('click', '#btn_UpdtStudent', function(){
        updt_id = $('#updt_studId').val();
        updt_status =$('#updt_studStatus').val();
        api = 'updateStudent';

        if(updt_status == ''){
            $('#updt_stud_error').html('Status is required.');
            $('#updt_studStatus').focus();
        }else{
            $.ajax({
                url:'api/api.php',
                method:'POST',
                cache:false,
                data:{
                    api:api,
                    updt_id:updt_id,
                    updt_status:updt_status,
                },
                success:function(data){
                    if(data == 0){
                        $('.messageBox').addClass('show');
                        $('.messageBox').css({
                            'background-color':'#e63d3d',
                        })
                        $('#message').html('An error occured on updating data.')
                        setTimeout(function(){
                            $('#message').html('')
                            $('.messageBox').removeClass('show')
                        },2000)
                    }else if(data == 1){                      
                        $('.messageBox').addClass('show');
                        $('.messageBox').css({
                            'background-color':'#1760ce',
                        })
                        $('#message').html('Student Successfully Updated.')
                        $('#updt_stud_error').html('');
                        $('#modal_updtStudent').modal('hide');
                        fetchStudents();
                        setTimeout(function(){
                            $('#message').html('')
                            $('.messageBox').removeClass('show')
                        },2000)
                    }      
                }
            })
        }
    })
    $(document).on('click', '#btn_saveChangesAdmin', function(){
       uname = $('#admin_uname').val();
       pass = $('#admin_pass').val();
       admin_name = $('#admin_name').val();
       address = $('#admin_address').val();
       admin_age = $('#admin_age').val();
       job = $('#admin_job').val();
       api = 'updateAdmin';
       let property = $('#my_profile')[0].files;
       let form_data = new FormData();
       
       if(uname == ''){
         $('#admin_uname').css('border','1px solid #fc6262');
         $('#admin_uname').focus();
       }else{
         if(pass == ''){
            $('#admin_pass').css('border','1px solid #fc6262');
            $('#admin_uname').css('border','1px solid #2986d3');
            $('#admin_pass').focus();
         }else{
            if(admin_name == ''){
                $('#admin_name').css('border','1px solid #fc6262');
                $('#admin_uname').css('border','1px solid #2986d3');
                $('#admin_pass').css('border','1px solid #2986d3');
                $('#admin_name').focus();
             }else{
                if(address == ''){
                    $('#admin_address').css('border','1px solid #fc6262');
                    $('#admin_uname').css('border','1px solid #2986d3');
                    $('#admin_pass').css('border','1px solid #2986d3');
                    $('#admin_name').css('border','1px solid #2986d3');
                    $('#admin_address').focus();
                 }else{
                    if(admin_age == ''){
                        $('#admin_age').css('border','1px solid #fc6262');
                        $('#admin_uname').css('border','1px solid #2986d3');
                        $('#admin_pass').css('border','1px solid #2986d3');
                        $('#admin_name').css('border','1px solid #2986d3');
                        $('#admin_address').css('border','1px solid #2986d3');
                        $('#admin_age').focus();
                     }else{
                        if(job == ''){
                            $('#admin_job').css('border','1px solid #fc6262');
                            $('#admin_uname').css('border','1px solid #2986d3');
                            $('#admin_pass').css('border','1px solid #2986d3');
                            $('#admin_name').css('border','1px solid #2986d3');
                            $('#admin_address').css('border','1px solid #2986d3');
                            $('#admin_age').css('border','1px solid #2986d3');
                            $('#admin_job').focus();
                         }else{
                              form_data.append('uname', uname);
                              form_data.append('pass', pass);
                              form_data.append('admin_name', admin_name);
                              form_data.append('address', address);
                              form_data.append('admin_age', admin_age);
                              form_data.append('job', job);
                              form_data.append('profile', property[0]);
                              form_data.append('api', api);
                              form_data.append('id', id);
                             $.ajax({
                                url:'api/api.php',
                                type:'POST',
                                cache:false,
                                data:form_data,
                                processData:false,
                                contentType: false,
                                success:function(data){
                                    if(data == 0){
                                        $('.messageBox').addClass('show');
                                        $('.messageBox').css({
                                            'background-color':'#e63d3d',
                                        })
                                        $('#message').html('An error occured on updating data.')
                                        setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                    }else if(data == 1){                      
                                        $('.messageBox').addClass('show');
                                        $('.messageBox').css({
                                            'background-color':'#1760ce',
                                        })
                                        $('#message').html('Account Successfully Updated.')
                                        setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                    }      
                                }
                             })
                         }
                     }
                 }
             }
         }
       }
    })
    
    
// //******************************************************************************************* */

//     /* OJT Personnel Page JS */
    $('#btn_OJT_Supervisor').click(function(){
        Supervisors();
        $('.messageBox').removeClass('show');
    })
    $('#btn_OJT_Assignment').click(function(){
        $.ajax({
            url:'personnel/students.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
                fetchStudentDetails();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $('#btn_OJT_Journals').click(function(){
        $.ajax({
            url:'personnel/ojt_journals.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $('#btn_OJT_Coordinator_manageAccount').click(function(){
        $.ajax({
            url:'personnel/personnel_account.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_OJT_Announcement', function(){
        $.ajax({
            url:'personnel/add_announcement.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchAnnouncement();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $('#btn_OJT_Coordinator_Chat').click(function(){
        $.ajax({
            url:'personnel/chat.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_saveSupervisor', function(){
        department_type = $('#department_type').val();
        supervisor = $('#supervisor').val();
        company = $('#company').val();
        locations = $('#location').val();
        supervisor_uname = $('#supervisor_uname').val();
        supervisor_pass = $('#supervisor_pass').val();
        api = 'saveSupervisor';

        if(supervisor == ''){
            $('#error1_s').html("Supervisor's name is required.");
            $('#supervisor').focus();
        }else{
            if(company == ''){
                $('#error2_s').html('Company is required.');
                $('#error1_s').html('');
                $('#company').focus();
            }else{
                if(locations == ''){
                    $('#error3_s').html('Location is required.');
                    $('#error1_s').html('');
                    $('#error2_s').html('');
                    $('#location').focus();
                }else{
                    if(supervisor_uname == ''){
                        $('#error4_s').html('Email is required.');
                        $('#error1_s').html('');
                        $('#error2_s').html('');
                        $('#error3_s').html('');
                        $('#supervisor_uname').focus();
                    }else{
                        if(supervisor_pass == ''){
                            $('#error5_s').html('Password is required.');
                            $('#error1_s').html('');
                            $('#error2_s').html('');
                            $('#error3_s').html('');
                            $('#error4_s').html('');
                            $('#supervisor_pass').focus();
                        }else{
                            $.ajax({
                                url:'api/api.php',
                                method:'POST',
                                cache:false,
                                data:{
                                    api:api,
                                    id:id,
                                    supervisor:supervisor,
                                    department_type:department_type,
                                    company:company,
                                    locations:locations,
                                    supervisor_uname:supervisor_uname,
                                    supervisor_pass:supervisor_pass
                                },
                                success:function(data){
                                    if(data == 0){
                                        $('.messageBox').addClass('show');
                                        $('.messageBox').css({
                                            'background-color':'#e63d3d',
                                        })
                                        $('#message').html('An error occured on inserting data.')
                                        setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                    }else if(data == 1){                      
                                        $('.messageBox').addClass('show');
                                        $('.messageBox').css({
                                            'background-color':'#1760ce',
                                        })
                                        $('#message').html('Supervisor Successfully Added.')
                                        $('#supervisor').val('');
                                        $('#company').val('');
                                        $('#location').val('');
                                        $('#supervisor_uname').val('');
                                        $('#supervisor_pass').val('');
                                        $('#error1_s').html('');
                                        $('#error2_s').html('');
                                        $('#error3_s').html('');
                                        $('#error4_s').html('');
                                        $('#error5_s').html('');
                                        fetchSupervisorData();
                                        setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                    }      
                                }
                            })
                        }
                    }
                }
            }
        }

    })

    $(document).on('click', '#btn_DeleteSupervisor', function(){
        delete_id = $('#delete_supervisor_id').val();
        api = 'deleteSupervisor';

        $.ajax({
            url:'api/api.php',
            method:'POST',
            cache:false,
            data:{
                api:api,
                delete_id:delete_id,
            },
            success:function(data){
                if(data == 0){
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#e63d3d',
                    })
                    $('#message').html('An error occured on deleting data.')
                    setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }else if(data == 1){                      
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#1760ce',
                    })
                    $('#message').html('Supervisor Successfully Deleted.')
                    $('#delete_id').val('');
                    $('#modal_deleteSupervisor').modal('hide');
                    fetchSupervisorData();
                    setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }      
            }
        })
    })

    $(document).on('change','.filterByAssignment',function(){
        selected_item = $('.filterByAssignment option:selected').val();
        api = 'fetchStudentByCompany';
        $.ajax({
            url:"api/api.php",
            type:'POST',
            cache:false,
            data:{
                api: api,
                selected_item: selected_item
            },
            success: function(data){
                if(data != ''){
                    $('.tbl_Students_Details').html(data);
                }else{
                    $('.tbl_Students_Details').html('<span class="text-danger">No Data to be Fetch.</span>');
                }
            }
        })
    })
    $(document).on('click', '#btn_UpdtOJTStudent', function(){
        updt_id = $('#updt_id1').val();
        updt_location = $('#updt_OjtstudentLocation').val();
        updt_company = $('#updt_OjtstudentCompany').val();
        api = 'updateOjtStudent';

        if(updt_company == ''){
            $('#updt_Ojterror').html('Company is required.');
            $('#updt_OjtstudentCompany').focus();
        }else{
            $.ajax({
                url:'api/api.php',
                type:'POST',
                cache:false,
                data:{
                    api:api,
                    updt_id,updt_id,
                    updt_location:updt_location,
                    updt_company:updt_company
                },
                success: function(data){
                    if(data == 0){
                        $('.messageBox').addClass('show');
                        $('.messageBox').css({
                            'background-color':'#e63d3d',
                        })
                        $('#message').html('An error occured on updating data.')
                        setTimeout(function(){
                            $('#message').html('')
                            $('.messageBox').removeClass('show')
                        },2000)
                    }else if(data == 1){                      
                        $('.messageBox').addClass('show');
                        $('.messageBox').css({
                            'background-color':'#1760ce',
                        })
                        $('#message').html('Student Successfully Updated.')
                        $('#modal_updtOJTStudent').modal('hide');
                        $('#updt_stud_error').html('');
                        fetchStudentDetails();
                        setTimeout(function(){
                            $('#message').html('')
                            $('.messageBox').removeClass('show')
                        },2000)
                    }      
                }
            })
        }
    })
    $(document).on('change', '#updt_OjtstudentLocation', function(){
        selected_location = $('#updt_OjtstudentLocation option:selected').val();
        api = 'getCompany';
        $.ajax({
            url:"api/api.php",
            type:'POST',
            cache:false,
            data:{
                api: api,
                selected_location: selected_location
            },
            success: function(data){
              $('#updt_OjtstudentCompany').html(data);
            }
        })
    })
    $(document).on('click', '#btn_saveAnnouncement', function(){
        title = $('#title').val();
        description = $('#description').val();
        company = $('#company_detail').val();
        api = 'saveAnnouncement';

        if(title == ''){
            $('#error_title').html('Title is required.');
            $('#title').focus();
        }else{
            if(description == ''){
                $('#error_title').html('');
                $('#error_desc').html('Description is required.');
                $('#description').focus();
            }else{
                if(company == ''){
                    $('#error_title').html('');
                    $('#error_desc').html('');
                    $('#error_company').html('Copmany is required.');
                    $('#company_detail').focus();
                }else{
                    $.ajax({
                        url:'api/api.php',
                        type:'POST',
                        cache:false,
                        data:{
                          id:id,
                          api:api,
                          title:title,
                          description:description,
                          company:company
                        },
                        success:function(data){
                            if(data == 0){
                                $('.messageBox').addClass('show');
                                $('.messageBox').css({
                                    'background-color':'#e63d3d',
                                })
                                $('#message').html('An error occured on inserting data.')
                                setTimeout(function(){
                                    $('#message').html('')
                                    $('.messageBox').removeClass('show')
                                },2000)
                            }else if(data == 1){                      
                                $('.messageBox').addClass('show');
                                $('.messageBox').css({
                                    'background-color':'#1760ce',
                                })
                                 $('#description').val('');
                                 $('#title').val('');
                                 $('#company_detail').val('');
                                 $('#error_title').html('');
                                 $('#error2_desc').html('');
                                 $('#error3_company').html('');
                                 $('#message').html('Announcement Successfully Added.')
                                 fetchAnnouncement();
                                 setTimeout(function(){
                                    $('#message').html('')
                                    $('.messageBox').removeClass('show')
                                },2000)
                            }      
                        }
                    })
                }
            }
        }
    })
    $(document).on('click', '#btn_updtAnnouncement', function(){
        updt_announcementId = $('#updt_announcementId').val();
        updt_title = $('#updt_title').val();
        updt_description = $('#updt_description').val();
        updt_company = $('#updt_company_detail').val();
        api = 'updateAnnouncement';

        if(updt_title == ''){
            $('#updt_error_title').html('Title is required.');
            $('#updt_title').focus();
        }else{
            if(updt_description == ''){
                $('#updt_rror_title').html('');
                $('#updt_error_desc').html('Description is required.');
                $('#updt_description').focus();
            }else{
                if(updt_company == ''){
                    $('#updt_error_title').html('');
                    $('#updt_error_desc').html('');
                    $('#updt_error_company').html('Copmany is required.');
                    $('#updt_company_detail').focus();
                }else{
                    $.ajax({
                        url:'api/api.php',
                        type:'POST',
                        cache:false,
                        data:{
                          api:api,
                          updt_announcementId:updt_announcementId,
                          updt_title:updt_title,
                          updt_description:updt_description,
                          updt_company:updt_company
                        },
                        success:function(data){
                            if(data == 0){
                                $('.messageBox').addClass('show');
                                $('.messageBox').css({
                                    'background-color':'#e63d3d',
                                })
                                $('#message').html('An error occured on updating data.')
                                setTimeout(function(){
                                    $('#message').html('')
                                    $('.messageBox').removeClass('show')
                                },2000)
                            }else if(data == 1){                      
                                $('.messageBox').addClass('show');
                                $('.messageBox').css({
                                    'background-color':'#1760ce',
                                })
                                 $('#description').val('');
                                 $('#title').val('');
                                 $('#company_detail').val('');
                                 $('#error_title').html('');
                                 $('#error2_desc').html('');
                                 $('#error3_company').html('');
                                 $('#message').html('Announcement Successfully Updated.');
                                 $('#modal_updtAnnouncement').modal('hide');
                                 fetchAnnouncement();
                                 setTimeout(function(){
                                    $('#message').html('')
                                    $('.messageBox').removeClass('show')
                                },2000)
                            }      
                        }
                    })
                }
            }
        }
    })
    $(document).on('click', '#btn_DeleteAnnouncement', function(){
        id = $('#delete_announcementId').val();
        api = 'deleteAnnouncement';

        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
              id:id,
              api:api,
            },
            success:function(data){
                if(data == 0){
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#e63d3d',
                    })
                    $('#message').html('An error occured on deleting data.')
                    setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }else if(data == 1){                      
                    $('.messageBox').addClass('show');
                    $('.messageBox').css({
                        'background-color':'#1760ce',
                    })
                     $('#message').html('Announcement Successfully Deleted.');
                     $('#modal_deleteAnnouncement').modal('hide');
                     fetchAnnouncement();
                     setTimeout(function(){
                        $('#message').html('')
                        $('.messageBox').removeClass('show')
                    },2000)
                }      
            }
        })
    })
    $(document).on('click', '#btn_saveChangesPersonnel', function(){
        personnel_uname = $('#admin_uname').val();
        personnel_pass = $('#admin_pass').val();
        personnel_name = $('#admin_name').val();
        personnel_address = $('#admin_address').val();
        personnel_age = $('#admin_age').val();
        personnel_job = $('#admin_job').val();
        api = 'updateAccountPersonnel';
        let property = $('#my_profile')[0].files;
        let form_data = new FormData();
        
        if(personnel_uname == ''){
          $('#admin_uname').css('border','1px solid #fc6262');
          $('#admin_uname').focus();
        }else{
          if(personnel_pass == ''){
             $('#admin_pass').css('border','1px solid #fc6262');
             $('#admin_uname').css('border','1px solid #2986d3');
             $('#admin_pass').focus();
          }else{
             if(personnel_name == ''){
                 $('#admin_name').css('border','1px solid #fc6262');
                 $('#admin_uname').css('border','1px solid #2986d3');
                 $('#admin_pass').css('border','1px solid #2986d3');
                 $('#admin_name').focus();
              }else{
                 if(personnel_address == ''){
                     $('#admin_address').css('border','1px solid #fc6262');
                     $('#admin_uname').css('border','1px solid #2986d3');
                     $('#admin_pass').css('border','1px solid #2986d3');
                     $('#admin_name').css('border','1px solid #2986d3');
                     $('#admin_address').focus();
                  }else{
                     if(personnel_age == ''){
                         $('#admin_age').css('border','1px solid #fc6262');
                         $('#admin_uname').css('border','1px solid #2986d3');
                         $('#admin_pass').css('border','1px solid #2986d3');
                         $('#admin_name').css('border','1px solid #2986d3');
                         $('#admin_address').css('border','1px solid #2986d3');
                         $('#admin_age').focus();
                      }else{
                         if(personnel_job == ''){
                             $('#admin_job').css('border','1px solid #fc6262');
                             $('#admin_uname').css('border','1px solid #2986d3');
                             $('#admin_pass').css('border','1px solid #2986d3');
                             $('#admin_name').css('border','1px solid #2986d3');
                             $('#admin_address').css('border','1px solid #2986d3');
                             $('#admin_age').css('border','1px solid #2986d3');
                             $('#admin_job').focus();
                          }else{
                              form_data.append('personnel_uname',personnel_uname);
                              form_data.append('personnel_pass',personnel_pass);
                              form_data.append('personnel_name',personnel_name);
                              form_data.append('personnel_address',personnel_address);
                              form_data.append('personnel_age',personnel_age);
                              form_data.append('personnel_job',personnel_job);
                              form_data.append('personnel_profile',property[0]);
                              form_data.append('api',api);
                              form_data.append('id',id);
                              $.ajax({
                                 url:'api/api.php',
                                 type:'POST',
                                 cache:false,
                                 data:form_data,
                                 processData:false,
                                 contentType:false,
                                 success:function(data){
                                     if(data == 0){
                                         $('.messageBox').addClass('show');
                                         $('.messageBox').css({
                                             'background-color':'#e63d3d',
                                         })
                                         $('#message').html('An error occured on updating data.')
                                         setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                     }else if(data == 1){                      
                                         $('.messageBox').addClass('show');
                                         $('.messageBox').css({
                                             'background-color':'#1760ce',
                                         })
                                         $('#message').html('Account Successfully Updated.')
                                         setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                     }      
                                 }  
                              })
                          }
                      }
                  }
              }
          }
        }
    })


// //******************************************************************************************* */

// //******************************************************************************************* */

//     /* OJT Supervisor Page JS */
    $('#btn_OJT_Status').click(function(){
        OJT_Status();
    })
    $('#btn_OJT_Evaluation').click(function(){
        $.ajax({
            url:'supervisor/ojt_evaluation.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })

    $('#btn_SupervisorAccount').click(function(){
        $.ajax({
            url:'supervisor/supervisor_account.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_saveChangesSupervisor', function(){
        supervisor_uname = $('#admin_uname').val();
        supervisor_pass = $('#admin_pass').val();
        supervisor_name = $('#admin_name').val();
        supervisor_address = $('#admin_address').val();
        supervisor_age = $('#admin_age').val();
        supervisor_job = $('#admin_job').val();
        api = 'updateSupervisor';
        
        if(supervisor_uname == ''){
          $('#admin_uname').css('border','1px solid #fc6262');
          $('#admin_uname').focus();
        }else{
          if(supervisor_pass == ''){
             $('#admin_pass').css('border','1px solid #fc6262');
             $('#admin_uname').css('border','1px solid #2986d3');
             $('#admin_pass').focus();
          }else{
             if(supervisor_name == ''){
                 $('#admin_name').css('border','1px solid #fc6262');
                 $('#admin_uname').css('border','1px solid #2986d3');
                 $('#admin_pass').css('border','1px solid #2986d3');
                 $('#admin_name').focus();
              }else{
                 if(supervisor_address == ''){
                     $('#admin_address').css('border','1px solid #fc6262');
                     $('#admin_uname').css('border','1px solid #2986d3');
                     $('#admin_pass').css('border','1px solid #2986d3');
                     $('#admin_name').css('border','1px solid #2986d3');
                     $('#admin_address').focus();
                  }else{
                     if(supervisor_age == ''){
                         $('#admin_age').css('border','1px solid #fc6262');
                         $('#admin_uname').css('border','1px solid #2986d3');
                         $('#admin_pass').css('border','1px solid #2986d3');
                         $('#admin_name').css('border','1px solid #2986d3');
                         $('#admin_address').css('border','1px solid #2986d3');
                         $('#admin_age').focus();
                      }else{
                         if(supervisor_job == ''){
                             $('#admin_job').css('border','1px solid #fc6262');
                             $('#admin_uname').css('border','1px solid #2986d3');
                             $('#admin_pass').css('border','1px solid #2986d3');
                             $('#admin_name').css('border','1px solid #2986d3');
                             $('#admin_address').css('border','1px solid #2986d3');
                             $('#admin_age').css('border','1px solid #2986d3');
                             $('#admin_job').focus();
                          }else{
                              $.ajax({
                                 url:'api/api.php',
                                 type:'POST',
                                 cache:false,
                                 data:{
                                     id:id,
                                     api:api,
                                     supervisor_uname:supervisor_uname,
                                     supervisor_pass:supervisor_pass,
                                     supervisor_name:supervisor_name,
                                     supervisor_address:supervisor_address,
                                     supervisor_age:supervisor_age,
                                     supervisor_job:supervisor_job,
                                 },
                                 success:function(data){
                                     if(data == 0){
                                         $('.messageBox').addClass('show');
                                         $('.messageBox').css({
                                             'background-color':'#e63d3d',
                                         })
                                         $('#message').html('An error occured on updating data.')
                                         setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                     }else if(data == 1){                      
                                         $('.messageBox').addClass('show');
                                         $('.messageBox').css({
                                             'background-color':'#1760ce',
                                         })
                                         $('#message').html('Account Successfully Updated.')
                                         setTimeout(function(){
                                            $('#message').html('')
                                            $('.messageBox').removeClass('show')
                                        },2000)
                                     }      
                                 }
                              })
                          }
                      }
                  }
              }
          }
        }
     })




// //******************************************************************************************* */

// //******************************************************************************************* */

//     /* OJT Student Page JS */

    $(document).on('click', '#btn_studentStatus', function(){
        studentStatus();
    })
    $(document).on('click', '#btn_studentJournal', function(){
        $.ajax({
            url:'student/journal.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchSupervisorData();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_studentAnnouncement', function(){
        $.ajax({
            url:'student/announcement.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                getAnnouncementByStudentCompany();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_studentProfile', function(){
        $.ajax({
            url:'student/profile.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchSupervisorData();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })
    $(document).on('click', '#btn_studentChat', function(){
        $.ajax({
            url:'student/student_chat.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchSupervisorData();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    })

    $('#btn_studentLog').click(function(){
        api = 'studentLog';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                user_id:user_id,
                api:api
            },
            success:function(data){
              if(data != 'You have reach the maximum number of time-in/time-out for today.'){
                    $('#modal_Login').modal('hide');
                    $('.alert').html(data);
                    $('.alert').addClass('role');
                    $('#username').val('');
                    $('#password').val('');
                    $('#username').focus();
                    setTimeout(function(){
                        $('.alert').removeClass('role');
                    },3800)
              }else{
                    $('#error').html('');
                    $('#modal_Login').modal('hide');
                    $('.alert').html(data);
                    $('.alert').css({
                        'background-color':'#fd6464',
                        'color':'#FFFFFF',
                        'padding':'15px 25px'
                    });
                    $('.alert').addClass('role');
                    $('#username').val('');
                    $('#password').val('');
                    $('#username').focus();
                    setTimeout(function(){
                        $('.alert').removeClass('role');
                    },4000)
              }
              
            }
        })
    })

    $(document).on('change', '#filterBy_month', function(){
       api = 'getStudentStatusByMonth';
       month = $('#filterBy_month').val();
    
       $.ajax({
           url:'api/api.php',
           type: 'POST',
           cache:false,
           data:{
               id:id,
               api: api,
               month:month
           },
           success: function(data){
                if(data != ''){
                    $('.tbl_StudentDTR').html(data)
                }else{
                    $('.tbl_StudentDTR').html('<span class="text-danger">No Data to be Fetch.</span>');
                }       
           }
       })
    })




// //******************************************************************************************* */
    //Load Content According to Usertype
    function loadPage(){
        usertype = $('#usertype').val();

        if(usertype == 1){
            Personnel();
        }
        else if(usertype == 2){
            Supervisors();
        }
        else if(usertype == 3){
            OJT_Status();
        }
        else if(usertype == 4){
            studentStatus();
        }
    }

    //Admin Functions
    function Personnel(){
        $.ajax({
            url:'admin/personnel.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchPersonnelData();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    }
   
    function fetchPersonnelData(){
        api = 'fetchPersonnel';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api:api,
            },
            success:function(data){
                $('.tbl_PersonnelData').html(data);
            }
        })
    }

    function fetchStudents(){
        api = 'fetchStudents';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api:api,
            },
            success:function(data){
              $('.tbl_StudentsData').html(data);
            }
        })
    }
    

//     //Personnel Functions
    function Supervisors(){
        $.ajax({
            url:'personnel/supervisors.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchSupervisorData();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    }
    
    function getAnnouncementByStudentCompany(){
       api= 'getAnnouncementByStudentCompany';

       $.ajax({
           url:'api/api.php',
           type:'POST',
           cache:false,
           data:{
               api:api,
               studentCompany:studentCompany
           },
           success:function(data){
               $('.child_scrollable').html(data);
           }
       })
    }
    
    function fetchSupervisorData(){
        department_type = $('#department_type').val();
        api = 'fetchSupervisor';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api:api,
                id:id,
                department_type:department_type,
            },
            success:function(data){
              $('.tbl_SupervisorData').html(data);
            }
        })
    }

    function fetchStudentDetails(){
        department_type = $('#department_type').val();
        api = 'fetchStudentDetails';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api:api,
                department_type:department_type,
            },
            success:function(data){
              $('.tbl_Students_Details').html(data);
            }
        })
    }
    function fetchAnnouncement(){
        api = 'fetchAnnouncement';
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api:api
            },
            success:function(data){
               $('.content').html(data);
            }
        })
    }

    //Supervisor Functions
    function OJT_Status(){
         $.ajax({
            url:'supervisor/ojt_status.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                $('.messageBox').removeClass('show');
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    }

    //Student Functions
    function studentStatus(){
        $.ajax({
            url:'student/status.php',
            method:'GET',
            cache:false,
            beforeSend:function(){
                $('.data').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.data').html(data);
                fetchSupervisorData();
                getStudentDetail();
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    }

    function getStudentDetail(){
        api = 'studentStatus';
        
        $.ajax({
            url:'api/api.php',
            type:'POST',
            cache:false,
            data:{
                api: api,
                id:id
            },
            success: function(data){
                $('.tbl_StudentDTR').html(data)
            }
        })
    }


    //Menu Active JS
    $('ul.right_sideMenu li').click(function(){
        usertype = $('#usertype').val();
        if(usertype == 1){
            $(this).addClass('active').siblings().removeClass('active');
        }else if(usertype == 2){
            $(this).addClass('active').siblings().removeClass('active');
        }
        else if(usertype == 3){
            $(this).addClass('active').siblings().removeClass('active');
        }
        else if(usertype == 4){
            $(this).addClass('active').siblings().removeClass('active');
        }
    })

    //Bootstrap Modals
    $(document).on('click','#btn_newPersonnel', function(){
        $('#modal_addPersonel').modal({
            backdrop: 'static',
            keyboard: false,            
       });
    })
    $(document).on('click','#btn_ShowUpdtPersonnel_Modal', function(e){
        $('#modal_updtPersonel').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#updt_id').val(e.currentTarget.attributes['data_id'].value);
       $('#updt_fullname').val(e.currentTarget.attributes['data_name'].value);
       $('#updt_department').val(e.currentTarget.attributes['data_department'].value);
       $('#updt_status').val(e.currentTarget.attributes['data_status'].value);
       
    })
    $(document).on('click','#btn_ShowDeletePersonnel_Modal', function(e){
        $('#modal_deletePersonel').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#delete_id').val(e.currentTarget.attributes['data_id'].value);
    })
    
    $(document).on('click', '#btnClosePersonnnelModal', function(){
        $('#fullname').val('');
        $('#department').val('');
        $('#personnel_username').val('');
        $('#personnel_pass').val('');
        $('#error1').html('');
        $('#error2').html('');
        $('#error3').html('');
        $('#error4').html('');
    })
    $(document).on('click', '#btnCloseUpdtPersonnnelModal', function(){
        $('#updt_id').val('');
        $('#updt_fullname').val('');
        $('#updt_department').val('');
        $('#updt_status').val('');
        $('#updt_error1').html('');
        $('#updt_error2').html('');
    })

    $(document).on('click','#btn_newSupervisor', function(){
        $('#modal_addSupervisor').modal({
            backdrop: 'static',
            keyboard: false,            
       });
    })

    $(document).on('click', '#btnCloseSupervisorModal', function(){
        $('#supervisor').val('');
        $('#company').val('');
        $('#location').val('');
        $('#supervisor_uname').val('');
        $('#supervisor_pass').val('');
        $('#error1_s').html('');
        $('#error2_s').html('');
        $('#error3_s').html('');
        $('#error4_s').html('');
        $('#error5_s').html('');
    })
    $(document).on('click','#btn_ShowDeleteSupervisor_Modal', function(e){
        $('#modal_deleteSupervisor').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#delete_supervisor_id').val(e.currentTarget.attributes['data_id'].value);
    })
    $(document).on('click','.create_evaluation', function(){
        $('#Evaluation_modal').modal({
            backdrop: 'static',
            keyboard: false,            
       });
    })
    $(document).on('click','#btn_ShowUpdtStudent_Modal', function(e){
        $('#modal_updtStudent').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#updt_studId').val(e.currentTarget.attributes['data_id'].value);
       $('#updt_studName').val(e.currentTarget.attributes['data_name'].value);
       $('#updt_studStatus').val(e.currentTarget.attributes['data_status'].value);
    })
    $(document).on('click', '#btnCloseUpdtStudentModal', function(){
        $('#updt_stud_error').html('');
    })
    $(document).on('click','#btn_ShowUpdtOJTStudent_Modal', function(e){
        $('#modal_updtOJTStudent').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#updt_id1').val(e.currentTarget.attributes['data_id'].value);
       $('#updt_OjtstudentName').val(e.currentTarget.attributes['data_name'].value);
    })
    $(document).on('click', '.add_announcement', function(){
        $('#modal_addAnnouncement').modal({
            backdrop: 'static',
            keyboard: false,            
       });
    })
    $(document).on('click', '#btnCloseAnnouncementModal', function(){
        $('#title').val('');
        $('#description').val('');
        $('#company_detail').val('');
        $('#error_title').html('');
        $('#error2_desc').html('');
        $('#error3_company').html('');

    })
    $(document).on('click', '#updt_announcement', function(e){
        $('#modal_updtAnnouncement').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#updt_announcementId').val(e.currentTarget.attributes['data_id'].value);
       $('#updt_title').val(e.currentTarget.attributes['data_title'].value);
       $('#updt_description').val(e.currentTarget.attributes['data_desc'].value);
       $('#updt_company_detail').val(e.currentTarget.attributes['data_company'].value);
    })
    $(document).on('click', '#btnCloseUpdtAnnouncementModal', function(){
        $('#updt_title').val('');
        $('#updt_description').val('');
        $('#updt_company_detail').val('');
        $('#updt_error_title').html('');
        $('#updt_error_desc').html('');
        $('#updt_error_company').html('');
    })
    $(document).on('click', '#delete_announcement', function(e){
        $('#modal_deleteAnnouncement').modal({
            backdrop: 'static',
            keyboard: false,            
       });
       $('#delete_announcementId').val(e.currentTarget.attributes['data_id'].value);
    })

    $(document).on('click', '#btn_Capture', async function(){
        $('#modal_studentCapture').modal({
            backdrop: 'static',
            keyboard: false,            
       });
        let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
    })
    $(document).on('click', '#btn_closeCapture', async function(){
        $('#modal_studentCapture').modal('hide');
        $('#btn_OKCapture').addClass('hidden');
        $('.canvas').html('');
    })
    $(document).on('click', '#btn_CaptureStudentImg', function(){
        $('.canvas').html('<canvas id="student_canvas1" width="100%" height="100%"></canvas>');
        let canvas1 = document.querySelector('#student_canvas1');
        canvas1.getContext('2d').drawImage(video, 0, 0, canvas1.width, canvas1.height);
        $('#btn_OKCapture').removeClass('hidden');
    })

    //Image Upload JS for Profiles
    $(document).on('change', '#my_profile', function(e){
       var myProfile = URL.createObjectURL(e.target.files[0]);
       $('#imgProfile').attr('src', myProfile);
    })
})

