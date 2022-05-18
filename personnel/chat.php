<?php
    include '../config.php';
    session_start();
    global $conn, $output;
?>
<div class="chatBox">
    <ul class="companies">
       <?php
          $query = "Select * from supervisor where personnel = '".$_SESSION['user_id']."'";
          $result = mysqli_query($conn, $query);

          while ($companies = mysqli_fetch_array($result)){
            $output.=' <li class="company_chat">'.$companies['company'].'</li> ';
          }
          echo $output;
       ?>
    </ul>
    <input type="hidden" id="company_chat1">
    <div class="chat">
    </div>
</div>
<script>

	$('.company_chat').click(function(){
        var company = $(this).html();
		$("#company_chat1").val(company);
		 $.ajax({
            url:'personnel/chat_box.php',
            method:'GET',
			 data:{
					company:company,
                },
            cache:false,
            beforeSend:function(){
				
                $('.chat').html('');
                $('#loader').addClass('load');
            },
            success:function(data){
                $('.chat').html(data);
            },
            complete:function(){
                $('#loader').removeClass('load');
            }
        })
    });

</script>