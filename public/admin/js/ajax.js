$(document).ready(function(){
  $('#episodes').DataTable();
  $('#movies').DataTable();
    //movies Attributes Add/Remove Script
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1
  
  //When user click on add input button
  $(add_button).click(function(e){
        e.preventDefault();
    //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
       //add input field
            $(wrapper).append('<div><div style="height:10px"></div><input type="text" name="size[]" placeholder="Size" value="" style="width:120px" />&nbsp;<input type="text" name="sku[]" placeholder="SKU" value="" style="width:120px" />&nbsp;<input type="text" name="price[]" placeholder="Price" value="" style="width:120px" />&nbsp;<input type="text" name="stock[]" placeholder="Stock" value="" style="width:120px" />&nbsp;<a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });

  $("#uploade_file").change(function(selectedValue) {
        var selectedValue = $(this).val();
        let div1 = document.getElementById('uploade_video');
        let div2 = document.getElementById('write_path');
        if(selectedValue == 2){
          div2.style.visibility  = "hidden";
        $("#uploade_video").html("<label for='video'>Episode Video (Recommend Size: less than 2 MB)</label><input type='file' class='form-control' id='video'name='video'>")
        div1.style.visibility = "visible";
        }else if(selectedValue == 1){
        div1.style.visibility = "hidden";
        $("#write_path").html("<label for='write_path'>External Video Path</label><input type='text' class='form-control' id='write_path'name='write_path' placeholder='Enter Episode write_path'>")
        div2.style.visibility = "visible";
      }
});
  
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
    $(this).parent('div').remove(); //remove inout field
    x--; //inout field decrement
    });

 // call datatable class
 $('#sections').DataTable();
 $('#categories').DataTable();
 $('#banners').DataTable();
 $('#permissions').DataTable();

$(".nav-item").removeClass("active");
$(".nav-link").removeClass("active");


//Check Admin Password is correct or not
$("#current_password").keyup(function(){
    var current_password = $("#current_password").val();
    // alert(current_password);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: '/admin/check-admin-password',
        data: {current_password:current_password},
        success: function(resp){
             if(resp=="false"){
               $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
             }else if(resp=="true"){
                $("#check_password").html("<font color='green'>Current Password is Correct!</font>");
             }
        },error:function(){
            alert('Error');
        }
        
      });
});


    //update user status
    $(document).on("click",".updateUserStatus",function(){
      var status = $(this).children("i").attr("status");
      var user_id = $(this).attr("user_id");
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post',
              url: '/admin/update-user-status',
              data: {status:status,user_id:user_id},
              success: function(resp){
                  if(resp['status']==0){
                    Swal.fire({
                      title: 'This user is Not Available',
                  
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    }),
                    $("#user-"+user_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                  }else if(resp['status']==1){
                    Swal.fire({
                      title: 'This user is Available',
                  
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    }),
                    $("#user-"+user_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                  }
              },error:function(){
                alert('Error');
              }
              
            });
      });

      //update permission status
    $(document).on("click",".updatePermissionStatus",function(){
      var status = $(this).children("i").attr("status");
      var permission_id = $(this).attr("permission_id");
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post',
              url: '/admin/update-permission-status',
              data: {status:status,permission_id:permission_id},
              success: function(resp){
                  if(resp['status']==0){
                    Swal.fire({
                      title: 'This permission is Not Available',
                  
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    }),
                    $("#permission-"+permission_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                  }else if(resp['status']==1){
                    Swal.fire({
                      title: 'This permission is Available',
                  
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    }),
                    $("#permission-"+permission_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                  }
              },error:function(){
                alert('Error');
              }
              
            });
      });

    $(document).on("click",".confirmDelete",function(){
        var module = $(this).attr('module');
        var moduleid = $(this).attr("moduleid");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              "Your "+ module+ " has been deleted",
              'success'
            )
            window.location="/admin/delete-"+module+"/"+moduleid;
          }
        })
    });

     //update episode status
     $(document).on("click",".updateEpisodeStatus",function(){
        var status = $(this).children("i").attr("status");
        var episode_id = $(this).attr("episode_id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-episode-status',
                data: {status:status,episode_id:episode_id},
                success: function(resp){
                    if(resp['status']==0){
                      Swal.fire({
                        title: 'This episode is Not Available',
                    
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      }),
                      $("#episode-"+episode_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                    }else if(resp['status']==1){
                      Swal.fire({
                        title: 'This episode is Available',
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      }),
                      $("#episode-"+episode_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                    }
                },error:function(){
                  alert('Error');
                }
                
              });
        });


      //update banner status
      $(document).on("click",".updateBannerStatus",function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-banner-status',
                data: {status:status,banner_id:banner_id},
                success: function(resp){
                    if(resp['status']==0){
                      Swal.fire({
                        title: 'This banner is Not Available',
                    
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      }),
                      $("#banner-"+banner_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                    }else if(resp['status']==1){
                      Swal.fire({
                        title: 'This banner is Available',
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      }),
                      $("#banner-"+banner_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                    }
                },error:function(){
                  alert('Error');
                }
                
              });
        });


  //update movie status
  $(document).on("click",".updateMovieStatus",function(){
    var status = $(this).children("i").attr("status");
    var movie_id = $(this).attr("movie_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-movie-status',
            data: {status:status,movie_id:movie_id},
            success: function(resp){
                if(resp['status']==0){
                  Swal.fire({
                    title: 'This movie is Not Available',
                
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }),
                  $("#movie-"+movie_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                }else if(resp['status']==1){
                  Swal.fire({
                    title: 'This movie is Available',
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }),
                  $("#movie-"+movie_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                }
            },error:function(){
              alert('Error');
            }
            
          });
    });
     

  //update actor status
  $(document).on("click",".updateActorStatus",function(){
    var status = $(this).children("i").attr("status");
    var actor_id = $(this).attr("actor_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-actor-status',
            data: {status:status,actor_id:actor_id},
            success: function(resp){
                if(resp['status']==0){
                  Swal.fire({
                    title: 'This actor is Not Available',
                
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }),
                  $("#actor-"+actor_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-lock' status='Inactive'></i>")
                }else if(resp['status']==1){
                  Swal.fire({
                    title: 'This actor is Available',
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }),
                  $("#actor-"+actor_id).html("<i style='font-size: 25px;' class='icon-nav fas fa-unlock' status='Active'></i>")
                }
            },error:function(){
              alert('Error');
            }
            
          });
    });

});
// $(document).ready(function () {
//   window.setTimeout(function () {

//       window.location.href = '/admin/users'; // "/queue" is the url route for wintwo.blade.php

//   },20000000000000);

// });

   
